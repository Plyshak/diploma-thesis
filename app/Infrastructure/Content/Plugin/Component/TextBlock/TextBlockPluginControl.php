<?php declare(strict_types = 1);

namespace Infrastructure\Content\Plugin\Component\TextBlock;

use Domain\Content\Plugin\PluginInterface;
use Infrastructure\Content\Plugin\Component\AbstractPluginControl;

class TextBlockPluginControl extends AbstractPluginControl implements PluginInterface
{
    public function getPluginPrefix(): string
    {
        return 'textBlock';
    }

    public function getPluginName(): string
    {
        return 'Textový blok';
    }
}
