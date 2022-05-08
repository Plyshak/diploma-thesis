<?php declare(strict_types = 1);

namespace Infrastructure\User\Service;

use Domain\User\Exception\UserNotFoundException;
use Infrastructure\Database\Manager\UsersManager;
use Infrastructure\User\Entity\UserIdentity;
use Nette\Security\Authenticator;
use Nette\Security\IIdentity;

class AuthenticatorService implements Authenticator
{
    public const LOGIN_SUCCESS_MESSAGE = "Uživatel '%s' úspěšně přihlášen!";
    public const LOGOUT_SUCCESS_MESSAGE = "Uživatel '%s' úspěšně odhlášen!";
    public const LOGIN_ERROR_MESSAGE = 'Uživatele se nepodařilo přihlásit!';

    protected $userManager;

    public function __construct(UsersManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @param string $user
     * @param string $password
     *
     * @return IIdentity
     * @throws UserNotFoundException
     */
    public function authenticate(string $user, string $password): IIdentity
    {
        $user = $this->userManager->getByNameAndPassword($user, $password);

        return new UserIdentity(
            $user->getId(),
            $user->getExternalId(),
            $user->getName(),
            $user->getType()
        );
    }
}