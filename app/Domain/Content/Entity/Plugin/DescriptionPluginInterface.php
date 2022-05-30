<?php declare(strict_types = 1);

namespace Domain\Content\Entity\Plugin;

interface DescriptionPluginInterface
{
    public function getShortDescription() : string;
}