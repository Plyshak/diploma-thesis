<?php declare(strict_types = 1);

namespace Infrastructure\Content\Component\ContentBuilder;

use Domain\Content\Service\ContentService;
use Domain\Content\Entity\ContentInterface;
use Infrastructure\Component\AbstractControl;
use Infrastructure\Content\Component\ListPlugin\ListPluginControl;
use Infrastructure\Content\Component\ListPlugin\ListPluginControlFactory;

class ContentBuilderControl extends AbstractControl
{
    /** @var ContentInterface */
    protected $entity;

    /** @var ContentService */
    protected $service;

    /** @var ListPluginControlFactory  */
    protected $listPluginControlFactory;

    public function __construct(
        ContentInterface $entity,
        ContentService $service,
        ListPluginControlFactory $listPluginControlFactory
    ) {
        $this->entity = $entity;
        $this->service = $service;
        $this->listPluginControlFactory = $listPluginControlFactory;
    }

    public function handleCreateContentBuilder() : void
    {
        $this->service->createEmptyContent($this->entity);
        $this->redrawControl();
    }

    public function addTemplateParameters() : void
    {
        parent::addTemplateParameters();

        $this->template->hasContentBuilder = $this->service->hasContent($this->entity);
    }

    public function createComponentPluginList() : ListPluginControl
    {
        return $this->listPluginControlFactory->create(
            $this->service->getContent($this->entity)
        );
    }
}
