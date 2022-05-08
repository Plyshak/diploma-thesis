<?php declare(strict_types = 1);

namespace Domain\Label\Entity;

use Domain\Shared\Collection\Collection;

class LabelStackEntity
{
    protected $id;
    protected $module;
    protected $moduleId;
    protected $labels;

    public function __construct(
        int $id,
        string $module,
        int $moduleId,
        Collection $labels
    ) {
        $this->id = $id;
        $this->module = $module;
        $this->moduleId = $moduleId;
        $this->labels = $labels;
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

    public function getLabels(): Collection
    {
        return $this->labels;
    }
}