<?php declare(strict_types = 1);

namespace Infrastructure\Router;

use Nette\Application\Routers\RouteList;

class DiscussionRouter implements RouterServiceInterface
{
    public function getRoutes(): RouteList
    {
        $router = new RouteList;
        $router->addRoute('/diskuze', 'Discussion:list');

        return $router;
    }
}