<?php declare(strict_types = 1);

namespace Infrastructure\Library\Component\Article;

use Domain\Label\Entity\LabelEntity;
use Domain\Label\Repository\LabelStackRepositoryInterface;
use Domain\Library\Entity\LibraryEntity;
use Infrastructure\Component\AbstractControl;

class ArticleControl extends AbstractControl
{
    protected $libraryEntity;
    protected $labelStackManager;

    public function __construct(
        LibraryEntity $libraryEntity,
        LabelStackRepositoryInterface $labelStackManager
    ) {
        $this->libraryEntity = $libraryEntity;
        $this->labelStackManager = $labelStackManager;
    }

    public function addTemplateParameters(): void
    {
        parent::addTemplateParameters();

        $this->template->libraryEntity = $this->libraryEntity;
        $this->template->labels = $this->getLabels();
    }

    private function getLabels() : array
    {
        $labels = [];
        $labelStackEntity = $this->labelStackManager->findByModuleEntity($this->libraryEntity);

        if ($labelStackEntity !== null) {
            $collection = $labelStackEntity->getLabels();

            /** @var LabelEntity $item */
            foreach ($collection as $item) {
                $labels[] = $item;
            }
        }

        return $labels;
    }
}