<?php declare(strict_types = 1);

namespace Domain\Course\Entity;

use Domain\Content\Entity\ContentInterface;
use Domain\Shared\Collection\CollectionItem;

class PageEntity implements CollectionItem, ContentInterface
{
    public const MODULE = 'coursePage';

    protected $id;
    protected $chapterId;
    protected $position;

    public function __construct(
        int $id,
        int $chapterId,
        int $position
    ) {
        $this->id = $id;
        $this->chapterId = $chapterId;
        $this->position = $position;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getChapterId(): int
    {
        return $this->chapterId;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function equals(object $item): bool
    {
        return $this->getClass() === $item->getClass()
            && $this->getId() === $item->getId()
            && $this->getChapterId() === $item->getChapterId()
            && $this->getPosition() === $item->getPosition();
    }

    public function getClass(): string
    {
        return get_class($this);
    }

    public function getModule(): string
    {
        return self::MODULE;
    }
}