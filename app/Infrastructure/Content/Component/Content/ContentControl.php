<?php declare(strict_types = 1);

namespace Infrastructure\Content\Component\Content;

use Domain\Content\Entity\ContentInterface;
use Domain\Content\Entity\Plugin\PluginBlockEntityInterface;
use Domain\Content\Service\ContentService;
use Infrastructure\Component\AbstractControl;
use Infrastructure\Content\Service\PluginService;
use Nette\Application\UI\Multiplier;

class ContentControl extends AbstractControl
{
    protected $contentableEntity;
    protected $contentService;
    protected $pluginService;

    /** @var PluginBlockEntityInterface[] */
    protected $plugins;

    public function __construct(
        ContentInterface $contentEntity,
        ContentService $contentService,
        PluginService $pluginService
    ) {
        $this->contentableEntity = $contentEntity;
        $this->contentService = $contentService;
        $this->pluginService = $pluginService;
    }

    public function addTemplateParameters(): void
    {
        parent::addTemplateParameters();

        $this->template->plugins = $this->plugins = $this->getPlugins();
    }

    public function createComponentPlugin(): Multiplier
    {
        return new Multiplier(function (string $key) {
            $entity = $this->plugins[$key];

            $control = $this->pluginService->getPluginFactory($entity)->create($entity);

            return $control;
        });
    }

    private function getPlugins() : array
    {
        $plugins = [];

        if ($this->contentService->hasContent($this->contentableEntity)) {
            $contentEntity = $this->contentService->getContent($this->contentableEntity);

            $plugins = $this->pluginService->getPlugins($contentEntity);
        }

        return $plugins;
    }
}