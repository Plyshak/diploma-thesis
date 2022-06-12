<?php declare(strict_types = 1);

namespace Infrastructure\Content\Component\ListPlugin;

use Domain\Content\Entity\ContentEntity;
use Domain\Content\Entity\Plugin\PluginBlockEntityInterface;
use Domain\Content\Entity\PluginEntity;
use Domain\Content\Plugin\Component\PluginFormFactoryInterface;
use Infrastructure\Component\AbstractControl;
use Infrastructure\Content\Component\AddPlugin\AddPluginControlFactory;
use Infrastructure\Content\Service\PluginService;
use Nette\Application\UI\Form;
use Nette\Application\UI\Multiplier;

class ListPluginControl extends AbstractControl
{
    /** @var ContentEntity */
    protected $entity;

    /** @var PluginService */
    protected $pluginService;

    /** @var PluginBlockEntityInterface[] */
    protected $plugins;

    /** @var AddPluginControlFactory */
    protected $addPluginControlFactory;

    /** @var PluginFormFactoryInterface */
    protected $pluginFormFactoryService;

    /** @var bool */
    protected $live = false;

    public function __construct(
        ContentEntity $entity,
        PluginService $service,
        AddPluginControlFactory $addPluginControlFactory,
        PluginFormFactoryInterface $pluginFormFactoryService
    ) {
        $this->entity = $entity;
        $this->pluginService = $service;
        $this->addPluginControlFactory = $addPluginControlFactory;
        $this->pluginFormFactoryService = $pluginFormFactoryService;
    }

    public function handleLiveView(bool $value): void
    {
        $this->live = $value;
        $this->redrawControl();
    }

    public function handleDelete(int $position): void
    {
        $plugins = $this->pluginService->getPlugins($this->entity);

        $this->pluginService->deletePlugin($plugins[$position]);
        $this->redrawControl();
    }

    public function addTemplateParameters(): void
    {
        parent::addTemplateParameters();

        $this->template->entity = $this->entity;
        $this->template->plugins = $this->plugins = $this->pluginService->getPlugins($this->entity);
        $this->template->live = $this->live;
    }

    public function createComponentAddPlugin(): Multiplier
    {
        return new Multiplier(function (string $position) {
            $control = $this->addPluginControlFactory->create($this->entity);
            $control->setPosition((int) $position);
            $control->onAfterPluginAdded[] = function(PluginEntity $pluginEntity) use ($position) {
                $this->pluginService->increasePluginsPosition($this->entity, $pluginEntity, $position);

                $this->redrawControl();
            };

            return $control;
        });
    }

    public function createComponentPlugin(): Multiplier
    {
        return new Multiplier(function (string $i) {
            $this->plugins = $this->pluginService->getPlugins($this->entity);

            $control = $this->pluginFormFactoryService->getPluginForm($this->plugins[$i]);

            $control->onSuccess[] = function (Form $form, array $values) use ($i) {
                $this->pluginService->updatePlugin($this->plugins[$i], $values);
                $this->redrawControl();
            };

            return $control;
        });
    }

    public function createComponentLivePlugin(): Multiplier
    {
        return new Multiplier(function (string $key) {
            $entity = $this->plugins[$key];

            $control = $this->pluginService->getPluginFactory($entity)->create($entity);

            return $control;
        });
    }
}
