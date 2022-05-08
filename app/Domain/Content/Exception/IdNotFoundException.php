<?php declare(strict_types = 1);

namespace Domain\Content\Exception;

use Domain\Exception\AbstractDomainException;

class IdNotFoundException extends AbstractDomainException
{
    public function __construct(string $reason)
    {
        $message = sprintf("Given object does not have id property needed for loading content. Object class given: '%s'", $reason);

        parent::__construct(
            $message,
            500
        );
    }
}