<?php declare(strict_types = 1);

namespace Domain\Rating\Entity;

interface RatingInterface
{
    public function getId() : int;

    public function getModule() : string;
}