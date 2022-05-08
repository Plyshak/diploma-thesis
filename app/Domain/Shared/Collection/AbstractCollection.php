<?php declare(strict_types = 1);

namespace Domain\Shared\Collection;

abstract class AbstractCollection
{
    protected $collection;

    public function __construct(CollectionItem ...$collectionItems)
    {
        $this->collection = new Collection();

        foreach ($collectionItems as $collectionItem) {
            $this->add($collectionItem);
        }
    }

    public function add(CollectionItem $item) : void
    {
        if (!$this->contains($item)) {
            $this->collection->addItem($item);
        }
    }

    public function contains(CollectionItem $collectionItem) : bool
    {
        return $this->collection->contains($collectionItem);
    }
}