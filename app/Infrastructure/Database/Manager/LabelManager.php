<?php declare(strict_types = 1);

namespace Infrastructure\Database\Manager;

use Domain\Label\Entity\LabelEntity;
use Domain\Label\Exception\LabelEntityNotFoundException;
use Domain\Label\Repository\LabelRepositoryInterface;
use Domain\Shared\Collection\Collection;
use Nette\Utils\Arrays;

class LabelManager extends AbstractManager implements LabelRepositoryInterface
{
    public function create(array $data): LabelEntity
    {
        $data['created_at'] = 'now()';
        $data['updated_at'] = 'now()';

        $activeRow = $this->getTable()->insert($data);

        return $this->createLabelEntity($activeRow->toArray());
    }

    public function update(LabelEntity $labelEntity, array $values): bool
    {
        $values['updated_at'] = 'now()';

        $rows = $this->getTable()
            ->where(['id' => $labelEntity->getId()])
            ->update($values);

        return $rows > 0;
    }

    public function getById(int $id): LabelEntity
    {
        $rows = $this->getTable()
            ->where(['id' => $id])
            ->fetchAll();

        if (count($rows) === 1 ) {
            return $this->createLabelEntity(Arrays::first($rows)->toArray());
        } else {
            throw new LabelEntityNotFoundException(sprintf("Id '%d' not found.", $id));
        }
    }

    public function delete(LabelEntity $labelEntity): bool
    {
        $rows = $this->getTable()
            ->where(['id' => $labelEntity->getId()])
            ->delete();

        return $rows > 0;
    }

    public function findAll(): Collection
    {
        $collection = new Collection();

        $selection = $this->getTable()->fetchAll();

        foreach ($selection as $row) {
            $entity = $this->createLabelEntity($row->toArray());

            $collection->addItem($entity);
        }

        return $collection;
    }

    private function createLabelEntity(array $data) : LabelEntity
    {
        return new LabelEntity(
            $data['id'],
            $data['title']
        );
    }
}