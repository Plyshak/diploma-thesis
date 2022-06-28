<?php declare(strict_types = 1);

namespace Domain\Rating\Service;

use Domain\Rating\Entity\RatingEntity;
use Domain\Rating\Entity\RatingInterface;
use Domain\Rating\Repository\RatingRepositoryInterface;
use Domain\User\Entity\UserInterface;

class RatingService implements RatingProviderInterface
{
    protected $ratingManager;

    public function __construct(
        RatingRepositoryInterface $ratingRepository
    ) {
        $this->ratingManager = $ratingRepository;
    }

    public function hasRating(RatingInterface $ratingEntity) : bool
    {
        return $this->ratingManager->hasRating($ratingEntity);
    }

    public function getRatingCount(RatingInterface $ratingEntity) : int
    {
        return $this->ratingManager->getRatingCount($ratingEntity);
    }

    public function rateEntity(RatingInterface $ratingEntity, UserInterface $author, int $rating) : RatingEntity
    {
        $entity = $this->ratingManager->getRatingOfAuthorForEntity($ratingEntity, $author);

        if ($entity) {
            $entity = $this->ratingManager->changeRating($entity, $rating);
        } else {
            $entity = $this->ratingManager->rate($ratingEntity, $author, $rating);
        }

        return $entity;
    }

    public function getUserVoteForEntity(RatingInterface $ratingEntity, UserInterface $user) : string
    {
        $entity = $this->ratingManager->getRatingOfAuthorForEntity($ratingEntity, $user);

        if ($entity && $entity->isPositive()) {
            $rating = self::POSITIVE;
        } elseif ($entity && $entity->isNegative()) {
            $rating = self::NEGATIVE;
        } else {
            $rating = self::NONE;
        }

        return $rating;
    }
}