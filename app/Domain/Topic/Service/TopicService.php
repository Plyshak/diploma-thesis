<?php declare(strict_types = 1);

namespace Domain\Topic\Service;

use Domain\Shared\Collection\Collection;
use Domain\Topic\Repository\TopicRepositoryInterface;

class TopicService
{
    protected $topicManager;

    public function __construct(TopicRepositoryInterface $topicManager)
    {
        $this->topicManager = $topicManager;
    }

    public function findAll() : Collection
    {
        return $this->topicManager->findAll();
    }
}