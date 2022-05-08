<?php declare(strict_types = 1);

namespace Application\Menu\Service;

use Domain\Menu\Entity\Menu;
use Domain\Menu\Entity\ValueObject\MenuItem;
use Domain\Menu\Service\MenuProviderInterface;

class MenuProvider implements MenuProviderInterface
{
    public function getMenu(): Menu
    {
        $menu = new Menu();

        $menu->addItem(MenuItem::createFromParameters("Knihovna", MenuItem::LINK_LIBRARY));
        $menu->addItem(MenuItem::createFromParameters("Diskuze", MenuItem::LINK_DISCUSSION));
        $menu->addItem(MenuItem::createFromParameters("Kurzy", MenuItem::LINK_COURSES));

        return $menu;
    }
}