<?php declare(strict_types = 1);

namespace Infrastructure\Component\Login;

interface LoginControlFactory
{
    public function create() : LoginControl;
}