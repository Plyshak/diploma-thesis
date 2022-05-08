<?php declare(strict_types = 1);

namespace Domain\Library\Entity;

use DateTime;
use Domain\Content\Entity\ContentInterface;
use Domain\Label\Entity\LabelInterface;
use Domain\Shared\Collection\CollectionItem;
use Domain\User\Entity\UserInterface;

class LibraryEntity implements ContentInterface, CollectionItem, LabelInterface
{
    protected $id;
    protected $title;
    protected $perex;
    protected $image;
    protected $createdAt;
    protected $updatedAt;
    protected $author;

    public function __construct(
        int $id,
        string $title,
        string $perex,
        string $image,
        DateTime $createdAt,
        DateTime $updatedAt,
        UserInterface $author
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->perex = $perex;
        $this->image = $image;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->author = $author;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPerex(): string
    {
        return $this->perex;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function getAuthor(): UserInterface
    {
        return $this->author;
    }

    public function getModule(): string
    {
        return 'library';
    }

    public function equals(object $item): bool
    {
        return $this->getClass() === $item->getClass()
            && $this->getId() === $item->getId()
            && $this->getTitle() === $item->getTitle()
            && $this->getPerex() === $item->getPerex()
            && $this->getImage() === $item->getImage()
            && $this->getAuthor() === $item->getAuthor();
    }

    public function getClass(): string
    {
        return get_class($this);
    }
}