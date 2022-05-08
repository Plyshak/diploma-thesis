<?php declare(strict_types = 1);

namespace Domain\Label\Exception;

use Domain\Exception\AbstractDomainException;

class LabelEntityNotFoundException extends AbstractDomainException
{
    public function __construct(string $reason)
    {
        $message = sprintf("Label was not found based on criteria: '%s'", $reason);

        parent::__construct(
            $message,
            500
        );
    }
}