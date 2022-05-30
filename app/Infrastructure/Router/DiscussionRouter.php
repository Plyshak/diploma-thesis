<?php declare(strict_types = 1);

namespace Infrastructure\Router;

use Nette\Application\Routers\RouteList;

class DiscussionRouter implements RouterServiceInterface
{
    public function getRoutes(): RouteList
    {
        $router = new RouteList;
        $router->addRoute('/diskuze', 'Discussion:list');
        $router->addRoute('/diskuze/upravit/<id \d+>', 'Discussion:edit');
        $router->addRoute('/diskuze/tema/<id \d+>', 'Discussion:view');
        $router->addRoute('/diskuze/tema/<discussionId \d+>/komentar/<commentId \d+>', 'Discussion:comment');

        return $router;
    }
}