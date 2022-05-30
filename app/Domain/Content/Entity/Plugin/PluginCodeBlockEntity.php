<?php declare(strict_types = 1);

namespace Domain\Content\Entity\Plugin;

class PluginCodeBlockEntity extends AbstractPluginBlockEntity
{
    public const PREFIX = 'codeBlock';
    public const SUPPORTED_CODE_LANGUAGES = [
        'css' => 'CSS',
        'js' => 'JavaScript',
        'html' => 'HTML',
        'xml' => 'XML',
        'bash' => 'Bash',
        'shell' => 'Shell',
        'c' => 'C',
        'cs' => 'C#',
        'cpp' => 'C++',
        'coffee' => 'CoffeeScript',
        'csv' => 'CSV',
        'docker' => 'Docker',
        'xlsx' => 'Microsoft Excel Formula',
        'po' => 'Gettext',
        'git' => 'Git',
        'http' => 'HTTP',
        'java' => 'Java',
        'json' => 'JSON',
        'latte' => 'Nette Latte',
        'log' => 'Log file',
        'makefile' => 'Makefile',
        'md' => 'Markdown',
        'mongodb' => 'MongoDB',
        'nginx' => 'Nginx',
        'pascal' => 'Pascal',
        'perl' => 'Perl',
        'php' => 'PHP',
        'phpdoc' => 'PHPDoc',
        'plantuml' => 'PlantUML',
        'powershell' => 'PowerShell',
        'py' => 'Python',
        'jsx' => 'React JSX',
        'tsx' => 'React TSX',
        'regex' => 'Regex',
        'rpy' => 'Ren\'Py',
        'ruby' => 'Ruby',
        'sql' => 'SQL',
        'swift' => 'swift',
        'ts' => 'TypeScript',
        'yml' => 'YAML',
    ];

    protected $code;
    protected $language;

    public function __construct(
        int $id,
        ?string $title,
        ?bool $showTitle,
        ?string $code,
        ?string $language
    ) {
        parent::__construct($id, $title, $showTitle);

        $this->code = $code ?? '';
        $this->language = $language ?? '';
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getLanguage() : string
    {
        return $this->language;
    }

    public function getPluginPrefix(): string
    {
        return self::PREFIX;
    }
}