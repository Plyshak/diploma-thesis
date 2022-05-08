<?php declare(strict_types = 1);

namespace Infrastructure\Database\Manager;

use Domain\Content\Entity\ContentEntity;
use Domain\Content\Entity\ContentInterface;
use Domain\Content\Exception\ContentEntityNotFoundException;
use Domain\Content\Repository\ContentRepositoryInterface;
use Nette\Utils\Arrays;

class ContentManager extends AbstractManager implements ContentRepositoryInterface
{
    public function create(array $data) : ContentEntity
    {
        $data['created_at'] = 'now()';
        $data['updated_at'] = 'now()';

        $activeRow = $this->getTable()->insert($data);

        return $this->createContentEntity($activeRow->toArray());
    }

    public function getById(int $id): ContentEntity
    {
        $rows = $this->getTable()
            ->where(['id' => $id])
            ->fetchAll();

        if (count($rows) === 1 ) {
            return $this->createContentEntity(
                Arrays::first($rows)
                    ->toArray()
            );
        } else {
            throw new ContentEntityNotFoundException(sprintf('Content Id: "%d" not found.', $id));
        }
    }

    public function delete(ContentEntity $contentEntity) : bool
    {
        $count = $this->getTable()
            ->where(['id' => $contentEntity->getId()])
            ->delete();

        return $count === 1;    }

    public function findByModuleEntity(ContentInterface $contentEntity) : ?ContentEntity
    {
        $entity = null;

        $rows = $this->getTable()
            ->where([
                'module' => $contentEntity->getModule(),
                'module_id' => $contentEntity->getId(),
            ])
            ->fetchAll();

        if (count($rows) === 1) {
            $entity = $this->createContentEntity(Arrays::first($rows)->toArray());
        }

        return $entity;
    }

    private function createContentEntity(array $data) : ContentEntity
    {
        return new ContentEntity(
            $data['id'],
            $data['module'],
            $data['module_id']
        );
    }
}