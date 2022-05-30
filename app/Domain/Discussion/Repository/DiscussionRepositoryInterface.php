<?php declare(strict_types = 1);

namespace Domain\Discussion\Repository;

use Domain\Discussion\Entity\DiscussionEntity;
use Domain\Shared\Collection\Collection;

interface DiscussionRepositoryInterface
{
    public function createEmpty(int $authorId) : DiscussionEntity;

    public function create(array $data) : DiscussionEntity;

    public function getById(int $id) : DiscussionEntity;

    public function findAll() : Collection;

    public function findAllWithConditions(array $conditions) : Collection;

    public function update(DiscussionEntity $discussionEntity, array $values) : bool;

    public function delete(DiscussionEntity $discussionEntity) : bool;

    public function increaseViewed(int $id) : bool;
}