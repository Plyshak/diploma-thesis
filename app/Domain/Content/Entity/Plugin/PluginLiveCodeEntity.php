<?php declare(strict_types = 1);

namespace Domain\Content\Entity\Plugin;

class PluginLiveCodeEntity extends AbstractPluginBlockEntity
{
    public const PREFIX = 'liveCode';
    public const SUPPORTED_LANGUAGES = [
        'html' => 'HTML + CSS',
        'php' => 'PHP',
        'js' => 'JavaScript',
        'python' => 'Python 3',
        'sql' => 'MySQL',
    ];

    protected $language;

    public function __construct(
        int $id,
        ?string $title,
        ?bool $showTitle,
        ?string $language
    ) {
        parent::__construct($id, $title, $showTitle);

        $this->language = $language;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function getLanguageName() : string
    {
        return self::SUPPORTED_LANGUAGES[$this->language];
    }

    public function getPluginPrefix(): string
    {
        return self::PREFIX;
    }
}