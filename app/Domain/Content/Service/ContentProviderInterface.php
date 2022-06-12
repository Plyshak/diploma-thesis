<?php declare(strict_types = 1);

namespace Domain\Content\Service;

use Domain\Content\Entity\ContentEntity;
use Domain\Content\Entity\ContentInterface;

interface ContentProviderInterface
{
    public function getContent(ContentInterface $entity): ?ContentEntity;
    public function hasContent(ContentInterface $entity): bool;
    public function createEmptyContent(ContentInterface $entity): void;
}