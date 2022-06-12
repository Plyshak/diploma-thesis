<?php declare(strict_types = 1);

namespace Infrastructure\Discussion\Component\List;

use Domain\Course\Entity\CourseEntity;
use Domain\Course\Repository\CourseRepositoryInterface;
use Domain\Discussion\Service\DiscussionProviderInterface;
use Domain\Label\Entity\LabelEntity;
use Domain\Label\Repository\LabelRepositoryInterface;
use Domain\Shared\Collection\Collection;
use Infrastructure\Component\AbstractControl;
use Infrastructure\Discussion\Component\Article\ArticleControlFactory;
use Nette\Application\UI\Form;
use Nette\Application\UI\Multiplier;
use Nette\Utils\Html;

class ListControl extends AbstractControl
{
    protected $discussions;
    protected $labelManager;
    protected $courseManager;
    protected $discussionService;
    protected $articleControlFactory;

    public function __construct(
        LabelRepositoryInterface $labelRepository,
        CourseRepositoryInterface $courseRepository,
        DiscussionProviderInterface $discussionService,
        ArticleControlFactory $articleControlFactory
    ) {
        $this->labelManager = $labelRepository;
        $this->courseManager = $courseRepository;
        $this->discussionService = $discussionService;
        $this->articleControlFactory = $articleControlFactory;
    }

    public function getDiscussionCount() : int
    {
        return count($this->getDiscussions());
    }

    public function addTemplateParameters(): void
    {
        parent::addTemplateParameters();

        $this->template->articleList = $this->getDiscussions();
    }

    public function createComponentArticle() : Multiplier
    {
        return new Multiplier(function (string $id) {
            $entity = $this->discussionService->getDiscussionById((int) $id);
            $control = $this->articleControlFactory->create($entity);

            return $control;
        });
    }

    public function createComponentFilterForm() : Form
    {
        $form = new Form(null, 'library-filter-form');
        $form->setHtmlAttribute('data-ajax', 'false');
        $form->setHtmlAttribute('class', 'labelForm autoSubmitForm');

        $control = $form->addSelect(
            'course_id',
            'Kurz',
            $this->getCourses()
        );
        $control->setHtmlAttribute('class', 'labelCheckbox');
        $control->setHtmlAttribute('onChange', '$("#labelFormAutoSubmit").click()');

        $control = $form->addCheckboxList(
            'labels',
            'Štítky:',
            $this->getLabels()
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

            if (!empty($values['course_id'])) {
                $conditions['course_id'] = $values['course_id'];
            }

            if (!empty($values['title'])) {
                $conditions['title'] = $values['title'];
            }

            if (count($values['labels']) > 0) {
                $conditions['labels'] = $values['labels'];
            }

            $this->discussions = $this->discussionService->findAllDiscussionsWithConditions($conditions);

            $this->redrawControl('libraryArticleList');
        };

        return $form;
    }

    private function getCourses() : array
    {
        $courses = [null => '-'];
        $collection = $this->courseManager->findAll();

        /** @var CourseEntity $item */
        foreach ($collection as $item) {
            $courses[$item->getId()] = $item->getTitle();
        }

        return $courses;
    }

    private function getLabels() : array
    {
        $labels = [];
        $collection = $this->labelManager->findAll();

        /** @var LabelEntity $item */
        foreach ($collection as $item) {
            $labels[$item->getId()] = Html::el('span')->setText($item->getTitle());
        }

        return $labels;
    }

    private function getDiscussions() : Collection
    {
        if ($this->discussions === null) {
            $this->discussions = $this->discussionService->findAllDiscussions();
        }

        return $this->discussions;
    }
}