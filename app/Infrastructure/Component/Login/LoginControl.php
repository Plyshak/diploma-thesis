<?php declare(strict_types = 1);

namespace Infrastructure\Component\Login;

use Domain\User\Repository\UsersRepositoryInterface;
use Infrastructure\Component\AbstractControl;

class LoginControl extends AbstractControl
{
    protected $onLogin = [];
    protected $onLogout = [];
    protected $userManager;

    public function __construct(UsersRepositoryInterface $usersManager)
    {
        $this->userManager = $usersManager;
    }

    public function setOnLogin(array $onLogin) : void
    {
        $this->onLogin = $onLogin;
    }

    public function setOnLogout(array $onLogout) : void
    {
        $this->onLogout = $onLogout;
    }

    public function addTemplateParameters(): void
    {
        parent::addTemplateParameters();

        $this->template->user = $this->getPresenter()->getUser();
        $this->template->users = $this->userManager->findAll();
    }

    public function handleLogin(string $type) : void
    {
        foreach ($this->onLogin as $onLoginAction) {
            $onLoginAction($type, md5($type));
        }

        $this->redrawControl('login');
    }

    public function handleLogout() : void
    {
        foreach ($this->onLogout as $onLogoutAction) {
            $onLogoutAction();
        }

        $this->redrawControl('login');
    }
}