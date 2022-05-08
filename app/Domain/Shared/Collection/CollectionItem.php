<?php declare(strict_types = 1);

namespace Domain\Shared\Collection;

interface CollectionItem
{
    public function equals(object $item) : bool;

    public function getClass() : string;
}