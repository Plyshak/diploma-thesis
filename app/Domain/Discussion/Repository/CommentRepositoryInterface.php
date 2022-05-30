<?php declare(strict_types = 1);

namespace Domain\Discussion\Repository;

use Domain\Discussion\Entity\CommentEntity;
use Domain\Shared\Collection\Collection;

interface CommentRepositoryInterface
{
    public function create(array $data) : CommentEntity;

    public function getById(int $id) : CommentEntity;

    public function findAllByDiscussionId(int $discussionId) : Collection;

    public function update(CommentEntity $commentEntity, array $data) : bool;

    public function delete(CommentEntity $commentEntity) : bool;
}