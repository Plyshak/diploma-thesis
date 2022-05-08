<?php declare(strict_types = 1);

namespace Domain\Content\Entity;

class ContentEntity
{
    protected $id;
    protected $module;
    protected $moduleId;

    public function __construct(
        int $id,
        string $module,
        int $moduleId
    ) {
        $this->id = $id;
        $this->module = $module;
        $this->moduleId = $moduleId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getModule(): string
    {
        return $this->module;
    }

    public function getModuleId(): int
    {
        return $this->moduleId;
    }
}