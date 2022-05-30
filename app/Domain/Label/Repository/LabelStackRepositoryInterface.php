<?php declare(strict_types = 1);

namespace Domain\Label\Repository;

use Domain\Label\Entity\LabelInterface;
use Domain\Label\Entity\LabelStackEntity;

interface LabelStackRepositoryInterface
{
    public function create(array $data) : LabelStackEntity;

    public function delete(LabelStackEntity $labelStackEntity) : bool;

    public function findByModuleEntity(LabelInterface $contentEntity) : ?LabelStackEntity;
}