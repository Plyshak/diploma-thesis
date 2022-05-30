<?php declare(strict_types = 1);

namespace Domain\Content\Repository\Plugin\LiveCode;

interface LiveCodeDatabaseRepositoryInterface
{
    public function execute(string $sql) : array;
}