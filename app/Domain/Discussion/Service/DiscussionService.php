<?php declare(strict_types = 1);

namespace Domain\Discussion\Service;

use Domain\Discussion\Entity\CommentEntity;
use Domain\Discussion\Entity\DiscussionEntity;
use Domain\Discussion\Repository\CommentRepositoryInterface;
use Domain\Discussion\Repository\DiscussionRepositoryInterface;
use Domain\Shared\Collection\Collection;

class DiscussionService implements DiscussionProviderInterface
{
    protected $discussionManager;
    protected $commentManager;

    public function __construct(
        DiscussionRepositoryInterface $discussionRepository,
        CommentRepositoryInterface $commentRepository
    ) {
        $this->discussionManager = $discussionRepository;
        $this->commentManager = $commentRepository;
    }

    public function findAllDiscussions() : Collection
    {
        return $this->discussionManager->findAll();
    }

    public function findAllDiscussionsWithConditions(array $conditions) : Collection
    {
        return $this->discussionManager->findAllWithConditions($conditions);
    }

    public function getDiscussionById(int $id) : DiscussionEntity
    {
        return $this->discussionManager->getById($id);
    }

    public function createEmptyDiscussionByAuthor(int $authorId) : DiscussionEntity
    {
        return $this->discussionManager->createEmpty($authorId);
    }

    public function updateDiscussion($discussionEntity, array $values) : bool
    {
        return $this->discussionManager->update($discussionEntity, $values);
    }

    public function createEmptyCommentForDiscussionByAuthor(int $discussionId, int $authorId) : CommentEntity
    {
        return $this->commentManager->create([
            'discussion_id' => $discussionId,
            'author_id' => $authorId,
        ]);
    }

    public function getCommentById(int $id) : CommentEntity
    {
        return $this->commentManager->getById($id);
    }

    public function increaseDiscussionViewedCount(int $id) : bool
    {
        return $this->discussionManager->increaseViewed($id);
    }
}