<?php declare(strict_types = 1);

namespace Domain\Course\Entity;

use Domain\Shared\Collection\Collection;
use Domain\Shared\Collection\CollectionItem;

class ChapterEntity implements CollectionItem
{
    protected $id;
    protected $courseId;
    protected $annotation;
    protected $position;
    protected $repetition;
    protected $pages;

    public function __construct(
        int $id,
        int $courseId,
        ?string $annotation,
        int $position,
        bool $repetition,
        Collection $pages
    ) {
        $this->id = $id;
        $this->courseId = $courseId;
        $this->annotation = $annotation ?? '';
        $this->position = $position;
        $this->repetition = $repetition;
        $this->pages = $pages;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCourseId(): int
    {
        return $this->courseId;
    }

    public function getAnnotation(): string
    {
        return $this->annotation;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function isRepetition(): bool
    {
        return $this->repetition;
    }

    public function getPages(): Collection
    {
        return $this->pages;
    }

    public function equals(object $item): bool
    {
        return $this->getClass() === $item->getClass()
            && $this->getId() === $item->getId()
            && $this->getCourseId() === $item->getCourseId()
            && $this->getAnnotation() === $item->getAnnotation()
            && $this->getPosition() === $item->getPosition()
            && $this->isRepetition() === $item->isRepetition()
            && $this->getPages() === $item->getPages();
    }

    public function getClass(): string
    {
        return get_class($this);
    }
}