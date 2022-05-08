<?php declare(strict_types = 1);

namespace Domain\Content\Exception;

use Domain\Exception\AbstractDomainException;

class PluginBlockEntityNotFoundException extends AbstractDomainException
{
    public function __construct(string $type, string $reason)
    {
        $message = sprintf("PluginBlock '%s' was not found based on criteria: '%s'", $type, $reason);

        parent::__construct(
            $message,
            500
        );
    }
}