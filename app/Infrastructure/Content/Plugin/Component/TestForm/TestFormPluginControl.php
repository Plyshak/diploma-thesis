<?php declare(strict_types = 1);

namespace Infrastructure\Content\Plugin\Component\TestForm;

use Domain\Content\Entity\ContentEntity;
use Domain\Content\Entity\Plugin\PluginTestFormEntity;
use Domain\Content\Plugin\PluginInterface;
use Domain\Course\Entity\PageEntity;
use Infrastructure\Content\Plugin\Component\AbstractPluginControl;
use Nette\Application\UI\Form;
use Nette\Utils\Html;

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

        return $this->changeFormLayout($form);
    }

    public function createComponentValidatedForm(): Form
    {
        $form = new Form(null, 'pluginTestFormForm');
        $form->setHtmlAttribute('class', 'editForm unclickable');

        $this->appendFormControls($form, true);

        return $this->changeFormLayout($form);
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
        $reason = '';

        foreach ($question['answers'] as $key => $answer) {
            $answers[] = Html::el('div')
                ->addHtml(
                    Html::el('span')
                        ->setAttribute('class', 'image-option')
                )
                ->addText($answer['answer']);

            if ((bool) $answer['points'] === true) {
                $rightChoice = $key;
                $reason = $answer['reason'] ?? '';
            }
        }

        $control = $form->addRadioList('question' . $name, $question['question'], $answers)
            ->setRequired('Tato položka je povinná');
        $control->getSeparatorPrototype()->setName('');

        if ($showAnswer) {
            $control->setValue($rightChoice);

            if (!empty($reason)) {
                $control->setOption('description', $this->createDescriptionFromReason($reason));
            }
        }
    }

    private function appendMultiQuestion(Form $form, int $name, array $question, bool $showAnswer = false) : void
    {
        $answers = [];
        $rightChoices = [];
        $reasons = [];

        foreach ($question['answers'] as $key => $answer) {
            $answers[] = Html::el('div')
                ->addHtml(
                    Html::el('span')
                        ->setAttribute('class', 'image-option')
                )
                ->addText($answer['answer']);

            if ((bool) $answer['points'] === true) {
                $rightChoices[] = $key;

                $reasons[$key]['answer'] = $answer['answer'];
                $reasons[$key]['reason'] = $answer['reason'] ?? '';
            }
        }

        $control = $form->addCheckboxList('question' . $name, $question['question'], $answers)
            ->setRequired('Tato položka je povinná');
        $control->getSeparatorPrototype()->setName('');

        if ($showAnswer) {
            $control->setValue($rightChoices);

            if (!empty($reasons)) {
                $control->setOption('description', $this->createDescriptionFromReasons($reasons));
            }
        }
    }

    private function createDescriptionFromReason(string $reason) : Html
    {
        return $this->createDescription(Html::el('')->setText($reason));
    }

    private function createDescriptionFromReasons(array $reasons) : Html
    {
        $description = Html::el('div');

        foreach ($reasons as $key => $reason) {
            $pair = Html::el('div');

            $questionEl = Html::el('div')
                ->setAttribute('class', 'question')
                ->addText($reason['answer'] . ":");
            $reasonEl = Html::el('div')
                ->setAttribute('class', 'answer')
                ->addText($reason['reason']);

            $pair
                ->addHtml($questionEl)
                ->addHtml($reasonEl);

            $description
                ->addHtml($pair);
        }

        return $this->createDescription($description);
    }


    private function createDescription(Html $description) : Html
    {
        $infoPanel = Html::el('div')
            ->setAttribute('class', 'infoPanel')
            ->setText('Vysvětlení:');

        $infoContent = Html::el('div')
            ->setAttribute('class', 'infoContent')
            ->setHtml($description);

        return Html::el('div')
            ->setAttribute('class', 'reason')
            ->addHtml($infoPanel)
            ->addHtml($infoContent);
    }

    private function changeFormLayout(Form $form) : Form
    {
        $renderer = $form->getRenderer();
        $renderer->wrappers['controls']['container'] = Html::el('div')->setAttribute('class', 'controls-container');
        $renderer->wrappers['pair']['container'] = Html::el('div')->setAttribute('class', 'pair-container');
        $renderer->wrappers['label']['container'] = Html::el('div')->setAttribute('class', 'label-container');
        $renderer->wrappers['control']['container'] = Html::el('div')->setAttribute('class', 'control-container');

        return $form;
    }
}