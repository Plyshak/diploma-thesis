<?php declare(strict_types = 1);

namespace Domain\User\Repository;

use Domain\Shared\Collection\Collection;
use Domain\User\Entity\UserInterface;

interface UsersRepositoryInterface
{
    public function getById(int $id) : UserInterface;

    public function getByNameAndPassword(string $name, string $password) : UserInterface;

    public function findAllByType(string $type) : Collection;

    public function findAll() : Collection;
}