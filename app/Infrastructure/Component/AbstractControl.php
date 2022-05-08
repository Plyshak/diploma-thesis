<?php declare(strict_types = 1);

namespace Infrastructure\Component;

use Nette\Application\UI\Control;
use Nette\Utils\Arrays;
use Nette\Utils\Strings;

abstract class AbstractControl extends Control
{
    public function addTemplateParameters() : void
    {
    }

    public function render() : void
    {
        $path = $this->resolveTemplatePathName();

        $this->addTemplateParameters();

        $this->template->render($path);
    }

    protected function resolveTemplatePathName() : string
    {
        $className = get_class($this);
        $classParts = explode("\\", $className);
        $class = Arrays::last($classParts);

        $templatePath = ['/var/www/app'];

        foreach ($classParts as $classPart) {
            if ($classPart !== $class) {
                $templatePath[] = $classPart;
            }
        }

        $templatePath[] = 'template';
        $templatePath[] = $class . '.latte';

        return implode("/", $templatePath);
    }
}