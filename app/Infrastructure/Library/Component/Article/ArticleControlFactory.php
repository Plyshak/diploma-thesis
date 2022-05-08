<?php declare(strict_types = 1);

namespace Infrastructure\Library\Component\Article;

use Domain\Library\Entity\LibraryEntity;

interface ArticleControlFactory
{
    public function create(LibraryEntity $libraryEntity) : ArticleControl;
}