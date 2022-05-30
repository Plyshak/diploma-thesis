<?php declare(strict_types = 1);

namespace Infrastructure\Content\Plugin\Component\LiveCode;

use Domain\Content\Entity\ContentEntity;
use Domain\Content\Entity\Plugin\PluginBlockEntityInterface;
use Domain\Content\Entity\Plugin\PluginLiveCodeEntity;
use Domain\Content\Plugin\PluginInterface;
use Domain\Course\Entity\PageEntity;
use Infrastructure\Content\Plugin\Component\AbstractPluginControl;
use Infrastructure\Content\Service\LiveCodeExecutionProvider;
use Nette\Application\UI\Form;

class LiveCodePluginControl extends AbstractPluginControl implements PluginInterface
{
    protected $output = null;

    /** @var PluginLiveCodeEntity */
    protected $entity;

    protected $liveCodeExecutionProvider;

    public function __construct(
        ?PluginBlockEntityInterface $entity = null,
        LiveCodeExecutionProvider $liveCodeExecutionProvider = null
    ) {
        parent::__construct($entity);

        $this->liveCodeExecutionProvider = $liveCodeExecutionProvider;
    }

    public function addTemplateParameters(): void
    {
        parent::addTemplateParameters();

        $this->template->output = $this->output;
    }

    public function createComponentLiveCodeForm() : Form
    {
        $form = new Form(null, 'liveCodeForm');

        $form->addTextArea('code', '')
            ->setHtmlAttribute('class', 'smart-text');

        $form->addSubmit('submit', 'Spustit');

        $form->onSuccess[] = function (Form $form, array $data) {
            $fileContent = $data['code'];
            $language = $this->entity->getLanguage();

            $output = $this->liveCodeExecutionProvider->execute($fileContent, $language);

            $this->output = $output;
            $form->setDefaults($data);

            $this->redrawControl('liveCode');
        };

        return $form;
    }

    public function getPluginPrefix(): string
    {
        return 'liveCode';
    }

    public function getPluginName(): string
    {
        return 'Live coding';
    }

    public function isAvailable(ContentEntity $contentEntity): bool
    {
        return $contentEntity->getModule() === PageEntity::MODULE;
    }
}