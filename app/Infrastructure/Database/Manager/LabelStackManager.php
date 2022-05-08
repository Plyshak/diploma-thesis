<?php declare(strict_types = 1);

namespace Infrastructure\Database\Manager;

use Domain\Label\Entity\LabelBridgeEntity;
use Domain\Label\Entity\LabelInterface;
use Domain\Label\Entity\LabelStackEntity;
use Domain\Label\Repository\LabelBridgeRepositoryInterface;
use Domain\Label\Repository\LabelRepositoryInterface;
use Domain\Label\Repository\LabelStackRepositoryInterface;
use Domain\Shared\Collection\Collection;
use Nette\Database\Explorer;
use Nette\Utils\Arrays;

class LabelStackManager extends AbstractManager implements LabelStackRepositoryInterface
{
    protected $labelManager;
    protected $labelBridgeManager;

    public function __construct(
        Explorer $database,
        LabelBridgeRepositoryInterface $labelBridgeManager,
        LabelRepositoryInterface $labelManager
    ) {
        parent::__construct($database);

        $this->labelManager = $labelManager;
        $this->labelBridgeManager = $labelBridgeManager;
    }

    public function create(array $data): LabelStackEntity
    {
        $data['created_at'] = 'now()';
        $data['updated_at'] = 'now()';

        $activeRow = $this->getTable()->insert($data);

        return $this->createLabelStackEntity($activeRow->toArray());
    }

    public function delete(array $conditions): bool
    {
        // TODO: Implement delete() method.
    }

    public function findByModuleEntity(LabelInterface $contentEntity): ?LabelStackEntity
    {
        $entity = null;

        $rows = $this->getTable()
            ->where([
                'module' => $contentEntity->getModule(),
                'module_id' => $contentEntity->getId(),
            ])
            ->fetchAll();

        if (count($rows) === 1) {
            $entity = $this->createLabelStackEntity(Arrays::first($rows)->toArray());
        }

        return $entity;
    }

    private function createLabelStackEntity(array $data) : LabelStackEntity
    {
        $labels = new Collection();
        $bridgeEntities = $this->labelBridgeManager->findAllByLabelStackId($data['id']);

        /** @var LabelBridgeEntity $bridgeEntity */
        foreach ($bridgeEntities as $bridgeEntity) {
            $labelEntity = $this->labelManager->getById($bridgeEntity->getLabelId());

            $labels->addItem($labelEntity);
        }

        return new LabelStackEntity(
            $data['id'],
            $data['module'],
            $data['module_id'],
            $labels
        );
    }
}