<?php declare(strict_types = 1);

namespace Domain\Discussion\Entity;

use DateTime;
use Domain\Content\Entity\ContentInterface;
use Domain\Course\Entity\CourseEntity;
use Domain\Label\Entity\LabelInterface;
use Domain\Shared\Collection\Collection;
use Domain\Shared\Collection\CollectionItem;
use Domain\User\Entity\UserInterface;

class DiscussionEntity implements CollectionItem, ContentInterface, LabelInterface
{
    protected $id;
    protected $createdAt;
    protected $updatedAt;
    protected $title;
    protected $course;
    protected $author;
    protected $viewed;
    protected $solved;
    protected $comments;

    public function __construct(
        int $id,
        DateTime $createdAt,
        DateTime $updatedAt,
        ?string $title,
        ?CourseEntity $courseEntity,
        UserInterface $author,
        int $viewed,
        bool $solved,
        Collection $comments
    ) {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->title = $title;
        $this->course = $courseEntity;
        $this->author = $author;
        $this->viewed = $viewed;
        $this->solved = $solved;
        $this->comments = $comments;
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

    public function getLastActivity() : DateTime
    {
        $lastActivity = $this->updatedAt;

        $comments = $this->comments;

        /** @var CommentEntity $comment */
        foreach ($comments as $comment) {
            if ($comment->getUpdatedAt() > $lastActivity) {
                $lastActivity = $comment->getUpdatedAt();
            }
        }

        return $lastActivity;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getCourse(): ?CourseEntity
    {
        return $this->course;
    }

    public function getAuthor(): UserInterface
    {
        return $this->author;
    }

    public function getViewed(): int
    {
        return $this->viewed;
    }

    public function isSolved(): bool
    {
        return $this->solved;
    }

    /**
     * @return Collection|CommentEntity[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function getCommentsCount() : int
    {
        return $this->comments->count();
    }

    public function getModule(): string
    {
        return 'discussion';
    }

    public function equals(object $item): bool
    {
        return $this->getClass() === $item->getClass()
            && $this->getId() === $item->getId()
            && $this->getCreatedAt() === $item->getCreatedAt()
            && $this->getUpdatedAt() === $item->getUpdatedAt()
            && $this->getTitle() === $item->getTitle()
            && $this->getCourse()->equals($item->getCourse())
            && $this->getAuthor() === $item->getAuthor()
            && $this->getViewed() === $item->getViewed()
            && $this->isSolved() === $item->isSolved();
    }

    public function getClass(): string
    {
        return get_class($this);
    }
}