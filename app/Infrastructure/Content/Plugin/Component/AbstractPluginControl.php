<?php declare(strict_types = 1);

namespace Infrastructure\Content\Plugin\Component;

use Domain\Content\Entity\Plugin\PluginBlockEntityInterface;
use Infrastructure\Component\AbstractControl;

abstract class AbstractPluginControl extends AbstractControl
{
    /** @var PluginBlockEntityInterface|null */
    protected $entity;

    public function __construct(?PluginBlockEntityInterface $entity = null)
    {
        $this->entity = $entity;
    }

    public function addTemplateParameters(): void
    {
        parent::addTemplateParameters();

        $this->template->entity = $this->entity;
    }
}
