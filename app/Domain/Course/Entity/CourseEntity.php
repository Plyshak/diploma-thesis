<?php declare(strict_types = 1);

namespace Domain\Course\Entity;

use Domain\Label\Entity\LabelInterface;
use Domain\Shared\Collection\Collection;
use Domain\Shared\Collection\CollectionItem;
use Domain\Topic\Entity\TopicEntity;
use Domain\User\Entity\UserInterface;

class CourseEntity implements CollectionItem, LabelInterface
{
    protected $id;
    protected $title;
    protected $author;
    protected $topic;
    protected $annotation;
    protected $public;
    protected $visibility;
    protected $chapters;

    public function __construct(
        int $id,
        ?string $title,
        UserInterface $author,
        ?TopicEntity $topic,
        ?string $annotation,
        bool $public,
        bool $visibility,
        Collection $chapters
    ) {
        $this->id = $id;
        $this->title = $title ?? '';
        $this->author = $author;
        $this->topic = $topic;
        $this->annotation = $annotation ?? '';
        $this->public = $public;
        $this->visibility = $visibility;
        $this->chapters = $chapters;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): UserInterface
    {
        return $this->author;
    }

    public function getTopic(): ?TopicEntity
    {
        return $this->topic;
    }

    public function getAnnotation(): string
    {
        return $this->annotation;
    }

    public function isPublic(): bool
    {
        return $this->public;
    }

    public function isVisibility(): bool
    {
        return $this->visibility;
    }

    public function getChapters(): Collection
    {
        return $this->chapters;
    }

    public function equals(object $item): bool
    {
        return $this->getClass() === $item->getClass()
            && $this->getId() === $item->getId()
            && $this->getTitle() === $item->getTitle()
            && $this->getAuthor() === $item->getAuthor()
            && $this->getTopic() === $item->getTopic()
            && $this->getAnnotation() === $item->getAnnotation()
            && $this->isPublic() === $item->isPublic()
            && $this->isVisibility() === $item->isVisibility()
            && $this->getChapters() === $item->getChpaters();
    }

    public function getClass(): string
    {
        return get_class($this);
    }

    public function getModule(): string
    {
        return 'course';
    }
}