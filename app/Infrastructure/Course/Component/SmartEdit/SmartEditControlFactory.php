<?php declare(strict_types = 1);

namespace Infrastructure\Course\Component\SmartEdit;

interface SmartEditControlFactory
{
    public function create(?string $type, ?int $id) : SmartEditControl;
}