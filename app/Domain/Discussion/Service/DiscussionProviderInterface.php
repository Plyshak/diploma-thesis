<?php declare(strict_types = 1);

namespace Domain\Discussion\Service;

use Domain\Discussion\Entity\CommentEntity;
use Domain\Discussion\Entity\DiscussionEntity;
use Domain\Shared\Collection\Collection;

interface DiscussionProviderInterface
{
    public function findAllDiscussions() : Collection;
    public function findAllDiscussionsWithConditions(array $conditions) : Collection;
    public function getDiscussionById(int $id) : DiscussionEntity;
    public function createEmptyDiscussionByAuthor(int $authorId) : DiscussionEntity;
    public function updateDiscussion($discussionEntity, array $values) : bool;
    public function createEmptyCommentForDiscussionByAuthor(int $discussionId, int $authorId) : CommentEntity;
    public function getCommentById(int $id) : CommentEntity;
    public function increaseDiscussionViewedCount(int $id) : bool;
}