<?php declare(strict_types = 1);

namespace Infrastructure\Content\Plugin\Component\PictureBlock;

use Domain\Content\Plugin\PluginInterface;
use Infrastructure\Content\Plugin\Component\AbstractPluginControl;

class PictureBlockPluginControl extends AbstractPluginControl implements PluginInterface
{
    public function getPluginPrefix(): string
    {
        return 'pictureBlock';
    }

    public function getPluginName(): string
    {
        return 'Obrázkový blok';
    }
}
