<?php declare(strict_types = 1);

namespace Domain\Course\Repository;

use Domain\Course\Entity\PageEntity;
use Domain\Shared\Collection\Collection;

interface PageRepositoryInterface
{
    public function create(array $data) : PageEntity;

    public function update(PageEntity $pageEntity, array $data) : bool;

    public function delete(PageEntity $pageEntity) : bool;

    public function findAllByChapterId(int $chapterId) : Collection;

    public function getById(int $id) : PageEntity;
}