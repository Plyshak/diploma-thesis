<?php declare(strict_types = 1);

namespace Infrastructure\Exception;

class BadFileName extends AbstractInfrastructureException
{
    public function __construct(string $fileName)
    {
        parent::__construct(
            sprintf(
                'File name have wrong format: "%s", expected exactly one "." character!.',
                $fileName
            ),
            500
        );
    }
}