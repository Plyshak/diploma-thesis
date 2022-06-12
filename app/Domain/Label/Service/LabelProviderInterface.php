<?php declare(strict_types = 1);

namespace Domain\Label\Service;

use Domain\Label\Entity\LabelInterface;
use Domain\Shared\Collection\Collection;

interface LabelProviderInterface
{
    public function getAllLabels() : Collection;
    public function hasEntityLabels(LabelInterface $labelEntity) : bool;
    public function getEntityLabels(LabelInterface $labelEntity) : Collection;
    public function addLabelToEntity(LabelInterface $labelEntity, array $data) : void;
    public function setLabelsToEntity(LabelInterface $labelEntity, array $labels) : bool;
}