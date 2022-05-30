<?php declare(strict_types = 1);

namespace Infrastructure\Rating\Component\Rating;

use Domain\Rating\Entity\RatingInterface;

interface RatingControlFactory
{
    public function create(RatingInterface $ratingEntity) : RatingControl;
}