<?php declare(strict_types = 1);

namespace Infrastructure\Content\Component\ListPlugin;

use Domain\Content\Entity\ContentEntity;

interface ListPluginControlFactory
{
    public function create(ContentEntity $entity): ListPluginControl;
}
