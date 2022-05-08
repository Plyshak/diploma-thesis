<?php declare(strict_types = 1);

namespace Domain\Content\Plugin;

interface PluginInterface
{
    public function getPluginPrefix() : string;

    public function getPluginName() : string;
}
