<?php declare(strict_types = 1);

namespace Domain\Label\Entity;

interface LabelInterface
{
    public function getId() : int;

    public function getModule() : string;
}