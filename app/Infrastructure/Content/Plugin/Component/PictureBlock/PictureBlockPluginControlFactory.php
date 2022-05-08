<?php declare(strict_types = 1);

namespace Infrastructure\Content\Plugin\Component\PictureBlock;

use Domain\Content\Entity\Plugin\PluginBlockEntityInterface;
use Infrastructure\Content\Plugin\Component\PluginControlFactoryInterface;

interface PictureBlockPluginControlFactory extends PluginControlFactoryInterface
{
    public function create(?PluginBlockEntityInterface $entity = null): PictureBlockPluginControl;
}
