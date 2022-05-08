<?php declare(strict_types = 1);

namespace Domain\Library\Exception;

use Domain\Exception\AbstractDomainException;

class LibraryNotFoundException extends AbstractDomainException
{
    public function __construct(string $reason)
    {
        $message = sprintf("Library was not found based on criteria: '%s'", $reason);

        parent::__construct(
            $message,
            500
        );
    }
}