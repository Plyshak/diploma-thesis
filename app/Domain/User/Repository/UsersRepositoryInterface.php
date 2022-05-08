<?php declare(strict_types = 1);

namespace Domain\User\Repository;

use Domain\User\Entity\UserInterface;
use Domain\User\Exception\UserNotFoundException;

interface UsersRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return UserInterface
     *
     * @throws UserNotFoundException
     */
    public function getById(int $id) : UserInterface;

    /**
     * @param string $name
     * @param string $password
     *
     * @return UserInterface
     *
     * @throws UserNotFoundException
     */
    public function getByNameAndPassword(string $name, string $password) : UserInterface;
}