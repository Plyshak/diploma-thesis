<?php declare(strict_types = 1);

namespace Infrastructure\Discussion\Component\Article;

use Domain\Discussion\Entity\DiscussionEntity;

interface ArticleControlFactory
{
    public function create(DiscussionEntity $discussionEntity) : ArticleControl;
}