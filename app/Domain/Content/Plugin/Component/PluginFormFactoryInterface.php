<?php declare(strict_types = 1);

namespace Domain\Content\Plugin\Component;

use Domain\Content\Entity\Plugin\PluginPictureBlockEntity;
use Domain\Content\Entity\Plugin\PluginTextBlockEntity;

interface PluginFormFactoryInterface
{
    public function getPluginTextForm(?PluginTextBlockEntity $entity = null);

    public function getPluginPictureForm(?PluginPictureBlockEntity $entity = null);
}