<?php declare(strict_types = 1);

namespace Domain\Course\Repository;

use Domain\Course\Entity\ChapterEntity;
use Domain\Shared\Collection\Collection;

interface ChapterRepositoryInterface
{
    public function create(array $data) : ChapterEntity;

    public function update(ChapterEntity $chapterEntity, array $data) : bool;

    public function delete(ChapterEntity $chapterEntity) : bool;

    public function findAllByCourseId(int $courseId) : Collection;

    public function getById(int $id) : ChapterEntity;
}