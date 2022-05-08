<?php declare(strict_types = 1);

namespace Domain\User\Entity\ValueObject;

class UserType
{
    public const CODE_GUEST = 'GUEST';
    public const CODE_USER = 'USER';
    public const CODE_LECTOR = 'LECTOR';
    public const CODE_ADMINISTRATOR = 'ADMINISTRATOR';

    protected $name;
    protected $code;
    protected $permissionLevel;

    public function __construct(
        string $name,
        string $code,
        int $permissionLevel
    ) {
        $this->name = $name;
        $this->code = $code;
        $this->permissionLevel = $permissionLevel;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getPermissionLevel(): int
    {
        return $this->permissionLevel;
    }
}