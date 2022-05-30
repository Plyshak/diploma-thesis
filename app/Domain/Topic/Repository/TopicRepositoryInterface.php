<?php declare(strict_types = 1);

namespace Domain\Topic\Repository;

use Domain\Shared\Collection\Collection;
use Domain\Topic\Entity\TopicEntity;

interface TopicRepositoryInterface
{
    public function create(array $data) : TopicEntity;

    public function findAll() : Collection;

    public function update(TopicEntity $topicEntity, array $data) : bool;

    public function delete(TopicEntity $topicEntity) : bool;

    public function getById(int $id) : TopicEntity;
}