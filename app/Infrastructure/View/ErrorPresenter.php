<?php declare(strict_types = 1);

namespace Infrastructure\View;

use Throwable;

class ErrorPresenter extends AbstractPresenter
{
    protected const SUPPORTED_CUSTOM_ERRORS = [
        404,
        418,
        500,
    ];

    function getModuleName(): string
    {
        return 'error';
    }

    protected function beforeRender(): void
    {
        parent::beforeRender();

        bdump($this->getParameter('exception'));
        $this->template->setFile($this->resolveException());
    }

    private function resolveException() : string
    {
        $parameters = $this->getParameters();

        $fileParts = [
            __DIR__,
            'templates',
            'Error',
        ];

        if (isset($parameters['exception'])) {
            /** @var Throwable $exception */
            $exception = $parameters['exception'];
            $code = $exception->getCode();

            if (in_array($code, self::SUPPORTED_CUSTOM_ERRORS)) {
                $fileParts[] = sprintf('%d.latte', $code);
            } else {
                $fileParts[] = 'default.latte';
            }
        } else {
            $fileParts[] = 'default.latte';
        }

        return implode('/', $fileParts);
    }
}