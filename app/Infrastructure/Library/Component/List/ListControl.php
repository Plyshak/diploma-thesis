<?php declare(strict_types = 1);

namespace Infrastructure\Library\Component\List;

use Domain\Label\Entity\LabelEntity;
use Domain\Shared\Collection\Collection;
use Infrastructure\Component\AbstractControl;
use Infrastructure\Database\Manager\LabelManager;
use Infrastructure\Database\Manager\LibraryManager;
use Infrastructure\Library\Component\Article\ArticleControlFactory;
use Nette\Application\UI\Form;
use Nette\Application\UI\Multiplier;
use Nette\Utils\Html;

class ListControl extends AbstractControl
{
    protected $articles;
    protected $labelManager;
    protected $libraryManager;
    protected $articleControlFactory;

    public function __construct(
        LabelManager $labelManager,
        LibraryManager $libraryManager,
        ArticleControlFactory $articleControlFactory
    ) {
        $this->labelManager = $labelManager;
        $this->libraryManager = $libraryManager;
        $this->articleControlFactory = $articleControlFactory;
    }

    public function addTemplateParameters(): void
    {
        parent::addTemplateParameters();

        $this->template->articleList = $this->getArticles();
    }

    public function createComponentFilterForm() : Form
    {
        $form = new Form(null, 'library-filter-form');
        $form->setHtmlAttribute('data-ajax', 'false');
        $form->setHtmlAttribute('class', 'labelForm autoSubmitForm');

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

            if (!empty($values['title'])) {
                $conditions['title'] = $values['title'];
            }

            if (count($values['labels']) > 0) {
                    $conditions['labels'] = $values['labels'];
            }

            $this->articles = $this->libraryManager->findAllWithConditions($conditions);

            $this->redrawControl('libraryArticleList');
        };

        return $form;
    }

    public function createComponentArticle() : Multiplier
    {
        return new Multiplier(function (string $id) {
            $entity = $this->libraryManager->getById((int) $id);
            $control = $this->articleControlFactory->create($entity);

            return $control;
        });
    }

    public function getArticlesCount() : int
    {
        return count($this->getArticles());
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

    private function getArticles() : Collection
    {
        if ($this->articles === null) {
            $this->articles = $this->libraryManager->findAll();
        }

        return $this->articles;
    }
}