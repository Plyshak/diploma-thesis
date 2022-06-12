<?php declare(strict_types = 1);

namespace Domain\Label\Service;

use Domain\Label\Entity\LabelInterface;
use Domain\Label\Entity\LabelStackEntity;
use Domain\Label\Repository\LabelBridgeRepositoryInterface;
use Domain\Label\Repository\LabelRepositoryInterface;
use Domain\Label\Repository\LabelStackRepositoryInterface;
use Domain\Shared\Collection\Collection;

/**
 * operations above labels
 */
class LabelService implements LabelProviderInterface
{
    protected $labelManager;
    protected $labelBridgeManager;
    protected $labelStackManager;

    public function __construct(
        LabelRepositoryInterface $labelManager,
        LabelBridgeRepositoryInterface $labelBridgeManager,
        LabelStackRepositoryInterface $labelStackManager
    ) {
        $this->labelManager = $labelManager;
        $this->labelBridgeManager = $labelBridgeManager;
        $this->labelStackManager = $labelStackManager;
    }

    public function getAllLabels() : Collection
    {
        return $this->labelManager->findAll();
    }

    public function hasEntityLabels(LabelInterface $labelEntity) : bool
    {
        return $this->labelStackManager->findByModuleEntity($labelEntity) !== null;
    }

    public function getEntityLabels(LabelInterface $labelEntity) : Collection
    {
        $labelStackEntity = $this->labelStackManager->findByModuleEntity($labelEntity);

        if ($labelStackEntity !== null) {
            $labels = $labelStackEntity->getLabels();
        } else {
            $labels = new Collection();
        }

        return $labels;
    }

    public function addLabelToEntity(LabelInterface $labelEntity, array $data) : void
    {
        $label = $this->labelManager->create($data);
        $labelStackEntity = $this->getLabelStackEntity($labelEntity);

        $labelBridgeData = [
            'label_stack_id' => $labelStackEntity->getId(),
            'label_id' => $label->getId(),
        ];

        $this->labelBridgeManager->create($labelBridgeData);
    }

    public function setLabelsToEntity(LabelInterface $labelEntity, array $labels) : bool
    {
        $labelStackEntity = $this->getLabelStackEntity($labelEntity);

        $this->labelBridgeManager->deleteByModuleEntity($labelStackEntity);

        $labelBridgeData = ['label_stack_id' => $labelStackEntity->getId()];

        /** @var int $labelId */
        foreach ($labels as $labelId) {
            $labelBridgeData['label_id'] = $labelId;

            $this->labelBridgeManager->create($labelBridgeData);
        }

        return true;
    }

    private function getLabelStackEntity(LabelInterface $labelEntity) : LabelStackEntity
    {
        if (!$this->hasEntityLabels($labelEntity)) {
            $labelStackEntity = $this->createLabelStackEntityForModuleEntity($labelEntity);
        } else {
            $labelStackEntity = $this->labelStackManager->findByModuleEntity($labelEntity);
        }

        return $labelStackEntity;
    }

    private function createLabelStackEntityForModuleEntity(LabelInterface $labelEntity) : LabelStackEntity
    {
        $data = [];
        $data['module'] = $labelEntity->getModule();
        $data['module_id'] = $labelEntity->getId();

        return $this->labelStackManager->create($data);
    }
}