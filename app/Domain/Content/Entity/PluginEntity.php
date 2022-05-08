<?php declare(strict_types = 1);

namespace Domain\Content\Entity;

class PluginEntity
{
    protected $id;
    protected $content;
    protected $plugin;
    protected $pluginId;
    protected $visibility;
    protected $position;

    public function __construct(
        int $id,
        ContentEntity $content,
        string $plugin,
        int $pluginId,
        bool $visibility,
        int $position,
    ) {
        $this->id = $id;
        $this->content = $content;
        $this->plugin = $plugin;
        $this->pluginId = $pluginId;
        $this->visibility = $visibility;
        $this->position = $position;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getContent(): ContentEntity
    {
        return $this->content;
    }

    public function getPlugin(): string
    {
        return $this->plugin;
    }

    public function getPluginId(): int
    {
        return $this->pluginId;
    }

    public function isVisible(): bool
    {
        return $this->visibility;
    }

    public function getPosition(): int
    {
        return $this->position;
    }
}