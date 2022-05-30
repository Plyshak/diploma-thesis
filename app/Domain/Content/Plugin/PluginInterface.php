<?php declare(strict_types = 1);

namespace Domain\Content\Plugin;

use Domain\Content\Entity\ContentEntity;

interface PluginInterface
{
    public function getPluginPrefix() : string;

    public function getPluginName() : string;

    public function isAvailable(ContentEntity $contentEntity) : bool;
}
