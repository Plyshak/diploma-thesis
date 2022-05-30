<?php declare(strict_types = 1);

namespace Infrastructure\Router;

use Nette\Application\Routers\RouteList;

class ErrorRouter implements RouterServiceInterface
{
    public function getRoutes(): RouteList
    {
        $router = new RouteList();
        $router->addRoute('/Error', 'Error:default');

        return $router;
    }
}