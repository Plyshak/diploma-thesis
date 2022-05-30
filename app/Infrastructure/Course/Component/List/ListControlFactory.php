<?php declare(strict_types = 1);

namespace Infrastructure\Course\Component\List;

interface ListControlFactory
{
    public function create() : ListControl;
}