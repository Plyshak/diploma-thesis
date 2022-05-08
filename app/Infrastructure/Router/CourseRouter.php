<?php declare(strict_types = 1);

namespace Infrastructure\Router;

use Nette\Application\Routers\RouteList;

class CourseRouter implements RouterServiceInterface
{
    public function getRoutes(): RouteList
    {
        $router = new RouteList;
        $router->addRoute('/kurzy', 'Course:list');

        return $router;
    }
}