<?php declare(strict_types = 1);

/**
 * Po pridani noveho pluginu je potreba odpalit udalost,
 * ktera probubla do listu a ten si nad sebou zavola redrawControl,
 * jinak je potreba refresh stranky aby se novy plugin zobrazil
 */

namespace Infrastructure\Content\Component\AddPlugin;

use Domain\Content\Entity\ContentEntity;
use Infrastructure\Component\AbstractControl;
use Infrastructure\Content\Plugin\Component\PluginControlFactoryInterface;
use Infrastructure\Content\Service\PluginFormFactoryService;
use Infrastructure\Content\Service\PluginService;
use Nette\Application\UI\Form;

class AddPluginControl extends AbstractControl
{
    /** @var string @persistent */
    public $addPluginFactory;

    /** @var callable */
    public $onAfterPluginAdded = [];

    /** @var ContentEntity */
    protected $entity;

    /** @var PluginControlFactoryInterface[] */
    protected $pluginFactories;

    /** @var PluginService */
    protected $service;

    /** @var PluginFormFactoryService */
    protected $pluginFormFactoryService;

    /** @var array */
    protected $allowedPlugins;

    /** @var int */
    protected $position;

    /**
     * @param ContentEntity $entity
     * @param PluginService $service
     * @param PluginFormFactoryService $pluginFormFactoryService
     * @param PluginControlFactoryInterface[] $factories
     */
    public function __construct(
        ContentEntity $entity,
        PluginService $service,
        PluginFormFactoryService $pluginFormFactoryService,
        array $factories
    ) {
        $this->entity = $entity;
        $this->service = $service;
        $this->pluginFormFactoryService = $pluginFormFactoryService;
        $this->pluginFactories = $factories;
    }

    public function handleAddPlugin(string $prefix): void
    {
        $this->addPluginFactory = $prefix;
        $this->redrawControl();
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function addTemplateParameters(): void
    {
        parent::addTemplateParameters();

        $this->template->plugins = $this->getAllowedPlugins();
        $this->template->addPluginFactory = $this->addPluginFactory;
    }

    protected function getAllowedPlugins(): array
    {
        if (!$this->allowedPlugins) {
            foreach ($this->pluginFactories as $factory) {
                $control = $factory->create();

                if ($control->isAvailable($this->entity)) {
                    $this->allowedPlugins[$control->getPluginPrefix()] = $control->getPluginName();
                }
            }
        }

        return $this->allowedPlugins;
    }

    protected function createComponentFactory(): Form
    {
        $control = $this->pluginFormFactoryService->createPluginForm($this->addPluginFactory);
        $control->onSuccess[] = function (Form $form) {
            $pluginEntity = $this->service->createPlugin(
                $this->entity,
                $this->addPluginFactory,
                $form->getvalues('array'),
                $this->position
            );

            $this->addPluginFactory = null;
            $this->redrawControl();

            $this->onAfterPluginAdded($pluginEntity);
        };

        return $control;
    }
}
