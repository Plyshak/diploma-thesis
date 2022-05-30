<?php declare(strict_types = 1);

namespace Infrastructure\Content\Plugin\Component\TestForm;

use Domain\Content\Entity\ContentEntity;
use Domain\Content\Entity\Plugin\PluginTestFormEntity;
use Domain\Content\Plugin\PluginInterface;
use Domain\Course\Entity\PageEntity;
use Infrastructure\Content\Plugin\Component\AbstractPluginControl;
use Nette\Application\UI\Form;
use Nette\Forms\Controls\CheckboxList;

class TestFormPluginControl extends AbstractPluginControl implements PluginInterface
{
    /** @var PluginTestFormEntity */
    protected $entity;
    protected $validate = false;

    public function addTemplateParameters(): void
    {
        parent::addTemplateParameters();

        $this->template->validate = $this->validate;
    }

    public function getPluginPrefix(): string
    {
        return 'testForm';
    }

    public function getPluginName(): string
    {
        return 'Testovací formulář';
    }

    public function isAvailable(ContentEntity $contentEntity): bool
    {
        return $contentEntity->getModule() === PageEntity::MODULE;
    }

    public function createComponentForm(): Form
    {
        $form = new Form(null, 'pluginTestFormForm');
        $form->setHtmlAttribute('class', 'editForm');

        $this->appendFormControls($form);

        $form->addSubmit('submit', 'Zkontrolovat');

        $form->onSuccess[] = function (Form $form, array $values) {
            $this->validate = true;

            $this->redrawControl('testForm');
        };

        return $form;
    }

    public function createComponentValidatedForm(): Form
    {
        $form = new Form(null, 'pluginTestFormForm');
        $form->setHtmlAttribute('class', 'editForm unclickable');

        $this->appendFormControls($form, true);

        return $form;
    }

    private function appendFormControls(Form $form, bool $showAnser = false) : void
    {
        $configuration = $this->entity->getParsedConfiguration();

        foreach ($configuration as $key => $question) {
            if ($question['type'] === 'single') {
                $this->appendSingleQuestion($form, $key, $question, $showAnser);
            } else {
                $this->appendMultiQuestion($form, $key, $question, $showAnser);
            }
        }
    }

    private function appendSingleQuestion(Form $form, int $name, array $question, bool $showAnswer = false) : void
    {
        $answers = [];
        $rightChoice = null;

        foreach ($question['answers'] as $key => $answer) {
            $answers[] = $answer['answer'];

            if ((bool) $answer['points'] === true) {
                $rightChoice = $key;
            }
        }

        $control = $form->addRadioList('question' . $name, $question['question'], $answers)
            ->setRequired('Tato položka je povinná');

        if ($showAnswer) {
            $control->setValue($rightChoice);
        }
    }

    private function appendMultiQuestion(Form $form, int $name, array $question, bool $showAnswer = false) : void
    {
        $answers = [];
        $rightChoices = [];

        foreach ($question['answers'] as $key => $answer) {
            $answers[] = $answer['answer'];

            if ((bool) $answer['points'] === true) {
                $rightChoices[] = $key;
            }
        }

        $control = $form->addCheckboxList('question' . $name, $question['question'], $answers)
            ->setRequired('Tato položka je povinná');

        if ($showAnswer) {
            $control->setValue($rightChoices);
        }
    }
}