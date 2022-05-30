<?php declare(strict_types = 1);

namespace Infrastructure\Course\Component\Article;

use Domain\Course\Entity\CourseEntity;

interface ArticleControlFactory
{
    public function create(CourseEntity $courseEntity) : ArticleControl;
}