<?php declare(strict_types = 1);

namespace Infrastructure\Content\Service;

use Domain\Content\Entity\Plugin\PluginBlockEntityInterface;
use Domain\Content\Entity\Plugin\PluginCodeBlockEntity;
use Domain\Content\Entity\Plugin\PluginLiveCodeEntity;
use Domain\Content\Entity\Plugin\PluginPictureBlockEntity;
use Domain\Content\Entity\Plugin\PluginTestFormEntity;
use Domain\Content\Entity\Plugin\PluginTextBlockEntity;
use Domain\Content\Plugin\Component\PluginFormFactoryInterface;
use Nette\Application\UI\Form;
use Nette\Utils\Html;
use Nette\Utils\Strings;

class PluginFormFactoryService implements PluginFormFactoryInterface
{
    public const FUNC_PLUGIN_FORM_NAME = 'get%sForm';

    public function getPluginForm(PluginBlockEntityInterface $entity)
    {
        $func = \sprintf(
            self::FUNC_PLUGIN_FORM_NAME,
            Strings::firstUpper($entity->getPluginPrefix())
        );

        return \call_user_func([$this, $func], $entity);
    }

    public function createPluginForm(string $prefix)
    {
        $func = \sprintf(
            self::FUNC_PLUGIN_FORM_NAME,
            Strings::firstUpper($prefix)
        );

        return \call_user_func([$this, $func]);
    }

    public function getTextBlockForm(?PluginTextBlockEntity $entity = null)
    {
        $form = $this->getBasicBlockForm();

        //specific
        $form->addTextArea('perex', 'Krátký popis')
            ->setHtmlAttribute('class', 'smart-text')
            ->setMaxLength(255);
        $form->addTextArea('body', 'Tělo')
            ->setHtmlAttribute('class', 'smart-text');

        //button
        $form->addText('button_title', 'Tlačítko - název')
            ->setHtmlAttribute('class', 'smart-text');
        $form->addCheckbox('button_show', 'Tlačítko - zobrazit')
            ->setHtmlAttribute('class', 'toggle')
            ->setDefaultValue(true);
        $form->addText('button_url', 'Tlačítko - odkaz')
            ->setHtmlAttribute('class', 'smart-text');
        $form->addCheckbox('button_blank', 'Tlačítko - otevřít do nového okna')
            ->setHtmlAttribute('class', 'toggle');

        if ($entity) {
            $form->setDefaults([
                'title' => $entity->getTitle(),
                'show_title' => $entity->isShowTitle(),
                'perex' => $entity->getPerex(),
                'body' => $entity->getBody(),
                'button_title' => $entity->getButtonTitle(),
                'button_show' => $entity->isButtonShow(),
                'button_url' => $entity->getButtonUrl(),
                'button_blank' => $entity->isButtonBlank(),
            ]);
        }

        $form->addSubmit('submit', $this->getSubmitLabel($entity));

        return $form;
    }

    public function getPictureBlockForm(?PluginPictureBlockEntity $entity = null)
    {
        $form = $this->getBasicBlockForm();

        //specific
        $uploadControl = $form->addUpload('image', 'Obrázek');

        $form->addSelect(
            'picture_align',
            'Zarovnání obrázku',
            [
                'left' => 'Doleva',
                'center' => 'Na střed',
                'right' => 'Doprava',
            ]
        )
            ->setHtmlAttribute('class', 'smart-select');
        $form->addTextArea('picture_description', 'Popis obrázku')
            ->setHtmlAttribute('class', 'smart-text');
        $form->addCheckbox('picture_show_description', 'Zobrazit popis obrázku')
            ->setHtmlAttribute('class', 'toggle')
            ->setDefaultValue(false);
        $form->addSelect(
            'picture_width',
            'Šířka obrázku',
            [
                'full' => 'Plná šířka',
                'common' => 'Obecná',
            ]
        )
            ->setHtmlAttribute('class', 'smart-select');

        if ($entity) {
            $form->setDefaults([
                'title' => $entity->getTitle(),
                'show_title' => $entity->isShowTitle(),
                'picture_align' => $entity->getPictureAlign(),
                'picture_description' => $entity->getPictureDescription(),
                'picture_show_description' => $entity->isPictureShowDescription(),
                'picture_width' => $entity->getPictureWidth(),
            ]);

            $uploadControl->setOption('description', 'Obrázek je vložen');
        }

        $form->addSubmit('submit', $this->getSubmitLabel($entity));

        return $form;
    }

