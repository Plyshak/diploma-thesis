<?php declare(strict_types = 1);

namespace Infrastructure\Database\Manager;

use Domain\Content\Entity\Plugin\PluginBlockEntityInterface;
use Domain\Content\Entity\Plugin\PluginPictureBlockEntity;
use Domain\Content\Exception\PluginBlockEntityNotFoundException;
use Domain\Content\Repository\Plugin\PluginPictureBlockRepositoryInterface;
use Nette\Http\FileUpload;
use Nette\Utils\Arrays;

class PluginPictureBlockManager extends AbstractManager implements PluginPictureBlockRepositoryInterface
{
    public const UPLOAD_IMAGE_PATH = 'upload/plugin/pictureBlock/';

    public function create(array $data): PluginBlockEntityInterface
    {
        $data['created_at'] = 'now()';
        $data['updated_at'] = 'now()';

        $data['image'] = $this->uploadFile($data['image']);

        $activeRow = $this->getTable()->insert($data);

        return $this->createPluginPictureBlockEntity($activeRow->toArray());
    }

    public function update(PluginBlockEntityInterface $pluginBlockEntity, array $values): bool
    {
        $id = $pluginBlockEntity->getId();

        $values['updated_at'] = 'now()';

        $values['image'] = $this->uploadFile($values['image']);

        $selection = $this->getTable();
        $selection->where(['id' => $id]);
        $rows = $selection->update($values);

        if ($rows === 1) {
            $success = true;
        } else {
            $success = false;
        }

        return $success;
    }

    public function getById(int $id): PluginBlockEntityInterface
    {
        $rows = $this->getTable()
            ->where(['id' => $id])
            ->fetchAll();

        if (count($rows) === 1 ) {
            return $this->createPluginPictureBlockEntity(
                Arrays::first($rows)
                    ->toArray()
            );
        } else {
            throw new PluginBlockEntityNotFoundException(
                'pictureBlock',
                sprintf('Id "%d" not found.', $id)
            );
        }
    }

    public function delete(PluginBlockEntityInterface $pluginBlockEntity): bool
    {
        $count = $this->getTable()
            ->where(['id' => $pluginBlockEntity->getId()])
            ->delete();

        return $count === 1;
    }

    private function createPluginPictureBlockEntity(array $data) : PluginPictureBlockEntity
    {
        return new PluginPictureBlockEntity(
            $data['id'],
            $data['title'],
            $data['show_title'],
            $data['image'],
            $data['picture_align'],
            $data['picture_description'],
            $data['picture_show_description'],
            $data['picture_width']
        );
    }
}