<?php declare(strict_types = 1);

namespace Infrastructure\Database\Manager;

use Domain\Discussion\Entity\CommentEntity;
use Domain\Discussion\Repository\CommentRepositoryInterface;
use Domain\Shared\Collection\Collection;
use Domain\User\Repository\UsersRepositoryInterface;
use Nette\Database\Explorer;

class CommentManager extends AbstractManager implements CommentRepositoryInterface
{
    protected $userManager;

    public function __construct(
        UsersRepositoryInterface $usersRepository,
        Explorer $database
    ) {
        parent::__construct($database);

        $this->userManager = $usersRepository;
    }

    public function create(array $data): CommentEntity
    {
        $data['created_at'] = 'now()';
        $data['updated_at'] = 'now()';

        $activeRow = $this->getTable()->insert($data);

        return $this->createCommentEntity($activeRow->toArray());
    }

    public function getById(int $id): CommentEntity
    {
        $activeRow = $this->getTable()
            ->where(['id' => $id])
            ->fetch();

        return $this->createCommentEntity($activeRow->toArray());
    }

    public function findAllByDiscussionId(int $discussionId): Collection
    {
        $collection = new Collection();

        $rows = $this->getTable()
            ->where(['discussion_id' => $discussionId])
            ->fetchAll();

        foreach ($rows as $row) {
            $entity = $this->createCommentEntity($row->toArray());

            $collection->addItem($entity);
        }

        return $collection;
    }

    public function update(CommentEntity $commentEntity, array $data): bool
    {
        $values['updated_at'] = 'now()';

        $rows = $this->getTable()
            ->where(['id' => $commentEntity->getId()])
            ->update($values);

        return $rows > 0;
    }

    public function delete(CommentEntity $commentEntity): bool
    {
        $rows = $this->getTable()
            ->where(['id' => $commentEntity->getId()])
            ->fetchAll();

        return $rows > 0;
    }

    private function createCommentEntity(array $data) : CommentEntity
    {
        $author = $this->userManager->getById($data['author_id']);

        return new CommentEntity(
            $data['id'],
            $data['created_at'],
            $data['updated_at'],
            $data['discussion_id'],
            $author
        );
    }
}