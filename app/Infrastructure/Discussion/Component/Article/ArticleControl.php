<?php declare(strict_types = 1);

namespace Infrastructure\Discussion\Component\Article;

use Domain\Content\Entity\Plugin\DescriptionPluginInterface;
use Domain\Content\Entity\Plugin\PluginBlockEntityInterface;
use Domain\Content\Service\ContentProviderInterface;
use Domain\Discussion\Entity\DiscussionEntity;
use Domain\Label\Entity\LabelEntity;
use Domain\Label\Repository\LabelStackRepositoryInterface;
use Infrastructure\Component\AbstractControl;
use Infrastructure\Content\Service\PluginService;

class ArticleControl extends AbstractControl
{
    protected $discussionEntity;
    protected $labelStackManager;
    protected $contentService;
    protected $pluginService;

    public function __construct(
        DiscussionEntity $discussionEntity,
        LabelStackRepositoryInterface $labelStackManager,
        ContentProviderInterface $contentService,
        PluginService $pluginService
    ) {
        $this->discussionEntity = $discussionEntity;
        $this->labelStackManager = $labelStackManager;
        $this->contentService = $contentService;
        $this->pluginService = $pluginService;
    }

    public function addTemplateParameters(): void
    {
        parent::addTemplateParameters();

        $this->template->discussionEntity = $this->discussionEntity;
        $this->template->labels = $this->getLabels();
        $this->template->perex = $this->getFirstContentPluginDescription();
    }

    private function getLabels() : array
    {
        $labels = [];
        $labelStackEntity = $this->labelStackManager->findByModuleEntity($this->discussionEntity);

        if ($labelStackEntity !== null) {
            $collection = $labelStackEntity->getLabels();

            /** @var LabelEntity $item */
            foreach ($collection as $item) {
                $labels[] = $item;
            }
        }

        return $labels;
    }

    private function getFirstContentPluginDescription() : string
    {
        $perex = '';

        if ($this->contentService->hasContent($this->discussionEntity)) {
            $perex = $this->findFirstContentPluginDescription();
        }

        return $perex;
    }

    private function findFirstContentPluginDescription() : string
    {
        $description = '';

        $contentEntity = $this->contentService->getContent($this->discussionEntity);
        $plugins = $this->pluginService->getPlugins($contentEntity);

        $found = false;
        $i = 0;

        while ($i < count($plugins)) {
            if (!$found) {
                /** @var PluginBlockEntityInterface $plugin */
                $plugin = $plugins[$i];

                if ($plugin instanceof DescriptionPluginInterface) {
                    $description = $plugin->getShortDescription();
                    $found = true;
                }
            }

            $i++;
        }

        return $description;
    }
}