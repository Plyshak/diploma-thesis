<?php declare(strict_types = 1);

namespace Infrastructure\Database\Manager;

use Domain\Content\Entity\Plugin\PluginBlockEntityInterface;
use Domain\Content\Entity\Plugin\PluginTextBlockEntity;
use Domain\Content\Exception\PluginBlockEntityNotFoundException;
use Domain\Content\Repository\Plugin\PluginTextBlockRepositoryInterface;
use Nette\Utils\Arrays;

class PluginTextBlockManager extends AbstractManager implements PluginTextBlockRepositoryInterface
{
    public function create(array $data): PluginBlockEntityInterface
    {
        $data['created_at'] = 'now()';
        $data['updated_at'] = 'now()';

        $activeRow = $this->getTable()->insert($data);

        return $this->createPluginTextBlockEntity($activeRow->toArray());
    }

    public function update(PluginBlockEntityInterface $pluginBlockEntity, array $values): bool
    {
        $id = $pluginBlockEntity->getId();

        $values['updated_at'] = 'now()';

        $selection = $this->getTable();
        $selection->where(['id' => $id]);
        $rows = $selection->update($values);

        if ($rows === 1) {
            $success = true;
        } else {
            $success = false;
        }

        return $success;
    }

    public function getById(int $id): PluginBlockEntityInterface
    {
        $rows = $this->getTable()
            ->where(['id' => $id])
            ->fetchAll();

        if (count($rows) === 1 ) {
            return $this->createPluginTextBlockEntity(
                Arrays::first($rows)
                    ->toArray()
            );
        } else {
            throw new PluginBlockEntityNotFoundException(
                'textBlock',
                sprintf('Id "%d" not found.', $id)
            );
        }
    }

    public function delete(PluginBlockEntityInterface $pluginBlockEntity): bool
    {
        $count = $this->getTable()
            ->where(['id' => $pluginBlockEntity->getId()])
            ->delete();

        return $count === 1;
    }

    private function createPluginTextBlockEntity(array $data) : PluginTextBlockEntity
    {
        return new PluginTextBlockEntity(
            $data['id'],
            $data['title'],
            $data['show_title'],
            $data['perex'],
            $data['body'],
            $data['button_title'],
            $data['button_show'],
            $data['button_url'],
            $data['button_blank']
        );
    }
}