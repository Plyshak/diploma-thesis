<?php declare(strict_types = 1);

namespace Domain\Label\Repository;

use Domain\Label\Entity\LabelEntity;
use Domain\Shared\Collection\Collection;

interface LabelRepositoryInterface
{
    public function create(array $data) : LabelEntity;

    public function update(LabelEntity $labelEntity, array $values) : bool;

    public function findAll() : Collection;

    public function getById(int $id) : LabelEntity;

    public function delete(LabelEntity $labelEntity) : bool;
}