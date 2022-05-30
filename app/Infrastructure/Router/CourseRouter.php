<?php declare(strict_types = 1);

namespace Infrastructure\Router;

use Nette\Application\Routers\RouteList;

class CourseRouter implements RouterServiceInterface
{
    public function getRoutes(): RouteList
    {
        $router = new RouteList;
        $router->addRoute('/kurzy', 'Course:list');
        $router->addRoute('/kurzy/prehled/<id \d+>', 'Course:view');
        $router->addRoute('/kurzy/upravit/<id \d+>', 'Course:edit');
        $router->addRoute('/kurzy/kurz/<courseId \d+>/kapitola-<chapterPosition \d+>/strana-<pagePosition \d+>', 'Course:page');

        return $router;
    }
}