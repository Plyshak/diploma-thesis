<?php declare(strict_types = 1);

namespace Infrastructure\Content\Service;

use Domain\Content\Entity\Plugin\PluginBlockEntityInterface;
use Domain\Content\Entity\Plugin\PluginPictureBlockEntity;
use Domain\Content\Entity\Plugin\PluginTextBlockEntity;
use Nette\Application\UI\Form;
use Nette\Utils\Strings;

class PluginFormFactoryService
{
    public const FUNC_PLUGIN_FORM_NAME = 'get%sForm';

    public function getPluginForm(PluginBlockEntityInterface $entity): Form
    {
        $func = \sprintf(
            self::FUNC_PLUGIN_FORM_NAME,
            Strings::firstUpper($entity->getPluginPrefix())
        );

        return \call_user_func([$this, $func], $entity);
    }

    public function createPluginForm(string $prefix): Form
    {
        $func = \sprintf(
            self::FUNC_PLUGIN_FORM_NAME,
            Strings::firstUpper($prefix)
        );

        return \call_user_func([$this, $func]);
    }

    public function getTextBlockForm(?PluginTextBlockEntity $entity = null): Form
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

    public function getPictureBlockForm(?PluginPictureBlockEntity $entity = null): Form
    {
        $form = $this->getBasicBlockForm();

        //specific
        $form->addUpload('image', 'Obrázek');

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
