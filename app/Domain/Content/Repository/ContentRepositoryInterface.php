<?php declare(strict_types = 1);

namespace Domain\Content\Repository;

use Domain\Content\Entity\ContentEntity;
use Domain\Content\Entity\ContentInterface;

interface ContentRepositoryInterface
{
    public function create(array $data) : ContentEntity;

    public function getById(int $id) : ContentEntity;

    public function delete(ContentEntity $contentEntity) : bool;

    public function findByModuleEntity(ContentInterface $contentEntity) : ?ContentEntity;
}