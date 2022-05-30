<?php declare(strict_types = 1);

namespace Infrastructure\Database\Manager;

use Domain\Course\Entity\PageEntity;
use Domain\Course\Repository\PageRepositoryInterface;
use Domain\Shared\Collection\Collection;

class PageManager extends AbstractManager implements PageRepositoryInterface
{
    public function create(array $data): PageEntity
    {
        $data['created_at'] = 'now()';
        $data['updated_at'] = 'now()';

        $row = $this->getTable()
            ->insert($data);

        return $this->createPageEntity($row->toArray());
    }

    public function update(PageEntity $pageEntity, array $data): bool
    {
        $data['updated_at'] = 'now()';

        $rows = $this->getTable()
            ->where(['id' => $pageEntity->getId()])
            ->update($data);

        return $rows > 0;
    }

    public function delete(PageEntity $pageEntity): bool
    {
        $rows = $this->getTable()
            ->where(['id' => $pageEntity->getId()])
            ->delete();

        return $rows > 0;
    }

    public function findAllByChapterId(int $chapterId): Collection
    {
        $collection = new Collection();

        $rows = $this->getTable()
            ->where(['chapter_id' => $chapterId])
            ->order('position')
            ->fetchAll();

        foreach ($rows as $row) {
            $entity = $this->createPageEntity($row->toArray());

            $collection->addItem($entity);
        }

        return $collection;
    }

    public function getById(int $id): PageEntity
    {
        $row = $this->getTable()
            ->where(['id' => $id])
            ->fetch();

        return $this->createPageEntity($row->toArray());
    }

    private function createPageEntity(array $data) : PageEntity
    {
        return new PageEntity(
            $data['id'],
            $data['chapter_id'],
            $data['position']
        );
    }
}