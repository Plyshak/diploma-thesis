<?php declare(strict_types = 1);

namespace Domain\Label\Entity;

use Domain\Shared\Collection\CollectionItem;

class LabelBridgeEntity implements CollectionItem
{
    protected $id;
    protected $labelStackId;
    protected $labelId;

    public function __construct(int $id, int $labelStackId, int $labelId)
    {
        $this->id = $id;
        $this->labelStackId = $labelStackId;
        $this->labelId = $labelId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLabelStackId(): int
    {
        return $this->labelStackId;
    }

    public function getLabelId(): int
    {
        return $this->labelId;
    }

    public function equals(object $item): bool
    {
        return $this->getClass() === $item->getClass()
            && $this->getId() === $item->getId()
            && $this->getLabelStackId() === $item->getLabelStackId()
            && $this->getLabelId() === $item->getLabelId();
    }

    public function getClass(): string
    {
        return get_class($this);
    }
}