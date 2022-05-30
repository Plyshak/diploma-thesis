<?php declare(strict_types = 1);

namespace Infrastructure\Database\Manager;

use Domain\Content\Entity\Plugin\PluginBlockEntityInterface;
use Domain\Content\Entity\Plugin\PluginCodeBlockEntity;
use Domain\Content\Exception\PluginBlockEntityNotFoundException;
use Domain\Content\Repository\Plugin\PluginCodeBlockRepositoryInterface;
use Nette\Utils\Arrays;

class PluginCodeBlockManager extends AbstractManager implements PluginCodeBlockRepositoryInterface
{
    public function create(array $data): PluginBlockEntityInterface
    {
        $data['created_at'] = 'now()';
        $data['updated_at'] = 'now()';

        $activeRow = $this->getTable()->insert($data);

        return $this->createPluginCodeBlockEntity($activeRow->toArray());
    }

    public function update(PluginBlockEntityInterface $pluginBlockEntity, array $values): bool
    {
        $id = $pluginBlockEntity->getId();

        $values['updated_at'] = 'now()';

        $rows = $this->getTable()
            ->where(['id' => $id])
            ->update($values);

        return $rows > 0;
    }

    public function getById(int $id): PluginBlockEntityInterface
    {
        $rows = $this->getTable()
            ->where(['id' => $id])
            ->fetchAll();

        if (count($rows) === 1 ) {
            return $this->createPluginCodeBlockEntity(
                Arrays::first($rows)
                    ->toArray()
            );
        } else {
            throw new PluginBlockEntityNotFoundException(
                'codeBlock',
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

    private function createPluginCodeBlockEntity(array $data) : PluginCodeBlockEntity
    {
        return new PluginCodeBlockEntity(
            $data['id'],
            $data['title'],
            $data['show_title'],
            $data['code'],
            $data['language']
        );
    }
}