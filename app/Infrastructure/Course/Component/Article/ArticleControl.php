<?php declare(strict_types = 1);

namespace Infrastructure\Course\Component\Article;

use Domain\Course\Entity\CourseEntity;
use Domain\Label\Service\LabelProviderInterface;
use Infrastructure\Component\AbstractControl;

class ArticleControl extends AbstractControl
{
    protected $courseEntity;
    protected $labelService;

    public function __construct(
        CourseEntity $courseEntity,
        LabelProviderInterface $labelService
    ) {
        $this->courseEntity = $courseEntity;
        $this->labelService = $labelService;
    }

    public function addTemplateParameters(): void
    {
        parent::addTemplateParameters();

        $this->template->courseEntity = $this->courseEntity;
        $this->template->labels = $this->labelService->getEntityLabels($this->courseEntity);
    }
}