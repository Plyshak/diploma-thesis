<?php declare(strict_types = 1);

namespace Infrastructure\Database\Manager;

use Domain\Label\Entity\LabelBridgeEntity;
use Domain\Label\Entity\LabelStackEntity;
use Domain\Label\Repository\LabelBridgeRepositoryInterface;
use Domain\Shared\Collection\Collection;

class LabelBridgeManager extends AbstractManager implements LabelBridgeRepositoryInterface
{
    public function create(array $data): LabelBridgeEntity
    {
        $activeRow = $this->getTable()->insert($data);

        return $this->createLabelBridgeEntity($activeRow->toArray());
    }

    public function delete(LabelBridgeEntity $labelBridgeEntity): bool
    {
        // TODO: Implement delete() method.
    }

    public function deleteByModuleEntity(LabelStackEntity $labelStackEntity): bool
    {
        $this->getTable()
            ->where(['label_stack_id' => $labelStackEntity->getId()])
            ->delete();

        return true;
    }

    public function findAllByLabelStackId(int $labelStackId): Collection
    {
        $collection = new Collection();

        $rows = $this->getTable()
            ->where(['label_stack_id' => $labelStackId])
            ->fetchAll();

        foreach ($rows as $row) {
            $entity = $this->createLabelBridgeEntity($row->toArray());

            $collection->addItem($entity);
        }

        return $collection;
    }

    private function createLabelBridgeEntity(array $data) : LabelBridgeEntity
    {
        return new LabelBridgeEntity(
            $data['id'],
            $data['label_stack_id'],
            $data['label_id']
        );
    }
}