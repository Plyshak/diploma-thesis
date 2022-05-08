<?php declare(strict_types = 1);

namespace Infrastructure\Content\Component\ContentBuilder;

use Domain\Content\Entity\ContentInterface;

interface ContentBuilderControlFactory
{
    public function create(ContentInterface $entity): ContentBuilderControl;
}
