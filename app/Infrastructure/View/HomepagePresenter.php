<?php declare(strict_types = 1);

namespace Infrastructure\View;

class HomepagePresenter extends AbstractPresenter
{
    public function getModuleName(): string
    {
        return 'homepage';
    }
}