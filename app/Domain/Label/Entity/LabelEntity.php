<?php declare(strict_types = 1);

namespace Domain\Label\Entity;

use Domain\Shared\Collection\CollectionItem;

class LabelEntity implements CollectionItem
{
    protected $id;
    protected $title;

    public function __construct(
        int $id,
        string $title
    ) {
        $this->id = $id;
        $this->title = $title;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * @param LabelEntity $item
     */
    public function equals(object $item): bool
    {
        return $this->getClass() === $item->getClass()
            && $this->id === $item->getId()
            && $this->title === $item->getTitle();
    }

    public function getClass(): string
    {
        return get_class($this);
    }
}