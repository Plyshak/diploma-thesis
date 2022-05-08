<?php declare(strict_types = 1);

namespace Infrastructure\Router;

use Nette\Application\Routers\RouteList;

class HomepageRouter implements RouterServiceInterface
{
    public function getRoutes(): RouteList
    {
        $router = new RouteList;
        $router->addRoute('/', 'Homepage:default');

        return $router;
    }
}