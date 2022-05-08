<?php declare(strict_types = 1);

namespace Domain\Content\Entity\Plugin;

interface PluginBlockEntityInterface
{
    public function getId() : int;

    public function getPluginPrefix(): string;
}
