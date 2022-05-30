<?php declare(strict_types = 1);

namespace Infrastructure\Database\Manager;

use Domain\Rating\Entity\RatingEntity;
use Domain\Rating\Entity\RatingInterface;
use Domain\Rating\Repository\RatingRepositoryInterface;
use Domain\User\Entity\UserInterface;
use Domain\User\Repository\UsersRepositoryInterface;
use Nette\Database\Explorer;
use Nette\Utils\Arrays;

class RatingManager extends AbstractManager implements RatingRepositoryInterface
{
    protected $userManager;

    public function __construct(
        UsersRepositoryInterface $usersRepository,
        Explorer $database
    ) {
        parent::__construct($database);

        $this->userManager = $usersRepository;
    }

    public function rate(RatingInterface $ratingEntity, UserInterface $author, int $rating): RatingEntity
    {
        $data = [
            'module' => $ratingEntity->getModule(),
            'module_id' => $ratingEntity->getId(),
            'author_id' => $author->getId(),
            'rating' => $rating,
            'created_at' => 'now()',
            'updated_at' => 'now()',
        ];

        $activeRow = $this->getTable()->insert($data);

        return $this->createRatingEntity($activeRow->toArray());
    }

    public function getById(int $id) : RatingEntity
    {
        $rows = $this->getTable()
            ->where(['id' => $id])
            ->fetchAll();

        return $this->createRatingEntity(Arrays::first($rows)->toArray());
    }

    public function hasRating(RatingInterface $ratingEntity): bool
    {
        $rows = $this->getTable()
            ->where([
                'module' => $ratingEntity->getModule(),
                'module_id' => $ratingEntity->getId(),
            ])
            ->fetchAll();

        return count($rows) === 1;
    }

    public function getRatingCount(RatingInterface $ratingEntity): int
    {
        $row = $this->getTable()
            ->select('SUM(rating)')
            ->where([
                'module' => $ratingEntity->getModule(),
                'module_id' => $ratingEntity->getId(),
            ])
            ->fetch();

        return $row['sum'] ?? 0;
    }

    public function getRatingOfAuthorForEntity(RatingInterface $ratingEntity, UserInterface $author): ?RatingEntity
    {
        $entity = null;

        $rows = $this->getTable()
            ->where([
                'module' => $ratingEntity->getModule(),
                'module_id' => $ratingEntity->getId(),
                'author_id' => $author->getId(),
            ])
            ->fetchAll();

        if (count($rows) === 1) {
            $entity = $this->createRatingEntity(Arrays::first($rows)->toArray());
        }

        return $entity;
    }

    public function changeRating(RatingEntity $ratingEntity, int $rating): RatingEntity
    {
        $id = $ratingEntity->getId();

        $data = [
            'rating' => $rating,
            'updated_at' => 'now()',
        ];

        $this->getTable()
            ->where(['id' => $id])
            ->update($data);

        return $this->getById($id);
    }

    private function createRatingEntity(array $data) : RatingEntity
    {
        return new RatingEntity(
            $data['id'],
            $data['module'],
            $data['module_id'],
            $this->userManager->getById($data['author_id']),
            $data['rating']
        );
    }
}