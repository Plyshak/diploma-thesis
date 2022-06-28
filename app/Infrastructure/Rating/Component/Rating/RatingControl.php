<?php declare(strict_types = 1);

namespace Infrastructure\Rating\Component\Rating;

use Domain\Rating\Entity\RatingInterface;
use Domain\Rating\Service\RatingProviderInterface;
use Domain\User\Entity\UserInterface;
use Infrastructure\Component\AbstractControl;

class RatingControl extends AbstractControl
{
    protected $ratingEntity;
    protected $ratingService;

    public function __construct(
        RatingInterface $ratingEntity,
        RatingProviderInterface $ratingService
    ) {
        $this->ratingEntity = $ratingEntity;
        $this->ratingService = $ratingService;
    }

    public function addTemplateParameters(): void
    {
        parent::addTemplateParameters();

        $this->template->currentRating = $this->ratingService->getRatingCount($this->ratingEntity);
        $this->template->userVote = $this->resolveUserVote();
    }

    public function handleRate(int $rating) : void
    {
        /** @var UserInterface $identity */
        $identity = $this->getPresenter()->getUser()->getIdentity();

        $this->ratingService->rateEntity(
            $this->ratingEntity,
            $identity,
            $rating
        );

        $this->redrawControl('rating');
    }

    private function resolveUserVote() : string
    {
        $user = $this->getPresenter()->getUser();

        if ($user->isLoggedIn()) {
            $rating = $this->ratingService->getUserVoteForEntity($this->ratingEntity, $user->getIdentity());
        } else {
            $rating = RatingProviderInterface::NONE;
        }

        return $rating;
    }
}