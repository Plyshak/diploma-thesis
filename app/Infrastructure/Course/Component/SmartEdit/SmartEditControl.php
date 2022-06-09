<?php declare(strict_types = 1);

namespace Infrastructure\Course\Component\SmartEdit;

use Domain\Course\Entity\ChapterEntity;
use Domain\Course\Entity\PageEntity;
use Domain\Course\Service\CourseProviderInterface;
use Infrastructure\Component\AbstractControl;
use Infrastructure\Content\Component\ContentBuilder\ContentBuilderControl;
use Infrastructure\Content\Component\ContentBuilder\ContentBuilderControlFactory;
use Nette\Application\UI\Form;

class SmartEditControl extends AbstractControl
{
    /** @var callable[] */
    public $onChange = [];

    /** @var string|null */
    protected $type;

    /** @var int|null */
    protected $id;

    protected $courseService;
    protected $contentBuilderControlFactory;

    public function __construct(
        ?string $type,
        ?int $id,
        CourseProviderInterface $courseService,
        ContentBuilderControlFactory $contentBuilderControlFactory
    ) {
        $this->type = $type;
        $this->id = $id;
        $this->courseService = $courseService;
        $this->contentBuilderControlFactory = $contentBuilderControlFactory;
    }

    public function addTemplateParameters(): void
    {
        parent::addTemplateParameters();

        $this->template->type = $this->type;
        $this->template->id = $this->id;
        $this->template->pageEntity = $this->getPageEntity();
        $this->template->chapterEntity = $this->getChapterEntity();
    }

    public function createComponentChapterEditForm() : Form
    {
        $entity = $this->courseService->getChapterById($this->id);

        $form = new Form(null, 'chapterEditForm');
        $form->setHtmlAttribute('class', 'editForm autoSubmitForm');

        $form->addTextArea('annotation', 'Anotace kapitoly')
            ->setHtmlAttribute('class', 'smart-text')
            ->setDefaultValue($entity->getAnnotation())
            ->setHtmlAttribute('onChange', '$("#labelFormAutoSubmit").click()');

        $form->addCheckbox('repetition', 'Testovací kapitola')
            ->setHtmlAttribute('class', 'toggle')
            ->setDefaultValue($entity->isRepetition())
            ->setHtmlAttribute('onChange', '$("#labelFormAutoSubmit").click()');

        $form->addSubmit('labelFormAutoSubmit', 'Uložit')
            ->setHtmlAttribute('id', 'labelFormAutoSubmit');

        $form->onSuccess[] = function (Form $form, array $values) use ($entity) {
            $this->courseService->updateChapter($entity, $values);

            foreach ($this->onChange as $callable) {
                $callable();
            }
        };

        return $form;
    }

    public function createComponentPageContent() : ContentBuilderControl
    {
        $entity = $this->courseService->getPageById($this->id);

        return $this->contentBuilderControlFactory->create($entity);
    }

    private function getPageEntity() : ?PageEntity
    {
        $entity = null;

        if ($this->type === 'page' && $this->id > 0) {
            $entity = $this->courseService->getPageById($this->id);
        }

        return $entity;
    }

    private function getChapterEntity() : ?ChapterEntity
    {
        $entity = null;

        if ($this->type === 'page') {
            $id = $this->getPageEntity()->getChapterId();
        } else {
            $id = $this->id;
        }

        if ($id > 0) {
            $entity = $this->courseService->getChapterById($id);
        }

        return $entity;
    }
}