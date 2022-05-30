<?php declare(strict_types = 1);

namespace Infrastructure\Content\Service;

use Domain\Content\Repository\Plugin\LiveCode\LiveCodeDatabaseRepositoryInterface;
use Infrastructure\Content\Service\Translator\DatabaseResultTranslator;
use Nette\Utils\FileSystem;

class LiveCodeExecutionProvider
{
    public const PLUGIN_LIVE_CODE_PATH = '/var/www/www/upload/plugin/liveCode';
    protected const FUNC_SCRIPT_NAME = '%sScript';

    protected $database;
    protected $databaseResultTranslator;

    public function __construct(
        LiveCodeDatabaseRepositoryInterface $liveCodeDatabase,
        DatabaseResultTranslator $databaseResultTranslator
    ) {
        $this->database = $liveCodeDatabase;
        $this->databaseResultTranslator = $databaseResultTranslator;
    }

    public function execute(string $sourceCode, string $language) : string
    {
        $func = \sprintf(
            self::FUNC_SCRIPT_NAME,
            $language
        );

        return \call_user_func([$this, $func], $sourceCode);
    }

    public function phpScript(string $sourceCode) : string
    {
        $fileName = $this->saveFile($sourceCode, 'php');

        $output = $this->executeScript('php', $fileName);

        $this->deleteFile($fileName);

        return $output;
    }

    public function htmlScript(string $sourceCode) : string
    {
        return $sourceCode;
    }

    public function pythonScript(string $sourceCode) : string
    {
        $fileName = $this->saveFile($sourceCode, 'py');

        $output = $this->executeScript('python3', $fileName);

        $this->deleteFile($fileName);

        return $output;
    }

    public function jsScript(string $sourceCode) : string
    {
        $fileName = $this->saveFile($sourceCode, 'js');

        $output = $this->executeScript('nodejs', $fileName);

        $this->deleteFile($fileName);

        return $output;
    }

    public function sqlScript(string $sourceCode) : string
    {
        $output = [];

        $data = $this->database->execute($sourceCode);

        $output[] = $this->databaseResultTranslator->translateSql($sourceCode);
        $output[] = $this->databaseResultTranslator->translateResult($data);

        return implode(' ', $output);
    }

    private function executeScript(string $language, string $fileName) : string
    {
        $commandParts = [
            $language,
            sprintf("%s/%s",self::PLUGIN_LIVE_CODE_PATH, $fileName),
            '2>&1',
        ];

        return (string) shell_exec(implode(' ', $commandParts));
    }

    private function saveFile(string $fileContent, string $extension) : string
    {
        $path = self::PLUGIN_LIVE_CODE_PATH;
        $fileName = $this->randomizeFileName();

        while (file_exists(sprintf('%s/%s.%s', $path, $fileName, $extension))) {
            $fileName = $this->randomizeFileName();
        }

        $fullFilePathWithName = sprintf('%s/%s.%s', $path, $fileName, $extension);

        FileSystem::write($fullFilePathWithName, $fileContent);

        return sprintf('%s.%s', $fileName, $extension);
    }

    private function deleteFile(string $fileName) : void
    {
        $file = sprintf('%s/%s', self::PLUGIN_LIVE_CODE_PATH, $fileName);

        if (file_exists($file)) {
            FileSystem::delete($file);
        }
    }

    private function randomizeFileName() : string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < 128; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}