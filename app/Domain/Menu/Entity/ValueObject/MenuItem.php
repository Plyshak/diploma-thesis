<?php declare(strict_types = 1);

namespace Domain\Menu\Entity\ValueObject;

use Domain\Shared\Collection\CollectionItem;

class MenuItem implements CollectionItem
{
    public const LINK_HOMEPAGE = 'Homepage:default';
    public const LINK_COURSES = 'Course:list';
    public const LINK_DISCUSSION = 'Discussion:list';
    public const LINK_LIBRARY = 'Library:list';

    protected $title;
    protected $link;

    public function __construct(string $title, string $link)
    {
        $this->title = $title;
        $this->link = $link;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getLink() : string
    {
        return $this->link;
    }

    public function getClass() : string
    {
        return get_class($this);
    }

    /**
     * @param MenuItem $item
     */
    public function equals(object $item) : bool
    {
        return $this->getClass() === $item->getClass()
            && $this->title === $item->getTitle()
            && $this->link === $item->getLink();
    }

    public static function createFromParameters(string $title, string $link) : self
    {
        return new self($title, $link);
    }
}