<?php declare(strict_types = 1);

namespace Infrastructure\DataTransferObject;

class Menu
{
    protected $title;
    protected $link;
    protected $active;

    public function __construct(string $title, string $link, bool $active)
    {
        $this->title = $title;
        $this->link = $link;
        $this->active = $active;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getLink() : string
    {
        return $this->link;
    }

    public function isActive(): bool
    {
        return $this->active;
    }
}