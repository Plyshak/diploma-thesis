<?php declare(strict_types = 1);

namespace Infrastructure\Database\Service;

use Infrastructure\Database\Manager\UserTypeManager;

class Database
{
    protected $userTypeManager;

    public function __construct(
        UserTypeManager $userTypeManager
    ) {
        $this->userTypeManager = $userTypeManager;
    }

    public function getUserTypeManager() : UserTypeManager
    {
        return $this->userTypeManager;
    }
}