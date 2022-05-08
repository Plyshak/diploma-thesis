<?php declare(strict_types = 1);

namespace Infrastructure\Content\Plugin\Component\TextBlock;

use Domain\Content\Entity\Plugin\PluginBlockEntityInterface;
use Infrastructure\Content\Plugin\Component\PluginControlFactoryInterface;

interface TextBlockPluginControlFactory extends PluginControlFactoryInterface
{
    public function create(?PluginBlockEntityInterface $entity = null): TextBlockPluginControl;
}
