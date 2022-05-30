<?php declare(strict_types = 1);

namespace Domain\Discussion\Entity;

use DateTime;
use Domain\Content\Entity\ContentInterface;
use Domain\Rating\Entity\RatingInterface;
use Domain\Shared\Collection\CollectionItem;
use Domain\User\Entity\UserInterface;

class CommentEntity implements CollectionItem, RatingInterface, ContentInterface
{
    protected $id;
    protected $createdAt;
    protected $updatedAt;
    protected $discussionId;
    protected $author;

    public function __construct(
        int $id,
        DateTime $createdAt,
        DateTime $updatedAt,
        int $discussionId,
        UserInterface $author
    ) {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->discussionId = $discussionId;
        $this->author = $author;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function getDiscussionId(): int
    {
        return $this->discussionId;
    }

    public function getAuthor(): UserInterface
    {
        return $this->author;
    }

    public function getModule(): string
    {
        return 'comment';
    }

    public function equals(object $item): bool
    {
        return $this->getClass() === $item->getClass()
            && $this->getId() === $item->getId()
            && $this->getCreatedAt() === $item->getCreatedAt()
            && $this->getUpdatedAt() === $item->getUpdatedAt()
            && $this->getDiscussionId() === $item->getDiscussionId()
            && $this->getAuthor() === $this->getAuthor();
    }

    public function getClass(): string
    {
        return get_class($this);
    }
}