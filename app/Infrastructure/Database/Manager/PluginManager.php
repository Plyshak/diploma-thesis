<?php declare(strict_types = 1);

namespace Infrastructure\Database\Manager;

use Domain\Content\Entity\ContentEntity;
use Domain\Content\Entity\Plugin\PluginBlockEntityInterface;
use Domain\Content\Entity\PluginEntity;
use Domain\Content\Exception\PluginEntityNotFoundException;
use Domain\Content\Repository\ContentRepositoryInterface;
use Domain\Content\Repository\PluginRepositoryInterface;
use Nette\Database\Explorer;
use Nette\Utils\Arrays;

class PluginManager extends AbstractManager implements PluginRepositoryInterface
{
    /** @var ContentRepositoryInterface */
    protected $contentManager;

    public function __construct(
        Explorer $database,
        ContentRepositoryInterface $contentManager
    ) {
        parent::__construct($database);

        $this->contentManager = $contentManager;
    }

    public function create(array $data): PluginEntity
    {
        $data['created_at'] = 'now()';
        $data['updated_at'] = 'now()';

        $activeRow = $this->getTable()->insert($data);

        return $this->createPluginEntity($activeRow->toArray());
    }

    public function findByContentEntity(ContentEntity $contentEntity): array
    {
        $result = [];

        $rows = $this->getTable()
            ->where(['content_id' => $contentEntity->getId()])
            ->order('position')
            ->fetchAll();

        foreach ($rows as $row) {
            $entity = $this->createPluginEntity($row->toArray());

            $result[$entity->getId()] = $entity;
        }

        return $result;
    }

    public function findByPluginBlockEntity(PluginBlockEntityInterface $pluginEntity): PluginEntity
    {
        $rows = $this->getTable()
            ->where([
                'plugin' => $pluginEntity->getPluginPrefix(),
                'plugin_id' => $pluginEntity->getId(),
            ])
            ->fetchAll();

        if (count($rows) === 1 ) {
            return $this->createPluginEntity(
                Arrays::first($rows)
                    ->toArray()
            );
        } else {
            throw new PluginEntityNotFoundException(
                sprintf(
                    'Not found plugin "%s" reference with id "%d"',
                    $pluginEntity->getPluginPrefix(),
                    $pluginEntity->getId()
                )
            );
        }
    }

    public function delete(PluginEntity $pluginEntity): bool
    {
        $count = $this->getTable()
            ->where(['id' => $pluginEntity->getId()])
            ->delete();

        return $count === 1;
    }

    public function update(PluginEntity $pluginEntity, array $values) : bool
    {
        $values['updated_at'] = 'now()';

        $rows = $this->getTable()
            ->where(['id' => $pluginEntity->getId()])
            ->update($values);

        return $rows > 1;
    }

    public function updatePosition(PluginEntity $pluginEntity) : bool
    {
        $sql = sprintf('
            UPDATE plugin
            SET position = (position + 1)
            WHERE 
                id = %d
        ', $pluginEntity->getId());

        $rows = $this->database->query($sql)
            ->fetchAll();

        return $rows > 0;
    }

    private function createPluginEntity(array $data) : PluginEntity
    {
        return new PluginEntity(
            $data['id'],
            $this->contentManager->getById($data['content_id']),
            $data['plugin'],
            $data['plugin_id'],
            $data['visibility'],
            $data['position']
        );
    }
}