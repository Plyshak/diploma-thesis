<?php declare(strict_types = 1);

namespace Infrastructure\Component\Footer;

interface FooterControlFactory
{
    public function create() : FooterControl;
}