<?php declare(strict_types = 1);

namespace Infrastructure\Component\Header;

use Domain\Menu\Entity\ValueObject\MenuItem;
use Domain\Menu\Service\MenuProviderInterface;
use Infrastructure\Component\AbstractControl;
use Infrastructure\Component\Login\LoginControl;
use Infrastructure\Component\Login\LoginControlFactory;
use Infrastructure\DataTransferObject\Menu;
use Nette\Utils\Strings;

class HeaderControl extends AbstractControl
{
    protected $onLogin = [];
    protected $onLogout = [];

    protected $menuProvider;
    protected $loginControlFactory;

    public function __construct(
        MenuProviderInterface $menuProvider,
        LoginControlFactory $loginControlFactory
    ) {
        $this->menuProvider = $menuProvider;
        $this->loginControlFactory = $loginControlFactory;
    }

    public function setOnLoginActions(array $onLoginAction) : void
    {
        $this->onLogin = $onLoginAction;
    }

    public function setOnLogoutActions(array $onLogoutAction) : void
    {
        $this->onLogout = $onLogoutAction;
    }

    public function addTemplateParameters(): void
    {
        parent::addTemplateParameters();

        $this->template->homepageLink = $this->getPresenter()->link('Homepage:default');
        $this->template->menu = $this->translateMenuLinks();
    }

    public function createComponentLogin() : LoginControl
    {
        $control = $this->loginControlFactory->create();
        $control->setOnLogin($this->onLogin);
        $control->setOnLogout($this->onLogout);


        return $control;
    }

    private function translateMenuLinks() : array
    {
        $menu = [];

        $domainMenu = $this->menuProvider->getMenu();

        $presenter = $this->getPresenter();
        $presenterName = $presenter->getRequest()->getPresenterName();

        /** @var MenuItem $domainMenuItem */
        foreach ($domainMenu as $domainMenuItem) {
            $link = $presenter->link($domainMenuItem->getLink());
            $title = $domainMenuItem->getTitle();
            $active = Strings::startsWith($domainMenuItem->getLink(), $presenterName);

            $menuItem = new Menu($title, $link, $active);

            $menu[] = $menuItem;
        }

        return $menu;
    }
}