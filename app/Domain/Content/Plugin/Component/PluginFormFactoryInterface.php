<?php declare(strict_types = 1);

namespace Domain\Content\Plugin\Component;

use Domain\Content\Entity\Plugin\PluginBlockEntityInterface;
use Domain\Content\Entity\Plugin\PluginCodeBlockEntity;
use Domain\Content\Entity\Plugin\PluginLiveCodeEntity;
use Domain\Content\Entity\Plugin\PluginPictureBlockEntity;
use Domain\Content\Entity\Plugin\PluginTestFormEntity;
use Domain\Content\Entity\Plugin\PluginTextBlockEntity;

interface PluginFormFactoryInterface
{
    public function getPluginForm(PluginBlockEntityInterface $entity);
    public function createPluginForm(string $prefix);
    public function getTextBlockForm(?PluginTextBlockEntity $entity = null);
    public function getPictureBlockForm(?PluginPictureBlockEntity $entity = null);
    public function getTestFormForm(?PluginTestFormEntity $entity = null);
    public function getCodeBlockForm(?PluginCodeBlockEntity $entity = null);
    public function getLiveCodeForm(?PluginLiveCodeEntity $entity = null);
}