<?php declare(strict_types = 1);

namespace Infrastructure\Database\Manager;

use Domain\Course\Repository\CourseRepositoryInterface;
use Domain\Discussion\Entity\DiscussionEntity;
use Domain\Discussion\Repository\CommentRepositoryInterface;
use Domain\Discussion\Repository\DiscussionRepositoryInterface;
use Domain\Shared\Collection\Collection;
use Domain\User\Repository\UsersRepositoryInterface;
use Nette\Database\Explorer;

class DiscussionManager extends AbstractManager implements DiscussionRepositoryInterface
{
    protected $commentManager;
    protected $courseManager;
    protected $userManager;

    public function __construct(
        CommentRepositoryInterface $commentRepository,
        CourseRepositoryInterface $courseRepository,
        UsersRepositoryInterface $usersRepository,
        Explorer $database
    ) {
        parent::__construct($database);

        $this->commentManager = $commentRepository;
        $this->courseManager = $courseRepository;
        $this->userManager = $usersRepository;
    }

    public function createEmpty(int $authorId): DiscussionEntity
    {
        $data = [
            'created_at' => 'now()',
            'updated_at' => 'now()',
            'title' => '',
            'course_id' => null,
            'author_id' => $authorId,
            'viewed' => 0,
            'solved' => false,
        ];

        return $this->create($data);
    }

    public function create(array $data): DiscussionEntity
    {
        $activeRow = $this->getTable()->insert($data);

        return $this->createDiscussionEntity($activeRow->toArray());
    }

    public function getById(int $id): DiscussionEntity
    {
        $activeRow = $this->getTable()
            ->where(['id' => $id])
            ->fetch();

        return $this->createDiscussionEntity($activeRow->toArray());
    }

    public function findAll(): Collection
    {
        $collection = new Collection();

        $rows = $this->getTable()->fetchAll();

        foreach ($rows as $row) {
            $entity = $this->createDiscussionEntity($row->toArray());

            $collection->addItem($entity);
        }

        return $collection;
    }

    public function findAllWithConditions(array $conditions): Collection
    {
        $collection = new Collection();

        $sql = $this->getTable()->getSql();
        $cond = [];

        if (isset($conditions['course_id'])) {
            $cond[] = 'course_id = ' . $conditions['course_id'];
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
            $entity = $this->createDiscussionEntity((array) $row);

            $collection->addItem($entity);
        }

        return $collection;
    }

    public function update(DiscussionEntity $discussionEntity, array $values): bool
    {
        $values['updated_at'] = 'now()';

        $rows = $this->getTable()
            ->where(['id' => $discussionEntity->getId()])
            ->update($values);

        return $rows > 0;
    }

    public function delete(DiscussionEntity $discussionEntity): bool
    {
        $rows = $this->getTable()
            ->where(['id' => $discussionEntity->getId()])
            ->delete();

        return $rows > 0;
    }

    private function createDiscussionEntity(array $data) : DiscussionEntity
    {
        $id = $data['id'];
        $courseId = $data['course_id'];

        if ($courseId) {
            $courseEntity = $this->courseManager->getById($data['course_id']);
        } else {
            $courseEntity = null;
        }

        $author = $this->userManager->getById($data['author_id']);

        $comments = $this->commentManager->findAllByDiscussionId($id);

        return new DiscussionEntity(
            $id,
            $data['created_at'],
            $data['updated_at'],
            $data['title'],
            $courseEntity,
            $author,
            $data['viewed'],
            $data['solved'],
            $comments
        );
    }

    public function increaseViewed(int $id): bool
    {
        $sql = sprintf(
            '
                UPDATE "discussion"
                SET "viewed" = "viewed" + 1
                WHERE "id" = %d
            ',
            $id
        );

        $result = $this->database->query($sql);
        $rows = $result->fetchAll();

        return $rows > 0;
    }
}