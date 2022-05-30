<?php declare(strict_types = 1);

namespace Infrastructure\Database\Manager;

use Domain\Course\Entity\CourseEntity;
use Domain\Course\Repository\ChapterRepositoryInterface;
use Domain\Course\Repository\CourseRepositoryInterface;
use Domain\Shared\Collection\Collection;
use Domain\Topic\Repository\TopicRepositoryInterface;
use Domain\User\Repository\UsersRepositoryInterface;
use Nette\Database\Explorer;

class CourseManager extends AbstractManager implements CourseRepositoryInterface
{
    protected $userManager;
    protected $topicManager;
    protected $chapterManager;

    public function __construct(
        UsersRepositoryInterface $userManager,
        TopicRepositoryInterface $topicManager,
        ChapterRepositoryInterface $chapterManager,
        Explorer $database
    ) {
        parent::__construct($database);

        $this->userManager = $userManager;
        $this->topicManager = $topicManager;
        $this->chapterManager = $chapterManager;
    }

    public function createEmpty(int $authorId): CourseEntity
    {
        $data = [
            'created_at' => 'now()',
            'updated_at' => 'now()',
            'title' => '',
            'author_id' => $authorId,
            'topic_id' => null,
            'annotation' => '',
            'public' => true,
            'visibility' => false,
        ];

        return $this->create($data);
    }

    public function create(array $data): CourseEntity
    {
        $activeRow = $this->getTable()->insert($data);

        return $this->createCourseEntity($activeRow->toArray());
    }

    public function findAll(): Collection
    {
        $collection = new Collection();
        $rows = $this->getTable()->fetchAll();

        foreach ($rows as $row) {
            $entity = $this->createCourseEntity($row->toArray());

            $collection->addItem($entity);
        }

        return $collection;
    }

    public function findAllWithConditions(array $conditions): Collection
    {
        $collection = new Collection();

        $sql = $this->getTable()->getSql();
        $cond = [];

        if (isset($conditions['user_id'])) {
            $cond[] = sprintf('(visibility = true OR author_id = %d)', $conditions['user_id']);
        } elseif (isset($conditions['visibility'])) {
            $cond[] = 'visibility = true';
        }

        if (isset($conditions['public'])) {
            $cond[] = 'public = true';
        }

        if (isset($conditions['author_id'])) {
            $cond[] = sprintf('author_id = %d', $conditions['author_id']);
        }

        if (isset($conditions['topic_id'])) {
            $cond[] = sprintf('topic_id = %d', $conditions['topic_id']);
        }

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
                                                ls.module = 'course'
                                          AND ls.module_id = course.id
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
                        where module = 'course'
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
            $entity = $this->createCourseEntity((array) $row);

            $collection->addItem($entity);
        }

        return $collection;
    }

    public function getById(int $id): CourseEntity
    {
        $activeRow = $this->getTable()
            ->where(['id' => $id])
            ->fetch();

        return $this->createCourseEntity($activeRow->toArray());
    }

    public function update(CourseEntity $courseEntity, array $data): bool
    {
        $data['updated_at'] = 'now()';

        $rows = $this->getTable()
            ->where(['id' => $courseEntity->getId()])
            ->update($data);

        return $rows > 0;
    }

    public function delete(CourseEntity $courseEntity): bool
    {
        $rows = $this->getTable()
            ->where(['id' => $courseEntity->getId()])
            ->delete();

        return $rows > 0;
    }

    private function createCourseEntity(array $data) : CourseEntity
    {
        $id = $data['id'];

        $author = $this->userManager->getById($data['author_id']);
        $topic = $data['topic_id'] ? $this->topicManager->getById($data['topic_id']) : null;
        $chapters = $this->chapterManager->findAllByCourseId($id);

        return new CourseEntity(
            $id,
            $data['title'],
            $author,
            $topic,
            $data['annotation'],
            $data['public'],
            $data['visibility'],
            $chapters,
        );
    }
}