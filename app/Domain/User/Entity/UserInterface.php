<?php declare(strict_types = 1);

namespace Domain\User\Entity;

use Domain\Shared\Collection\CollectionItem;
use Domain\User\Entity\ValueObject\UserType;

interface UserInterface extends CollectionItem
{
    public function getId() : int;

    public function getExternalId() : int;

    public function getName() : string;

    public function getType() : UserType;
}