<?php declare(strict_types = 1);

namespace Infrastructure\Router;

use Nette\Application\Routers\RouteList;

interface RouterServiceInterface
{
    public function getRoutes() : RouteList;
}