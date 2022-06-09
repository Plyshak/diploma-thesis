<?php declare(strict_types = 1);

namespace Domain\Course\Service;

use Domain\Course\Entity\ChapterEntity;
use Domain\Course\Entity\CourseEntity;
use Domain\Course\Entity\PageEntity;
use Domain\Shared\Collection\Collection;

interface CourseProviderInterface
{
    public function findAll() : Collection;
    public function createEmpty(int $authorId) : CourseEntity;
    public function getCourseById(int $id) : CourseEntity;
    public function findAllWithConditions(array $conditions) : Collection;
    public function getChapterOfCourseByPosition(CourseEntity $courseEntity, int $chapterPosition) : ChapterEntity;
    public function getPageOfChapterByPosition(ChapterEntity $chapterEntity, int $pagePosition) : PageEntity;
    public function updateCourse(CourseEntity $courseEntity, array $values) : bool;
    public function addChapterToCourse(CourseEntity $courseEntity) : ChapterEntity;
    public function getChapterById(int $id) : ChapterEntity;
    public function updateChapter(ChapterEntity $chapterEntity, array $values) : bool;
    public function getPageById(int $id) : PageEntity;
    public function addPageToChapter(ChapterEntity $chapterEntity);
}