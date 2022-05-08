<?php declare(strict_types = 1);

namespace Infrastructure\Content\Plugin\Component;

use Domain\Content\Entity\Plugin\PluginBlockEntityInterface;
use Domain\Content\Plugin\PluginInterface;

interface PluginControlFactoryInterface
{
    /**
     * @param PluginBlockEntityInterface $entity
     *
     * @return AbstractPluginControl|PluginInterface
     */
    public function create(?PluginBlockEntityInterface $entity = null);
}
