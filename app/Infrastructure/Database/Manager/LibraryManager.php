<?php declare(strict_types = 1);

namespace Infrastructure\Database\Manager;

use Domain\Library\Entity\LibraryEntity;
use Domain\Library\Exception\LibraryNotFoundException;
use Domain\Library\Repository\LibraryRepositoryInterface;
use Domain\Shared\Collection\Collection;
use Domain\User\Repository\UsersRepositoryInterface;
use Nette\Database\Explorer;
use Nette\Utils\Arrays;

class LibraryManager extends AbstractManager implements LibraryRepositoryInterface
{
    public const UPLOAD_IMAGE_PATH = 'upload/library/';

    protected $userManager;

    public function __construct(
        UsersRepositoryInterface $userManager,
        Explorer $database
    ) {
        parent::__construct($database);

        $this->userManager = $userManager;
    }

    public function createEmpty(int $authorId): LibraryEntity
    {
        $data = [
            'title' => '',
            'perex' => '',
            'image' => '',
            'created_at' => 'now()',
            'updated_at' => 'now()',
            'author_id' => $authorId,
        ];

        return $this->create($data);
    }

    public function create(array $data): LibraryEntity
    {
        $activeRow = $this->getTable()->insert($data);

        return $this->createLibraryEntity($activeRow->toArray());
    }

    public function findAll(): Collection
    {
        $collection = new Collection();
        $rows = $this->getTable()->fetchAll();

        foreach ($rows as $row) {
            $entity = $this->createLibraryEntity($row->toArray());

            $collection->addItem($entity);
        }

        return $collection;
    }

    public function getCount(): int
    {
        return $this->getTable()->count();
    }

    public function findAllWithConditions(array $conditions): Collection
    {
        $collection = new Collection();
        $selection = $this->getTable();

        $sql = $selection->getSql();
        $cond = [];

        if (isset($conditions['title'])) {
            $cond[] = 'lower("title") LIKE lower(' . "'%" . $conditions['title'] . "%')";
        }

        if (isset($conditions['labels'])) {
            $subQueries = [];

            foreach ($conditions['labels'] as $labelId) {
                $subQueries[] = sprintf("id = (
                                SELECT label_stack_id FROM label_bridge AS lb
                                WHERE
                                        lb.label_stack_id = (
                                        SELECT ls.id FROM label_stack as ls
                                        WHERE
                                                ls.module = 'library'
                                          AND ls.module_id = library.id
                                    )
                                  AND lb.label_id = %d
                                GROUP BY label_stack_id
                            )",
                            $labelId
                );
            }

            $cond[] = sprintf(
                "
                id = (
                    select module_id from label_stack
                        where module = 'library'
                            AND (%s)
                    );"
                , implode(' AND ', $subQueries)
            );
        }

        if (count($cond) > 0) {
            $sql .= sprintf(
                ' where %s',
                implode(' AND ', $cond)
            );
        }

        $result = $this->database->query($sql);
        $rows = $result->fetchAll();

        foreach ($rows as $row) {
            $entity = $this->createLibraryEntity((array) $row);

            $collection->addItem($entity);
        }

        return $collection;
    }

    public function getById(int $id): LibraryEntity
    {
        $rows = $this->getTable()
            ->where(['id' => $id])
            ->fetchAll();

        if (count($rows) === 1 ) {
            return $this->createLibraryEntity(
                Arrays::first($rows)
                    ->toArray()
            );
        } else {
            throw new LibraryNotFoundException(
                sprintf('Id "%d" not found.', $id)
            );
        }
    }

    public function update(LibraryEntity $libraryEntity, array $values): bool
    {
        $id = $libraryEntity->getId();

        $data = [
            'title' => $values['title'],
            'perex' => $values['perex'],
            'updated_at' => 'now()',
        ];

        $data['image'] = $this->uploadFile($data['image']);

        $selection = $this->getTable();
        $selection->where(['id' => $id]);
        $rows = $selection->update($data);

        if ($rows === 1) {
            $success = true;
        } else {
            $success = false;
        }

        return $success;
    }

    public function delete(LibraryEntity $libraryEntity) : bool
    {
        $count = $this->getTable()
            ->where(['id' => $libraryEntity->getId()])
            ->delete();

        return $count === 1;
    }

    private function createLibraryEntity(array $data) : LibraryEntity
    {
        return new LibraryEntity(
            $data['id'],
            $data['title'],
            $data['perex'],
            $data['image'],
            $data['created_at'],
            $data['updated_at'],
            $this->userManager->getById($data['author_id'])
        );
    }
}