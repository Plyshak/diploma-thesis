<?php declare(strict_types = 1);

namespace Domain\User\Repository;

use Domain\User\Entity\ValueObject\UserType;
use Domain\User\Exception\UserTypeNotFoundException;

interface UserTypeRepositoryInterface
{
    public function getAll() : array;

    /**
     * @param int $id
     *
     * @return UserType
     *
     * @throws UserTypeNotFoundException
     */
    public function getById(int $id) : UserType;

    /**
     * @param string $code
     *
     * @return UserType
     *
     * @throws UserTypeNotFoundException
     */
    public function getByCode(string $code) : UserType;
}