<?php declare(strict_types = 1);

namespace Domain\User\Exception;

use Domain\Exception\AbstractDomainException;

class UserNotFoundException extends AbstractDomainException
{
    public function __construct(string $reason)
    {
        $message = sprintf("User was not was based on criteria: '%s'", $reason);

        parent::__construct(
            $message,
            500
        );
    }
}