<?php declare(strict_types = 1);

namespace Infrastructure\Router;

use Nette\Application\Routers\RouteList;

class RouterFactory
{
    /**
     * @param RouterServiceInterface[] $routerServices
     *
     * @return RouteList
     */
    public function createRouter(array $routerServices): RouteList
    {
        $router = new RouteList();

        foreach ($routerServices as $routerService) {
            $router->add($routerService->getRoutes());
        }

        return $router;
    }
}