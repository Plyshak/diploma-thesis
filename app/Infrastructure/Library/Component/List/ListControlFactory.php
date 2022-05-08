<?php declare(strict_types = 1);

namespace Infrastructure\Library\Component\List;

interface ListControlFactory
{
    public function create() : ListControl;
}