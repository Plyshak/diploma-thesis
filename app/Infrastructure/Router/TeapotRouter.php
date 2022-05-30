<?php declare(strict_types = 1);

namespace Infrastructure\Router;

use Nette\Application\Routers\RouteList;

class TeapotRouter implements RouterServiceInterface
{
    public function getRoutes(): RouteList
    {
        $router = new RouteList();
        $router->addRoute('/Teapot', 'Teapot:default');

        return $router;
    }
}