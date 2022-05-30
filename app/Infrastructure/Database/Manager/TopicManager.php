<?php declare(strict_types = 1);

namespace Infrastructure\Database\Manager;

use Domain\Shared\Collection\Collection;
use Domain\Topic\Entity\TopicEntity;
use Domain\Topic\Repository\TopicRepositoryInterface;

class TopicManager extends AbstractManager implements TopicRepositoryInterface
{
    public function create(array $data): TopicEntity
    {
        $data['created_at'] = 'now()';
        $data['updated_at'] = 'now()';

        $activeRow = $this->getTable()->insert($data);

        return $this->createTopicEntity($activeRow->toArray());
    }

    public function findAll(): Collection
    {
        $collection = new Collection();

        $selection = $this->getTable()->fetchAll();

        foreach ($selection as $row) {
            $entity = $this->createTopicEntity($row->toArray());

            $collection->addItem($entity);
        }

        return $collection;
    }

    public function update(TopicEntity $topicEntity, array $data): bool
    {
        $data['updated_at'] = 'now()';

        $selection = $this->getTable();
        $selection->where(['id' => $topicEntity->getId()]);
        $rows = $selection->update($data);

        return $rows === 1;
    }

    public function delete(TopicEntity $topicEntity): bool
    {
        $rows = $this->getTable()
            ->where(['id' => $topicEntity->getId()])
            ->delete();

        return $rows === 1;
    }

    public function getById(int $id): TopicEntity
    {
        $activeRow = $this->getTable()
            ->where(['id' => $id])
            ->fetch();

        return $this->createTopicEntity($activeRow->toArray());
    }

    private function createTopicEntity(array $data) : TopicEntity
    {
        return new TopicEntity(
            $data['id'],
            $data['title']
        );
    }
}