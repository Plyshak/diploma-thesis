<?php declare(strict_types = 1);

namespace Infrastructure\View;

use Exception;

class TeapotPresenter extends AbstractPresenter
{
    protected function beforeRender(): void
    {
        throw new Exception("I'm a Teapot!", 418);
    }

    function getModuleName(): string
    {
        return 'teapot';
    }
}