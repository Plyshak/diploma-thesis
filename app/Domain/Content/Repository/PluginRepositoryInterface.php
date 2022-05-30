<?php declare(strict_types = 1);

namespace Domain\Content\Repository;

use Domain\Content\Entity\ContentEntity;
use Domain\Content\Entity\Plugin\PluginBlockEntityInterface;
use Domain\Content\Entity\PluginEntity;

interface PluginRepositoryInterface
{
    public function create(array $data) : PluginEntity;

    public function findByContentEntity(ContentEntity $contentEntity) : array;

    public function findByPluginBlockEntity(PluginBlockEntityInterface $pluginEntity) : PluginEntity;

    public function delete(PluginEntity $pluginEntity) : bool;

    public function update(PluginEntity $pluginEntity, array $values) : bool;

    public function updatePosition(PluginEntity $pluginEntity);
}