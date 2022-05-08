<?php declare(strict_types = 1);

namespace Domain\Content\Repository\Plugin;

use Domain\Content\Entity\Plugin\PluginBlockEntityInterface;

interface PluginBlockRepositoryInterface
{
    public function create(array $data) : PluginBlockEntityInterface;

    public function update(PluginBlockEntityInterface $pluginBlockEntity, array $values) : bool;

    public function getById(int $id) : PluginBlockEntityInterface;

    public function delete(PluginBlockEntityInterface $pluginBlockEntity) : bool;
}