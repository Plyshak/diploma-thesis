<?php declare(strict_types = 1);

namespace Infrastructure\Database\Manager;

use Domain\User\Entity\UserInterface;
use Domain\User\Entity\ValueObject\UserType;
use Domain\User\Exception\UserNotFoundException;
use Domain\User\Repository\UsersRepositoryInterface;
use Domain\User\Repository\UserTypeRepositoryInterface;
use Infrastructure\User\Entity\UserIdentity;
use Nette\Database\Explorer;
use Nette\Utils\Arrays;

class UsersManager extends AbstractManager implements UsersRepositoryInterface
{
    public $userTypeManager;

    public function __construct(
        UserTypeRepositoryInterface $userTypeManager,
        Explorer $database
    ) {
        $this->userTypeManager = $userTypeManager;

        parent::__construct($database);
    }

    public function getById(int $id): UserInterface
    {
        $rows = $this->getTable()
                    ->where(['id' => $id])
                    ->fetchAll();

        if (count($rows) === 1 ) {
            return $this->createUserIdentity(
                Arrays::first($rows)
                    ->toArray()
            );
        } else {
            throw new UserNotFoundException('Id not found.');
        }
    }

    public function getByNameAndPassword(string $name, string $password): UserInterface
    {
        $rows = $this->getTable()
                    ->where([
                        'name' => $name,
                        'password' => $password
                    ])
                    ->fetchAll();

        if (count($rows) === 1 ) {
            return $this->createUserIdentity(
                Arrays::first($rows)
                    ->toArray()
            );
        } else {
            throw new UserNotFoundException('User not found.');
        }
    }

    private function createUserIdentity(array $row) : UserIdentity
    {
        return new UserIdentity(
            $row['id'],
            $row['external_id'],
            $row['name'],
            $this->getUserType($row['type'])
        );
    }

    private function getUserType(int $userTypeId) : UserType
    {
        return $this->userTypeManager->getById($userTypeId);
    }
}