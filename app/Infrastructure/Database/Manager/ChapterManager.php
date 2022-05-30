<?php declare(strict_types = 1);

namespace Infrastructure\Database\Manager;

use Domain\Course\Entity\ChapterEntity;
use Domain\Course\Repository\ChapterRepositoryInterface;
use Domain\Course\Repository\PageRepositoryInterface;
use Domain\Shared\Collection\Collection;
use Nette\Database\Explorer;

class ChapterManager extends AbstractManager implements ChapterRepositoryInterface
{
    protected $pageManager;

    public function __construct(
        PageRepositoryInterface $pageManager,
        Explorer $database
    ) {
        parent::__construct($database);

        $this->pageManager = $pageManager;
    }

    public function create(array $data): ChapterEntity
    {
        $data['created_at'] = 'now()';
        $data['updated_at'] = 'now()';

        $activeRow = $this->getTable()
            ->insert($data);

        return $this->createChapterEntity($activeRow->toArray());
    }

    public function update(ChapterEntity $chapterEntity, array $data): bool
    {
        $data['updated_at'] = 'now()';

        $rows = $this->getTable()
            ->where(['id' => $chapterEntity->getId()])
            ->update($data);

        return $rows > 0;
    }

    public function delete(ChapterEntity $chapterEntity): bool
    {
        $rows = $this->getTable()
            ->where(['id' => $chapterEntity->getId()])
            ->delete();

        return $rows > 0;
    }

    public function findAllByCourseId(int $courseId): Collection
    {
        $collection = new Collection();

        $rows = $this->getTable()
            ->where(['course_id' => $courseId])
            ->order('position')
            ->fetchAll();

        foreach ($rows as $row) {
            $entity = $this->createChapterEntity($row->toArray());

            $collection->addItem($entity);
        }

        return $collection;
    }

    public function getById(int $id): ChapterEntity
    {
        $row = $this->getTable()
            ->where(['id' => $id])
            ->fetch();

        return $this->createChapterEntity($row->toArray());
    }

    private function createChapterEntity(array $data) : ChapterEntity
    {
        $id = $data['id'];

        $pages = $this->pageManager->findAllByChapterId($id);

        return new ChapterEntity(
            $id,
            $data['course_id'],
            $data['annotation'],
            $data['position'],
            $data['repetition'],
            $pages
        );
    }
}