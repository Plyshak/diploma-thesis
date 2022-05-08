<?php declare(strict_types = 1);

namespace Domain\Label\Repository;

use Domain\Label\Entity\LabelBridgeEntity;
use Domain\Label\Entity\LabelStackEntity;
use Domain\Shared\Collection\Collection;

interface LabelBridgeRepositoryInterface
{
    public function create(array $data) : LabelBridgeEntity;

    public function delete(LabelBridgeEntity $labelBridgeEntity) : bool;

    public function findAllByLabelStackId(int $labelStackId) : Collection;

    public function deleteByModuleEntity(LabelStackEntity $labelStackEntity) : bool;
}