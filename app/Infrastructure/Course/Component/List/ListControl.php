<?php declare(strict_types = 1);

namespace Infrastructure\Course\Component\List;

use Domain\Course\Service\CourseProviderInterface;
use Domain\Label\Entity\LabelEntity;
use Domain\Label\Service\LabelService;
use Domain\Shared\Collection\Collection;
use Domain\Topic\Entity\TopicEntity;
use Domain\Topic\Service\TopicService;
use Domain\User\Entity\ValueObject\UserType;
use Domain\User\Repository\UsersRepositoryInterface;
use Infrastructure\Component\AbstractControl;
use Infrastructure\Course\Component\Article\ArticleControlFactory;
use Infrastructure\User\Entity\UserIdentity;
use Nette\Application\UI\Form;
use Nette\Application\UI\Multiplier;
use Nette\Utils\Html;

class ListControl extends AbstractControl
{
    protected $articles;
    protected $courseService;
    protected $userManager;
    protected $topicService;
    protected $labelService;
    protected $articleControlFactory;

    public function __construct(
        CourseProviderInterface $courseService,
        UsersRepositoryInterface $userManager,
        TopicService $topicService,
        LabelService $labelService,
        ArticleControlFactory $articleControlFactory
    ) {
        $this->courseService = $courseService;
        $this->userManager = $userManager;
        $this->topicService = $topicService;
        $this->labelService = $labelService;
        $this->articleControlFactory = $articleControlFactory;
    }

    public function addTemplateParameters(): void
    {
        parent::addTemplateParameters();

        $this->template->articleList = $this->getArticles();
    }

    public function handleAddArticle(int $authorId) : void
    {
        $entity = $this->courseService->createEmpty($authorId);

        $this->getPresenter()->redirect('Course:edit', ['id' => $entity->getId()]);
    }

    public function createComponentArticle() : Multiplier
    {
        return new Multiplier(function (string $id) {
            $entity = $this->courseService->getCourseById((int) $id);

            return $this->articleControlFactory->create($entity);
        });
    }

    public function createComponentFilterForm() : Form
    {
        $form = new Form(null, 'courseFilterForm');
        $form->setHtmlAttribute('data-ajax', 'false');
        $form->setHtmlAttribute('class', 'labelForm autoSubmitForm');

        $form->addSelect(
            'author_id',
            'Lektor',
            $this->findLectors()
        )
            ->setHtmlAttribute('class', 'labelCheckbox')
            ->setHtmlAttribute('onChange', '$("#labelFormAutoSubmit").click()');

        $form->addSelect(
            'topic_id',
            'Téma',
            $this->findTopics()
        )
            ->setHtmlAttribute('class', 'labelCheckbox')
            ->setHtmlAttribute('onChange', '$("#labelFormAutoSubmit").click()');

        $control = $form->addCheckboxList(
            'labels',
            'Štítky:',
            $this->findLabels()
        );

        $control->setHtmlAttribute('class', 'labelCheckbox');
        $control->setHtmlAttribute('onChange', '$("#labelFormAutoSubmit").click()');

        $separator = $control->getSeparatorPrototype();
        $separator->setName('', true);

        $form->addText('title', 'Titul:')
            ->setHtmlAttribute('class', 'smart-search-input')
            ->setHtmlAttribute('placeholder', 'Vyhledávání ...')
            ->setHtmlAttribute('onChange', '$("#labelFormAutoSubmit").click()');

        $form->addSubmit('labelFormAutoSubmit', 'Vyhledat')
            ->setHtmlAttribute('id', 'labelFormAutoSubmit');

        $form->onSuccess[] = function (Form $form, array $values) {
            $conditions = [];

            if (!empty($values['author_id'])) {
                $conditions['author_id'] = $values['author_id'];
            }

            if (!empty($values['topic_id'])) {
                $conditions['topic_id'] = $values['topic_id'];
            }

            if (!empty($values['title'])) {
                $conditions['title'] = $values['title'];
            }

            if (count($values['labels']) > 0) {
                $conditions['labels'] = $values['labels'];
            }

            if (!$this->getPresenter()->getUser()->isLoggedIn()) {
                $conditions['public'] = true;
            }

            $this->articles = $this->courseService->findAllWithConditions($conditions);

            $this->redrawControl('libraryArticleList');
        };

        return $form;
    }

    private function getArticles() : Collection
    {
        $conditions = ['visibility' => true];

        if (!$this->getPresenter()->getUser()->isLoggedIn()) {
            $conditions['public'] = true;
        } else {
            $conditions['user_id'] = $this->getPresenter()->getUser()->getId();
        }

        if ($this->articles === null) {
            $this->articles = $this->courseService->findAllWithConditions($conditions);
        }

        return $this->articles;
    }

    private function findLectors() : array
    {
        $lectors = [null => '-'];

        $users = $this->userManager->findAllByType(UserType::CODE_LECTOR);

        /** @var UserIdentity $user */
        foreach ($users as $user) {
            $lectors[$user->getId()] = $user->getName();
        }

        return $lectors;
    }

    private function findTopics() : array
    {
        $topics = [null => '-'];

        $collection = $this->topicService->findAll();

        /** @var TopicEntity $item */
        foreach ($collection as $item) {
            $topics[$item->getId()] = $item->getTitle();
        }

        return $topics;
    }

    private function findLabels() : array
    {
        $labels = [];
        $collection = $this->labelService->getAllLabels();

        /** @var LabelEntity $item */
        foreach ($collection as $item) {
            $labels[$item->getId()] = Html::el('span')->setText($item->getTitle());
        }

        return $labels;
    }
}