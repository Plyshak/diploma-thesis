<?php declare(strict_types = 1);

namespace Domain\Content\Entity;

interface ContentInterface
{
    public function getId() : int;

    public function getModule(): string;
}
