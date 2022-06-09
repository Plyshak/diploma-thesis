<?php declare(strict_types = 1);

namespace Domain\Course\Service;

use Domain\Course\Entity\ChapterEntity;
use Domain\Course\Entity\CourseEntity;
use Domain\Course\Entity\PageEntity;
use Domain\Course\Repository\ChapterRepositoryInterface;
use Domain\Course\Repository\CourseRepositoryInterface;
use Domain\Course\Repository\PageRepositoryInterface;
use Domain\Shared\Collection\Collection;

class CourseService implements CourseProviderInterface
{
    protected $courseManager;
    protected $chapterManager;
    protected $pageManager;

    public function __construct(
        CourseRepositoryInterface $courseRepository,
        ChapterRepositoryInterface $chapterManager,
        PageRepositoryInterface $pageManager
    ) {
        $this->courseManager = $courseRepository;
        $this->chapterManager = $chapterManager;
        $this->pageManager = $pageManager;
    }

    public function findAll() : Collection
    {
        return $this->courseManager->findAll();
    }

    public function createEmpty(int $authorId) : CourseEntity
    {
        return $this->courseManager->createEmpty($authorId);
    }

    public function getCourseById(int $id) : CourseEntity
    {
        return $this->courseManager->getById($id);
    }

    public function findAllWithConditions(array $conditions) : Collection
    {
        return $this->courseManager->findAllWithConditions($conditions);
    }

    public function getChapterOfCourseByPosition(CourseEntity $courseEntity, int $chapterPosition) : ChapterEntity
    {
        /** @var ChapterEntity $chapterEntity */
        $chapterEntity = $courseEntity->getChapters()->getItem($chapterPosition - 1);

        return $chapterEntity;
    }

    public function getPageOfChapterByPosition(ChapterEntity $chapterEntity, int $pagePosition) : PageEntity
    {
        /** @var PageEntity $pageEntity */
        $pageEntity = $chapterEntity->getPages()->getItem($pagePosition - 1);

        return $pageEntity;
    }

    public function updateCourse(CourseEntity $courseEntity, array $values) : bool
    {
        return $this->courseManager->update($courseEntity, $values);
    }

    public function addChapterToCourse(CourseEntity $courseEntity) : ChapterEntity
    {
        $chapterCount = $courseEntity->getChapters()->count();

        return $this->chapterManager->create([
            'course_id' => $courseEntity->getId(),
            'annotation' => '',
            'position' => ($chapterCount + 1),
            'repetition' => false,
        ]);
    }

    public function getChapterById(int $id) : ChapterEntity
    {
        return $this->chapterManager->getById($id);
    }

    public function updateChapter(ChapterEntity $chapterEntity, array $values) : bool
    {
        return $this->chapterManager->update($chapterEntity, $values);
    }

    public function getPageById(int $id) : PageEntity
    {
        return $this->pageManager->getById($id);
    }

    public function addPageToChapter(ChapterEntity $chapterEntity)
    {
        $pagesCount = $chapterEntity->getPages()->count();

        $data = [
            'chapter_id' => $chapterEntity->getId(),
            'position' => ($pagesCount + 1),
        ];

        return $this->pageManager->create($data);
    }
}