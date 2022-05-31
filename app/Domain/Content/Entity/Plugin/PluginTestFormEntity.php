<?php declare(strict_types = 1);

namespace Domain\Content\Entity\Plugin;

class PluginTestFormEntity extends AbstractPluginBlockEntity
{
    public const PREFIX = 'testForm';
    protected $configuration;

    public function __construct(
        int $id,
        ?string $title,
        ?bool $showTitle,
        ?string $configuration
    ) {
        parent::__construct($id, $title, $showTitle);

        $this->configuration = $configuration ?? '';
    }

    public function getConfiguration(): string
    {
        return $this->configuration;
    }

    public function getPluginPrefix(): string
    {
        return self::PREFIX;
    }

    public function getParsedConfiguration() : array
    {
        $json = str_replace("\n", '', $this->configuration);

        return json_decode($json, true) ?? [];
    }
}