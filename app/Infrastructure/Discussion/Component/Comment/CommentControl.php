<?php declare(strict_types = 1);

namespace Infrastructure\Discussion\Component\Comment;

use Domain\Discussion\Entity\CommentEntity;
use Infrastructure\Component\AbstractControl;
use Infrastructure\Content\Component\Content\ContentControl;
use Infrastructure\Content\Component\Content\ContentControlFactory;
use Infrastructure\Rating\Component\Rating\RatingControl;
use Infrastructure\Rating\Component\Rating\RatingControlFactory;

class CommentControl extends AbstractControl
{
    protected $commentEntity;
    protected $ratingControlFactory;
    protected $contentControlFactory;

    public function __construct(
        CommentEntity $commentEntity,
        RatingControlFactory $ratingControlFactory,
        ContentControlFactory $contentControlFactory
    ) {
        $this->commentEntity = $commentEntity;
        $this->ratingControlFactory = $ratingControlFactory;
        $this->contentControlFactory = $contentControlFactory;
    }

    public function addTemplateParameters(): void
    {
        parent::addTemplateParameters();

        $this->template->commentEntity = $this->commentEntity;
    }

    public function createComponentRating() : RatingControl
    {
        return $this->ratingControlFactory->create($this->commentEntity);
    }

    public function createComponentContent() : ContentControl
    {
        return $this->contentControlFactory->create($this->commentEntity);
    }
}