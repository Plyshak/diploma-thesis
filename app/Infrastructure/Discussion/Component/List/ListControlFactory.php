<?php declare(strict_types = 1);

namespace Infrastructure\Discussion\Component\List;

interface ListControlFactory
{
    public function create() : ListControl;
}