<?php declare(strict_types = 1);

namespace Domain\Library\Repository;

use Domain\Library\Entity\LibraryEntity;
use Domain\Shared\Collection\Collection;

interface LibraryRepositoryInterface
{
    public function createEmpty(int $authorId) : LibraryEntity;

    public function create(array $data) : LibraryEntity;

    public function findAll() : Collection;

    public function getCount() : int;

    public function findAllWithConditions(array $conditions) : Collection;

    public function getById(int $id) : LibraryEntity;

    public function update(LibraryEntity $libraryEntity, array $values) : bool;

    public function delete(LibraryEntity $libraryEntity) : bool;
}