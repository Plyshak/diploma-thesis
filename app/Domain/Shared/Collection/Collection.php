<?php declare(strict_types = 1);

namespace Domain\Shared\Collection;

use Countable;
use Iterator;

class Collection implements Iterator, Countable
{
    protected $position = 0;
    protected $items = [];

    public function addItem(CollectionItem $item) : void
    {
        $this->items[] = $item;
    }

    public function getItem(int $position) : CollectionItem
    {
        return $this->items[$position];
    }

    public function removeItem(CollectionItem $item) : void
    {
        $position = 0;

        while ($this->getItem($position)->equals($item) === false) {
            $position++;
        }

        $this->removeItemByPosition($position);
    }

    public function removeItemByPosition(int $position) : void
    {
        unset($this->items[$position]);
        $this->items = array_values($this->items);
        $this->rewind();
    }

    public function contains(CollectionItem $item) : bool
    {
        foreach ($this->items as $collectionItem) {
            if ($item->equals($collectionItem)) {
                return true;
            }
        }

        return false;
    }

    public function current() : CollectionItem
    {
        return $this->items[$this->position];
    }

    public function next() : void
    {
        ++$this->position;
    }

    public function key() : int
    {
        return $this->position;
    }

    public function valid() : bool
    {
        return isset($this->items[$this->position]);
    }

    public function rewind() : void
    {
        $this->position = 0;
    }

    public function count() : int
    {
        return count($this->items);
    }

    public function first() : ?CollectionItem
    {
        $item = null;

        if ($this->count() > 0) {
            $this->position = 0;
            $item = $this->items[$this->position];
        }

        return $item;
    }

    public function last() : ?CollectionItem
    {
        $item = null;

        if ($this->count() > 0) {
            $this->position = $this->count() - 1;
            $item = $this->items[$this->position];
        }

        return $item;
    }

    public function isFirst(CollectionItem $collectionItem) : bool
    {
        return $collectionItem->equals($this->first());
    }

    public function isLast(CollectionItem $collectionItem) : bool
    {
        return $collectionItem->equals($this->last());
    }
}