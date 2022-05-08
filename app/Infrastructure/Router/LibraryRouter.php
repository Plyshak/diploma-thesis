<?php declare(strict_types = 1);

namespace Infrastructure\Router;

use Nette\Application\Routers\RouteList;

class LibraryRouter implements RouterServiceInterface
{
    public function getRoutes(): RouteList
    {
        $router = new RouteList;
        $router->addRoute('/knihovna', 'Library:list');
        $router->addRoute('/knihovna/upravit/<id \d+>', 'Library:edit');
        $router->addRoute('/knihovna/clanek/<id \d+>', 'Library:view');

        return $router;
    }
}