<?php declare(strict_types = 1);

namespace Domain\Rating\Service;

use Domain\Rating\Entity\RatingEntity;
use Domain\Rating\Entity\RatingInterface;
use Domain\User\Entity\UserInterface;

interface RatingProviderInterface
{
    public const POSITIVE = 'positive';
    public const NEGATIVE = 'negative';
    public const NONE = 'none';

    public function hasRating(RatingInterface $ratingEntity) : bool;
    public function getRatingCount(RatingInterface $ratingEntity) : int;
    public function rateEntity(RatingInterface $ratingEntity, UserInterface $author, int $rating) : RatingEntity;
    public function getUserVoteForEntity(RatingInterface $ratingEntity, UserInterface $user) : string;
}