<?php declare(strict_types = 1);

namespace Infrastructure\Content\Service;

use Domain\Content\Entity\ContentEntity;
use Domain\Content\Entity\Plugin\PluginBlockEntityInterface;
use Domain\Content\Entity\PluginEntity;
use Domain\Content\Repository\Plugin\PluginBlockRepositoryInterface;
use Domain\Content\Repository\PluginRepositoryInterface;
use Infrastructure\Content\Plugin\Component\PluginControlFactoryInterface;
use Nette\DI\Container;
use Nette\Utils\Strings;

class PluginService
{
    public const PLUGIN_MANAGER_NAME = 'database.manager.content.plugin.%s';
    public const PLUGIN_FACTORY_NAME = 'content.plugin.component.%s.factory';

    /** @var PluginRepositoryInterface */
    protected $pluginManager;

    /** @var Container */
    protected $container;

    public function __construct(
        PluginRepositoryInterface $manager,
        Container $container
    ) {
        $this->pluginManager = $manager;
        $this->container = $container;
    }

    public function getPlugins(ContentEntity $entity): array
    {
        $plugins = [];

        $rawPlugins = $this->pluginManager->findByContentEntity($entity);

        foreach ($rawPlugins as $rawPlugin) {
            $plugins[] = $this->getPlugin($rawPlugin);
        }

        return $plugins;
    }

    public function getPluginFactory(PluginBlockEntityInterface $entity): PluginControlFactoryInterface
    {
        /** @var PluginControlFactoryInterface $containerService */
        $containerService = $this->container->getService(
            \sprintf(
                self::PLUGIN_FACTORY_NAME,
                $entity->getPluginPrefix()
            )
        );

        return $containerService;
    }

    public function createPlugin(
        ContentEntity $entity,
        string $prefix,
        array $values,
        int $position
    ) : void {
        $pluginEntity = $this->createPluginEntity($prefix, $values);

        $this->createMSEntity($entity, $prefix, $pluginEntity, $position);
    }

    public function updatePlugin(
        PluginBlockEntityInterface $pluginBlockEntity,
        array $values
    ) : void {
        /** @var PluginBlockRepositoryInterface $manager */
        $manager = $this->container->getService(
            \sprintf(
                self::PLUGIN_MANAGER_NAME,
                $pluginBlockEntity->getPluginPrefix()
            )
        );

        $manager->update($pluginBlockEntity, $values);
    }

    public function deletePlugin(PluginBlockEntityInterface $pluginBlockEntity): void
    {
        $entity = $this->pluginManager->findByPluginBlockEntity($pluginBlockEntity);

        /** @var PluginBlockRepositoryInterface $manager */
        $manager = $this->container->getService(
            \sprintf(
                self::PLUGIN_MANAGER_NAME,
                $pluginBlockEntity->getPluginPrefix()
            )
        );

        $success = $manager->delete($pluginBlockEntity);

        if ($success) {
            $this->pluginManager->delete($entity);
        };
    }

    protected function createPluginEntity(string $prefix, array $values): PluginBlockEntityInterface
    {
        /** @var PluginBlockRepositoryInterface $pluginManager */
        $pluginManager = $this->container->getService(
            \sprintf(self::PLUGIN_MANAGER_NAME, $prefix)
        );

        return $pluginManager->create($values);
    }

    protected function createMSEntity(
        ContentEntity $entity,
        string $prefix,
        PluginBlockEntityInterface $pluginEntity,
        int $position
    ) : void {
        $data = [];
        $data['content_id'] = $entity->getId();
        $data['plugin'] = $prefix;
        $data['plugin_id'] = $pluginEntity->getId();
        $data['position'] = $position;

        $this->pluginManager->create($data);
    }

    protected function getPlugin(PluginEntity $rawPlugin): ?PluginBlockEntityInterface
    {
        /** @var PluginBlockRepositoryInterface $manager */
        $manager = $this->container->getService(
            \sprintf(
                self::PLUGIN_MANAGER_NAME,
                $rawPlugin->getPlugin()
            )
        );

        return $manager->getById($rawPlugin->getPluginId());
    }
}