    public function getTestFormForm(?PluginTestFormEntity $entity = null)
    {
        $form = $this->getBasicBlockForm();

        $code = Html::el('div')
            ->setText('{
    "0": {
        "question": "Vyberte 1 spravnou odpoved:",
        "type": "single",
        "answers": {
            "0" : {
                "answer": "Toto je spatna odpoved",
                "points" : "0"
            },
            "1" : {
                "answer": "Toto je spravna odpoved",
                "points": "1",
                "reason": "Protože je napsáno, že je správná."
            }
        }
    },
    "1": {
        "question": "Vyberte vice spravnych odpovedi:",
        "type": "multi",
        "answers": {
            "0": {
                "answer": "Toto je spatna odpoved",
                "points" : "0"
            },
            "1": {
                "answer": "Toto je spravna odpoved",
                "points": "1",
                "reason": "Protože je napsáno, že je správná."
            },
            "2": {
                "answer": "Toto je spatna odpoved",
                "points" : "0"
            },
            "3": {
                "answer": "Toto je spravna odpoved",
                "points": "1",
                "reason": "Protože je napsáno, že je správná."
            }
        }
    }
}');

        $description = Html::el('div')
            ->addHtml(
                Html::el('div')
                    ->setText('Formulář je potřeba vkládat pomocí JSON syntaxe:')
            )
            ->addHtml(
                Html::el('pre')
                    ->addAttributes(['class' => 'json'])
                    ->setHtml($code)
            );

        $popup = Html::el('div')
            ->addHtml(
                Html::el('div')
                    ->setAttribute('class', 'form-description')
                    ->setText('Nápověda')
                    ->setAttribute('onclick', '$("#popup").toggleClass("hidden");')
            )
            ->addHtml(
                Html::el('div')
                    ->setAttribute('id', 'popup')
                    ->setAttribute('class', 'popup hidden')
                    ->setHtml($description)
            );

        $form->addTextArea('configuration', 'Testovací formulář')
            ->setHtmlAttribute('id', 'testFormWrapper')
            ->setOption('description', $popup);

        if ($entity) {
            $form->setDefaults([
                'title' => $entity->getTitle(),
                'show_title' => $entity->isShowTitle(),
                'configuration' => $entity->getConfiguration(),
            ]);
        }

        $form->addSubmit('submit', $this->getSubmitLabel($entity));

        return $form;
    }

    public function getCodeBlockForm(?PluginCodeBlockEntity $entity = null)
    {
        $form = $this->getBasicBlockForm();

        $form->addTextArea('code', 'Snippet kódu')
            ->setHtmlAttribute('class', 'smart-text');

        $form->addSelect('language', 'Jazyk', PluginCodeBlockEntity::SUPPORTED_CODE_LANGUAGES)
            ->setHtmlAttribute('class', 'smart-select');

        if ($entity) {
            $form->setDefaults([
                'title' => $entity->getTitle(),
                'show_title' => $entity->isShowTitle(),
                'code' => $entity->getCode(),
                'language' => $entity->getLanguage(),
            ]);
        }

        $form->addSubmit('submit', $this->getSubmitLabel($entity));

        return $form;
    }

    public function getLiveCodeForm(?PluginLiveCodeEntity $entity = null)
    {
        $form = $this->getBasicBlockForm();

        $form->addSelect('language', 'Jazyk', PluginLiveCodeEntity::SUPPORTED_LANGUAGES)
            ->setHtmlAttribute('class', 'smart-select');

        if ($entity) {
            $form->setDefaults([
                'title' => $entity->getTitle(),
                'show_title' => $entity->isShowTitle(),
                'language' => $entity->getLanguage(),
            ]);
        }

        $form->addSubmit('submit', $this->getSubmitLabel($entity));

        return $form;
    }

    private function getBasicBlockForm() : Form
    {
        $form = new Form(null, 'newPluginForm');
        $form->setHtmlAttribute('class', 'editForm');

        $form->addText('title', 'Název')
            ->setHtmlAttribute('class', 'smart-text');
        $form->addCheckbox('show_title', 'Zobrazit název')
            ->setHtmlAttribute('class', 'toggle')
            ->setDefaultValue(true);

        return $form;
    }

    private function getSubmitLabel(?PluginBlockEntityInterface $entity) : string
    {
        if ($entity !== null) {
            $message = 'Uložit blok';
        } else {
            $message = 'Vytvořit blok';
        }

        return $message;
    }
}
