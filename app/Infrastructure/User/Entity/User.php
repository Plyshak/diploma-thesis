<?php declare(strict_types = 1);

namespace Infrastructure\User\Entity;

use Nette\Bridges\SecurityHttp\CookieStorage;
use Nette\Security\Authorizator;
use Nette\Security\IAuthenticator;
use Nette\Security\IUserStorage;
use Nette\Security\User as NetteUser;

class User extends NetteUser
{
    public function __construct(
        IUserStorage $legacyStorage = null,
        IAuthenticator $authenticator = null,
        Authorizator $authorizator = null,
        CookieStorage $storage = null
    ) {
        parent::__construct(
            $legacyStorage,
            $authenticator,
            $authorizator,
            $storage
        );
    }
}