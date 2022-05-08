<?php declare(strict_types = 1);

namespace Domain\Content\Entity\Plugin;

abstract class AbstractPluginBlockEntity implements PluginBlockEntityInterface
{
    protected $id;
    protected $title;
    protected $showTitle;

    public function __construct(
        int $id,
        ?string $title,
        ?bool $showTitle
    ) {
        $this->id = $id;
        $this->title = $title ?? '';
        $this->showTitle = $showTitle ?? true;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function isShowTitle(): bool
    {
        return $this->showTitle;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setShowTitle(bool $showTitle): void
    {
        $this->showTitle = $showTitle;
    }
}