<?php declare(strict_types = 1);

namespace Infrastructure\User\Entity;

use Domain\User\Entity\UserInterface;
use Domain\User\Entity\ValueObject\UserType;
use Nette\Security\IIdentity;

class UserIdentity implements IIdentity, UserInterface
{
    protected $id;
    protected $externalId;
    protected $name;
    protected $type;

    public function __construct(
        int $id,
        int $externalId,
        string $name,
        UserType $userType
    ) {
        $this->id = $id;
        $this->externalId = $externalId;
        $this->name = $name;
        $this->type = $userType;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getExternalId() : int
    {
        return $this->externalId;
    }

    public function getRoles(): array
    {
        return [];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): UserType
    {
        return $this->type;
    }

    public function equals(object $item): bool
    {
        return $this->getClass() === $item->getClass()
            && $this->getId() === $item->getId()
            && $this->getExternalId() === $item->getExternalId()
            && $this->getRoles() === $item->getRoles()
            && $this->getName() === $item->getName()
            && $this->getType() === $item->getType();
    }

    public function getClass(): string
    {
        return get_class($this);
    }

    public function getData() : array
    {
        return [];
    }
}