<?php declare(strict_types = 1);

namespace Domain\Menu\Service;

use Domain\Menu\Entity\Menu;

interface MenuProviderInterface
{
    public function getMenu() : Menu;
}