<?php declare(strict_types = 1);

namespace Infrastructure\Content\Component\Content;

use Domain\Content\Entity\ContentInterface;

interface ContentControlFactory
{
    public function create(ContentInterface $contentEntity) : ContentControl;
}