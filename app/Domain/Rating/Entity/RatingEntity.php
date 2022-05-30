<?php declare(strict_types = 1);

namespace Domain\Rating\Entity;

use Domain\User\Entity\UserInterface;

class RatingEntity
{
    public const POSITIVE = 1;
    public const NEUTRAL = 0;
    public const NEGATIVE = -1;

    protected $id;
    protected $module;
    protected $moduleId;
    protected $author;
    protected $rating;

    public function __construct(
        int $id,
        string $module,
        int $moduleId,
        UserInterface $author,
        int $rating
    ) {
        $this->id = $id;
        $this->module = $module;
        $this->moduleId = $moduleId;
        $this->author = $author;
        $this->rating = $rating;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getModule(): string
    {
        return $this->module;
    }

    public function getModuleId(): int
    {
        return $this->moduleId;
    }

    public function getAuthor(): UserInterface
    {
        return $this->author;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function isPositive() : bool
    {
        return $this->rating === self::POSITIVE;
    }

    public function isNeutral() : bool
    {
        return $this->rating === self::NEUTRAL;
    }

    public function isNegative() : bool
    {
        return $this->rating === self::NEGATIVE;
    }
}