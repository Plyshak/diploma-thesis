<?php declare(strict_types = 1);

namespace Infrastructure\View;

use Domain\Course\Entity\ChapterEntity;
use Domain\Course\Entity\CourseEntity;
use Domain\Course\Entity\PageEntity;
use Domain\Course\Service\CourseProviderInterface;
use Domain\Topic\Entity\TopicEntity;
use Domain\Topic\Service\TopicService;
use Infrastructure\Content\Component\Content\ContentControl;
use Infrastructure\Content\Component\Content\ContentControlFactory;
use Infrastructure\Course\Component\List\ListControl;
use Infrastructure\Course\Component\List\ListControlFactory;
use Infrastructure\Course\Component\SmartEdit\SmartEditControl;
use Infrastructure\Course\Component\SmartEdit\SmartEditControlFactory;
use Nette\Application\UI\Form;

class CoursePresenter extends AbstractPresenter
{
    /** @var CourseProviderInterface @inject */
    public $courseService;

    /** @var TopicService @inject */
    public $topicService;

    /** @var ListControlFactory @inject */
    public $listControlFactory;

    /** @var ContentControlFactory @inject */
    public $contentControlFactory;

    /** @var SmartEditControlFactory @inject */
    public $smartEditControlFactory;

    /** @var CourseEntity|null */
    protected $courseEntity;

    /** @var ChapterEntity|null */
    protected $chapterEntity;

    /** @var PageEntity|null */
    protected $pageEntity;

    /** @var null|string @persistent */
    public $smartEditType = null;

    /** @var null|int @persistent */
    public $smartEditId = null;

    public function getModuleName(): string
    {
        return 'course';
    }

    public function actionView(int $id) : void
    {
        $this->courseEntity = $this->courseService->getCourseById($id);
    }

    public function actionEdit(int $id) : void
    {
        $this->courseEntity = $this->courseService->getCourseById($id);
    }

    public function actionPage(int $courseId, int $chapterPosition, int $pagePosition) : void
    {
        $courseEntity = $this->courseService->getCourseById($courseId);
        $chapterEntity = $this->courseService->getChapterOfCourseByPosition($courseEntity, $chapterPosition);
        $pageEntity = $this->courseService->getPageOfChapterByPosition($chapterEntity, $pagePosition);

        $this->courseEntity = $courseEntity;
        $this->chapterEntity = $chapterEntity;
        $this->pageEntity = $pageEntity;
    }

    public function handleSetSmartEdit(string $type, int $smartId) : void
    {
        $this->smartEditType = $type;
        $this->smartEditId = $smartId;

        $this->redrawControl();
    }

    public function handleAddChapter() : void
    {
        $chapterEntity = $this->courseService->addChapterToCourse($this->courseEntity);

        $this->smartEditType = 'chapter';
        $this->smartEditId = $chapterEntity->getId();

        $this->reloadEntity();
        $this->redrawControl();
    }

    public function handleAddPage(string $chapterId) : void
    {
        $chapterEntity = $this->courseService->getChapterById((int) $chapterId);
        $pageEntity = $this->courseService->addPageToChapter($chapterEntity);

        $this->smartEditType = 'page';
        $this->smartEditId = $pageEntity->getId();

        $this->reloadEntity();
        $this->redrawControl();
    }

    public function createComponentList() : ListControl
    {
        return $this->listControlFactory->create();
    }

    public function createComponentPageContent() : ContentControl
    {
        return $this->contentControlFactory->create($this->pageEntity);
    }

    public function createComponentSmartEdit() : SmartEditControl
    {
        $control = $this->smartEditControlFactory->create(
            $this->smartEditType,
            (int) $this->smartEditId
        );

        $control->onChange[] = function () {
            $this->reloadEntity();
            $this->redrawControl();
        };

        return $control;
    }

    public function createComponentCourseEditForm() : Form
    {
        $form = new Form(null, 'courseEditForm');
        $form->setHtmlAttribute('class', 'editForm');

        $form->addText('title', 'Název kurzu')
            ->setHtmlAttribute('class', 'smart-text')
            ->setDefaultValue($this->courseEntity ? $this->courseEntity->getTitle() : '');

        $form->addSelect('topic_id', 'Téma', $this->getTopics())
            ->setHtmlAttribute('class', 'smart-select')
            ->setDefaultValue($this->courseEntity ?
                ($this->courseEntity->getTopic() ?->getId())
                : null
            );

        $form->addTextArea('annotation', 'Krátký popis kurzu')
            ->setHtmlAttribute('class', 'smart-text')
            ->setDefaultValue($this->courseEntity->getAnnotation());

        $form->addCheckbox('public', 'Veřejný kurz')
            ->setHtmlAttribute('class', 'toggle')
            ->setDefaultValue($this->courseEntity->isPublic());

        $form->addCheckbox('visibility', 'Zveřejnit')
            ->setHtmlAttribute('class', 'toggle')
            ->setDefaultValue($this->courseEntity->isVisibility());

        $form->addSubmit('submit', 'Uložit');

        $form->onSuccess[] = function (Form $form, array $values) {
            $this->courseService->updateCourse($this->courseEntity, $values);

            $this->reloadEntity();
            $this->redrawControl();
        };

        return $form;
    }

    protected function beforeRender(): void
    {
        parent::beforeRender();

        $this->template->courseEntity = $this->courseEntity;
        $this->template->chapterEntity = $this->chapterEntity;
        $this->template->pageEntity = $this->pageEntity;
    }

    private function getTopics() : array
    {
        $topics = [];

        $collection = $this->topicService->findAll();

        /** @var TopicEntity $item */
        foreach ($collection as $item) {
            $topics[$item->getId()] = $item->getTitle();
        }

        return $topics;
    }

    private function reloadEntity() : void
    {
        $this->courseEntity = $this->courseService->getCourseById($this->courseEntity->getId());
    }
}