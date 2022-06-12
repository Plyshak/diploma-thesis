<?php declare(strict_types = 1);

namespace Infrastructure\View;

use Domain\Course\Entity\CourseEntity;
use Domain\Course\Repository\CourseRepositoryInterface;
use Domain\Discussion\Entity\CommentEntity;
use Domain\Discussion\Entity\DiscussionEntity;
use Domain\Discussion\Service\DiscussionProviderInterface;
use Domain\Label\Entity\LabelEntity;
use Domain\Label\Service\LabelProviderInterface;
use Domain\Shared\Collection\Collection;
use Infrastructure\Content\Component\Content\ContentControl;
use Infrastructure\Content\Component\Content\ContentControlFactory;
use Infrastructure\Content\Component\ContentBuilder\ContentBuilderControl;
use Infrastructure\Content\Component\ContentBuilder\ContentBuilderControlFactory;
use Infrastructure\Discussion\Component\Comment\CommentControlFactory;
use Infrastructure\Discussion\Component\List\ListControl;
use Infrastructure\Discussion\Component\List\ListControlFactory;
use Nette\Application\UI\Form;
use Nette\Application\UI\Multiplier;
use Nette\Utils\Html;

class DiscussionPresenter extends AbstractPresenter
{
    /** @var CourseRepositoryInterface @inject */
    public $courseManager;

    /** @var LabelProviderInterface @inject */
    public $labelService;

    /** @var DiscussionProviderInterface @inject */
    public $discussionService;

    /** @var ListControlFactory @inject */
    public $listControlFactory;

    /** @var ContentBuilderControlFactory @inject */
    public $contentBuilderFactory;

    /** @var ContentControlFactory @inject */
    public $contentControlFactory;

    /** @var CommentControlFactory @inject */
    public $commentControlFactory;

    /** @var DiscussionEntity|null */
    protected $discussionEntity;

    /** @var CommentEntity|null */
    protected $commentEntity;

    public function getModuleName(): string
    {
        return 'discussion';
    }

    protected function beforeRender(): void
    {
        parent::beforeRender();

        $this->template->discussionEntity = $this->discussionEntity;
        $this->template->commentEntity = $this->commentEntity;
        $this->template->discussionArticleCount = $this->getDiscussionArticleCount();
        $this->template->discussionArticleCountText = $this->getDiscussionArticleCountText();
        $this->template->labels = $this->discussionEntity ? $this->getLabelsFromEntity() : [];
    }

    public function handleAddArticle(int $authorId) : void
    {
        $discussionEntity = $this->discussionService->createEmptyDiscussionByAuthor($authorId);

        $this->redirect('Discussion:edit', ['id' => $discussionEntity->getId()]);
    }

    public function handleAddComment(int $discussionId, int $authorId) : void
    {
        $commentEntity = $this->discussionService->createEmptyCommentForDiscussionByAuthor($discussionId, $authorId);

        $this->redirect(
            'Discussion:comment',
            [
                'discussionId' => $discussionId,
                'commentId' => $commentEntity->getId()
            ]
        );
    }

    public function actionEdit(int $id) : void
    {
        $this->discussionEntity = $this->discussionService->getDiscussionById($id);
    }

    public function actionView(int $id) : void
    {
        $this->discussionService->increaseDiscussionViewedCount($id);

        $this->discussionEntity = $this->discussionService->getDiscussionById($id);
    }

    public function actionComment(int $discussionId, int $commentId) : void
    {
        $this->discussionEntity = $this->discussionService->getDiscussionById($discussionId);
        $this->commentEntity = $this->discussionService->getCommentById($commentId);
    }

    public function createComponentList(): ListControl
    {
        return $this->listControlFactory->create();
    }

    public function createComponentArticleContent() : ContentControl
    {
        return $this->contentControlFactory->create($this->discussionEntity);
    }

    public function createComponentEditArticleForm() : Form
    {
        $form = new Form(null, 'editArticleForm');
        $form->setHtmlAttribute('class', 'editForm');

        $form->addText('title', 'Název tématu')
            ->setHtmlAttribute('class', 'smart-text')
            ->setDefaultValue($this->discussionEntity ? $this->discussionEntity->getTitle() : '');

        $form->addSelect('course_id', 'Kurz', $this->getCourses())
            ->setHtmlAttribute('class', 'smart-select')
            ->setDefaultValue($this->discussionEntity ?
                ($this->discussionEntity->getCourse() ?->getId())
                : null
            );

        $form->addCheckbox('solved', 'Vyřešeno')
            ->setHtmlAttribute('class', 'toggle');

        $form->addSubmit('submit', 'Uložit');

        $form->onSuccess[] = function (Form $form, array $values) {
            $this->discussionService->updateDiscussion($this->discussionEntity, $values);

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
            'Štítky',
            $this->getLabelsForForm()
        )
            ->setValue(
                $this->getLabelsFromEntityForForm()
            )
            ->setHtmlAttribute('class', 'labelCheckbox')
            ->setHtmlAttribute('onChange', '$("#labelFormAutoSubmit").click()');

        $separator = $control->getSeparatorPrototype();
        $separator->setName('', true);

        $form->addSubmit('labelFormAutoSubmit', 'Uložit')
            ->setHtmlAttribute('id', 'labelFormAutoSubmit');

        $form->onSuccess[] = function (Form $form, array $values) {
            $labels = $values['labels'] ?? [];

            $this->labelService->setLabelsToEntity($this->discussionEntity, $labels);

            $this->reloadEntity();
            $this->redrawControl('editLibraryArticle');
        };

        return $form;
    }

    public function createComponentAddArticleLabelForm() : Form
    {
        $form = new Form(null, 'addArticleLabelForm');
        $form->setHtmlAttribute('class', 'editForm');

        $form->addText('title', 'Přidat štítek')
            ->setHtmlAttribute('class', 'smart-text')
            ->setHtmlAttribute('placeholder', 'Název štítku ...')
            ->addRule($form::MIN_LENGTH, 'Název musí mít alespoň %d znak', 1);

        $form->addSubmit('submit', 'Přidat');

        $form->onSuccess[] = function (Form $form, array $values) {
            $this->labelService->addLabelToEntity($this->discussionEntity, $values);

            $this->reloadEntity();
            $this->redrawControl('editLibraryArticle');
        };

        return $form;
    }

    public function createComponentEditContent() : ContentBuilderControl
    {
        return $this->contentBuilderFactory->create($this->discussionEntity);
    }

    public function createComponentEditCommentContent() : ContentBuilderControl
    {
        return $this->contentBuilderFactory->create($this->commentEntity);
    }

    public function createComponentComment() : Multiplier
    {
        return new Multiplier(function (string $id) {
            $entity = $this->discussionService->getCommentById((int) $id);

            return $this->commentControlFactory->create($entity);
        });
    }

    private function getDiscussionArticleCount() : int
    {
        /** @var ListControl $control */
        $control = $this->getComponent('list');

        return $control->getDiscussionCount();
    }

    private function getDiscussionArticleCountText() : string
    {
        $count = $this->getDiscussionArticleCount();

        if ($count === 0) {
            $text = 'témat';
        } elseif ($count === 1) {
            $text = 'téma';
        } elseif ($count < 5) {
            $text = 'témata';
        } else {
            $text = 'témat';
        }

        return $text;
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

    private function reloadEntity() : void
    {
        $this->discussionEntity = $this->discussionService->getDiscussionById($this->discussionEntity->getId());
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

    private function getLabelsFromEntity() : Collection
    {
        return $this->labelService->getEntityLabels($this->discussionEntity);
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
}