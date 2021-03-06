<?php declare(strict_types = 1);

namespace Infrastructure\View;

use Domain\Label\Entity\LabelEntity;
use Domain\Label\Service\LabelProviderInterface;
use Domain\Library\Entity\LibraryEntity;
use Domain\Shared\Collection\Collection;
use Infrastructure\Content\Component\Content\ContentControl;
use Infrastructure\Content\Component\Content\ContentControlFactory;
use Infrastructure\Content\Component\ContentBuilder\ContentBuilderControl;
use Infrastructure\Content\Component\ContentBuilder\ContentBuilderControlFactory;
use Infrastructure\Database\Manager\LibraryManager;
use Infrastructure\Library\Component\List\ListControl;
use Infrastructure\Library\Component\List\ListControlFactory;
use Nette\Application\UI\Form;
use Nette\Utils\Html;

class LibraryPresenter extends AbstractPresenter
{
    /** @var LibraryManager @inject */
    public $libraryManager;

    /** @var LabelProviderInterface @inject */
    public $labelService;

    /** @var ListControlFactory @inject */
    public $listControlFactory;

    /** @var ContentBuilderControlFactory @inject */
    public $contentBuilderFactory;

    /** @var ContentControlFactory @inject */
    public $contentControlFactory;

    /** @var LibraryEntity|null */
    protected $libraryEntity;

    public function getModuleName(): string
    {
        return 'library';
    }

    protected function beforeRender(): void
    {
        parent::beforeRender();

        $this->template->libraryArticleCount = $this->getLibraryArticleCount();
        $this->template->libraryArticleCountText = $this->getLibraryArticleText();
        $this->template->libraryEntity = $this->libraryEntity;
        $this->template->labels = $this->libraryEntity ? $this->getLabelsFromEntity() : [];
    }

    public function handleAddArticle(int $userId) : void
    {
        $libraryEntity = $this->libraryManager->createEmpty($userId);

        $this->redirect('Library:edit', ['id' => $libraryEntity->getId()]);
    }

    public function actionEdit(int $id) : void
    {
        $this->libraryEntity = $this->libraryManager->getById($id);
    }

    public function actionView(int $id) : void
    {
        $this->libraryEntity = $this->libraryManager->getById($id);
    }

    public function createComponentList() : ListControl
    {
        return $this->listControlFactory->create();
    }

    public function createComponentEditArticleForm() : Form
    {
        $form = new Form(null, 'editArticleForm');
        $form->setHtmlAttribute('class', 'editForm');

        $form->addText('title', 'N??zev ??l??nku')
            ->setHtmlAttribute('class', 'smart-text')
            ->setDefaultValue($this->libraryEntity ? $this->libraryEntity->getTitle() : '');
        $form->addTextArea('perex', 'Kr??tk?? popis ??l??nku')
            ->setHtmlAttribute('class', 'smart-text')
            ->setDefaultValue($this->libraryEntity ? $this->libraryEntity->getPerex() : '');
        $uploadControl = $form->addUpload('image', 'Obr??zek');
        $form->addSubmit('submit', 'Ulo??it');

        if ($this->libraryEntity) {
            $uploadControl->setOption('description', 'Obr??zek je vlo??en');
        }

        $form->onSuccess[] = function (Form $form, array $values) {
            $this->libraryManager->update($this->libraryEntity, $values);

            $this->reloadEntity();
            $this->redrawControl('editLibraryArticle');
        };

        return $form;
    }

    public function createComponentEditArticleLabelsForm() : Form
    {
        $form = new Form(null, 'libraryFilterForm');
        $form->setHtmlAttribute('class', 'labelForm autoSubmitForm');

        $control = $form->addCheckboxList(
                'labels',
                '??t??tky',
                $this->getLabelsForForm()
            )
            ->setValue(
                $this->getLabelsFromEntityForForm()
            )
            ->setHtmlAttribute('class', 'labelCheckbox')
            ->setHtmlAttribute('onChange', '$("#labelFormAutoSubmit").click()');

        $separator = $control->getSeparatorPrototype();
        $separator->setName('', true);

        $form->addSubmit('labelFormAutoSubmit', 'Ulo??it')
            ->setHtmlAttribute('id', 'labelFormAutoSubmit');

        $form->onSuccess[] = function (Form $form, array $values) {
            $labels = $values['labels'] ?? [];

            $this->labelService->setLabelsToEntity($this->libraryEntity, $labels);

            $this->reloadEntity();
            $this->redrawControl('editLibraryArticle');
        };

        return $form;
    }

    public function createComponentAddArticleLabelForm() : Form
    {
        $form = new Form(null, 'addArticleLabelForm');
        $form->setHtmlAttribute('class', 'editForm');

        $form->addText('title', 'P??idat ??t??tek')
            ->setHtmlAttribute('class', 'smart-text')
            ->setHtmlAttribute('placeholder', 'N??zev ??t??tku ...')
            ->addRule($form::MIN_LENGTH, 'N??zev mus?? m??t alespo?? %d znak', 1);

        $form->addSubmit('submit', 'P??idat');

        $form->onSuccess[] = function (Form $form, array $values) {
            $this->labelService->addLabelToEntity($this->libraryEntity, $values);

            $this->reloadEntity();
            $this->redrawControl('editLibraryArticle');
        };

        return $form;
    }

    public function createComponentEditContent() : ContentBuilderControl
    {
        return $this->contentBuilderFactory->create($this->libraryEntity);
    }

    public function createComponentArticleContent() : ContentControl
    {
        return $this->contentControlFactory->create($this->libraryEntity);
    }

    private function getLibraryArticleCount() : int
    {
        /** @var ListControl $control */
        $control = $this->getComponent('list');

        return $control->getArticlesCount();
    }

    private function getLibraryArticleText() : string
    {
        $count = $this->getLibraryArticleCount();

        if ($count === 1) {
            $text = '??l??nek';
        } elseif ($count > 1 && $count < 5) {
            $text = '??l??nky';
        } else {
            $text = '??l??nk??';
        }

        return $text;
    }

    private function reloadEntity() : void
    {
        $this->libraryEntity = $this->libraryManager->getById($this->libraryEntity->getId());
    }

    private function getLabelsForForm() : array
    {
        $formItems = [];
        $labels = $this->labelService->getAllLabels();

        /** @var LabelEntity $label */
        foreach ($labels as $label) {
            $formItems[$label->getId()] = Html::el('span')->setText($label->getTitle());
        }

        return $formItems;
    }

    private function getLabelsFromEntityForForm() : array
    {
        $labels = [];

        $collection = $this->getLabelsFromEntity();

        /** @var LabelEntity $item */
        foreach ($collection as $item) {
            $labels[] = $item->getId();
        }

        return $labels;
    }

    private function getLabelsFromEntity() : Collection
    {
        return $this->labelService->getEntityLabels($this->libraryEntity);
    }
}