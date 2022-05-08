<?php declare(strict_types = 1);

namespace Domain\Content\Service;

use Domain\Content\Entity\ContentEntity;
use Domain\Content\Entity\ContentInterface;
use Domain\Content\Repository\ContentRepositoryInterface;

/**
 * operations above content builder create/get
 */
class ContentService
{
    protected $contentRepository;

    public function __construct(ContentRepositoryInterface $contentRepository)
    {
        $this->contentRepository = $contentRepository;
    }

    /**
     * @param ContentInterface $entity
     *
     * @return ContentEntity|null
     */
    public function getContent(ContentInterface $entity): ?ContentEntity
    {
        return $this->contentRepository->findByModuleEntity($entity);
    }

    public function hasContent(ContentInterface $entity): bool
    {
        return $this->getContent($entity) !== null;
    }
    /**
     * @param ContentInterface $entity
     */
    public function createEmptyContent(ContentInterface $entity): void
    {
        $data = [];
        $data['module'] = $entity->getModule();
        $data['module_id'] = $entity->getId();

        $this->contentRepository->create($data);
    }
}
