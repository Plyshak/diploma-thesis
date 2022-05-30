<?php declare(strict_types = 1);

namespace Domain\Course\Repository;

use Domain\Course\Entity\CourseEntity;
use Domain\Shared\Collection\Collection;

interface CourseRepositoryInterface
{
    public function createEmpty(int $authorId) : CourseEntity;

    public function create(array $data) : CourseEntity;

    public function findAll() : Collection;

    public function findAllWithConditions(array $conditions) : Collection;

    public function getById(int $id) : CourseEntity;

    public function update(CourseEntity $courseEntity, array $data) : bool;

    public function delete(CourseEntity $courseEntity) : bool;
}