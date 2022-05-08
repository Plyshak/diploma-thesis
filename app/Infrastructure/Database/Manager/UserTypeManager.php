<?php declare(strict_types = 1);

namespace Infrastructure\Database\Manager;

use Domain\User\Entity\ValueObject\UserType;
use Domain\User\Exception\UserTypeNotFoundException;
use Domain\User\Repository\UserTypeRepositoryInterface;
use Nette\Utils\Arrays;

class UserTypeManager extends AbstractManager implements UserTypeRepositoryInterface
{
    public function getAll(): array
    {
        $userTypes = [];
        $rows = $this->getTable()->fetchAll();

        foreach ($rows as $row) {
            $userTypes[] = $this->createUserType($row->toArray());
        }

        return $userTypes;
    }

    public function getById(int $id): UserType
    {
        $rows = $this->getTable()
                    ->where(['id' => $id])
                    ->fetchAll();

        if (count($rows) === 1 ) {
            return $this->createUserType(
                Arrays::first($rows)
                    ->toArray()
            );
        } else {
            throw new UserTypeNotFoundException('Id not found.');
        }
    }

    public function getByCode(string $code): UserType
    {
        $rows = $this->getTable()
                    ->where(['code' => $code])
                    ->fetchAll();

        if (count($rows) === 1 ) {
            return $this->createUserType(
                Arrays::first($rows)
                    ->toArray()
            );
        } else {
            throw new UserTypeNotFoundException('Code not found');
        }
    }

    private function createUserType(array $data) : UserType
    {
        return new UserType(
            $data['name'],
            $data['code'],
            $data['permissions']
        );
    }
}