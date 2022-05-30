<?php declare(strict_types = 1);

namespace Infrastructure\Content\Plugin\Component\LiveCode;

use Domain\Content\Entity\Plugin\PluginBlockEntityInterface;
use Infrastructure\Content\Plugin\Component\PluginControlFactoryInterface;

interface LiveCodePluginControlFactory extends PluginControlFactoryInterface
{
    public function create(?PluginBlockEntityInterface $entity = null): LiveCodePluginControl;
}