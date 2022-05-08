<?php declare(strict_types = 1);

namespace Infrastructure\Component\Header;

interface HeaderControlFactory
{
    public function create() : HeaderControl;
}