<?php declare(strict_types = 1);

namespace Infrastructure\Content\Plugin\Component\TestForm;

use Domain\Content\Entity\Plugin\PluginBlockEntityInterface;
use Infrastructure\Content\Plugin\Component\PluginControlFactoryInterface;

interface TestFormPluginControlFactory extends PluginControlFactoryInterface
{
    public function create(?PluginBlockEntityInterface $entity = null): TestFormPluginControl;
}