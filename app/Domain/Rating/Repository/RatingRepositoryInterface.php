<?php declare(strict_types = 1);

namespace Domain\Rating\Repository;

use Domain\Rating\Entity\RatingEntity;
use Domain\Rating\Entity\RatingInterface;
use Domain\User\Entity\UserInterface;

interface RatingRepositoryInterface
{
    public function rate(RatingInterface $ratingEntity, UserInterface $author, int $rating) : RatingEntity;

    public function getById(int $id) : RatingEntity;

    public function hasRating(RatingInterface $ratingEntity) : bool;

    public function getRatingCount(RatingInterface $ratingEntity) : int;

    public function getRatingOfAuthorForEntity(RatingInterface $ratingEntity, UserInterface $author) : ?RatingEntity;

    public function changeRating(RatingEntity $ratingEntity, int $rating) : RatingEntity;
}