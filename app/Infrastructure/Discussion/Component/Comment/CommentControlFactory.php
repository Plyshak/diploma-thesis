<?php declare(strict_types = 1);

namespace Infrastructure\Discussion\Component\Comment;

use Domain\Discussion\Entity\CommentEntity;

interface CommentControlFactory
{
    public function create(CommentEntity $commentEntity) : CommentControl;
}