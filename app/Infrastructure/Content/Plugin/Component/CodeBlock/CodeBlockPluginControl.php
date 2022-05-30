<?php declare(strict_types = 1);

namespace Infrastructure\Content\Plugin\Component\CodeBlock;

use Domain\Content\Entity\ContentEntity;
use Domain\Content\Plugin\PluginInterface;
use Infrastructure\Content\Plugin\Component\AbstractPluginControl;

class CodeBlockPluginControl extends AbstractPluginControl implements PluginInterface
{
    public function getPluginPrefix(): string
    {
        return 'codeBlock';
    }

    public function getPluginName(): string
    {
        return 'Blok kódu';
    }

    public function isAvailable(ContentEntity $contentEntity): bool
    {
        return true;
    }
}