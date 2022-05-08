<?php declare(strict_types = 1);

namespace Infrastructure\Content\Component\AddPlugin;

use Domain\Content\Entity\ContentEntity;

interface AddPluginControlFactory
{
    public function create(ContentEntity $entity): AddPluginControl;
}
