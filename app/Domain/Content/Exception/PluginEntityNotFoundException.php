<?php declare(strict_types = 1);

namespace Domain\Content\Exception;

use Domain\Exception\AbstractDomainException;

class PluginEntityNotFoundException extends AbstractDomainException
{
    public function __construct(string $reason)
    {
        $message = sprintf("Content was not found based on criteria: '%s'", $reason);

        parent::__construct(
            $message,
            500
        );
    }
}