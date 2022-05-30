<?php declare(strict_types = 1);

namespace Infrastructure\Content\Plugin\Component\CodeBlock;

use Domain\Content\Entity\Plugin\PluginBlockEntityInterface;
use Infrastructure\Content\Plugin\Component\PluginControlFactoryInterface;

interface CodeBlockPluginControlFactory extends PluginControlFactoryInterface
{
    public function create(?PluginBlockEntityInterface $entity = null): CodeBlockPluginControl;
}