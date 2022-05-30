<?php declare(strict_types = 1);

namespace Infrastructure\Database\Manager\LiveCode;

use Domain\Content\Repository\Plugin\LiveCode\LiveCodeDatabaseRepositoryInterface;
use Nette\Database\Explorer;

class LiveCodeManager implements LiveCodeDatabaseRepositoryInterface
{
    protected $database;

    public function __construct(
        Explorer $explorer
    ) {
        $this->database = $explorer;
    }

    public function execute(string $sql): array
    {
        return $this->database->query($sql)->fetchAll();
    }
}