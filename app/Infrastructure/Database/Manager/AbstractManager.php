<?php declare(strict_types = 1);

namespace Infrastructure\Database\Manager;

use Nette\Database\Explorer;
use Nette\Database\Table\Selection;
use Nette\Http\FileUpload;
use Nette\Utils\Arrays;
use Nette\Utils\Strings;

abstract class AbstractManager
{
    public const UPLOAD_IMAGE_PATH = '/upload/';

    protected $database;

    public function __construct(Explorer $database)
    {
        $this->database = $database;
    }

    protected function getTable() : Selection
    {
        return $this->database->table($this->getTableName());
    }

    protected function getTableName() : string
    {
        $classParts = explode('\\', get_class($this));

        $name = Strings::replace(
            Arrays::last($classParts),
            '/Manager/',
            ''
        );

        return $this->toUnderscore($name);
    }

    protected function uploadFile(FileUpload $fileUpload) : ?string
    {
        if ($fileUpload->hasFile()) {
            $imageName = $fileUpload->getUntrustedName();
            $extension = Arrays::last(explode('.', $imageName));
            $fileName = $this->randomizeFileName();

            $file = $this->resolveUplodFileName($fileName, $extension);
            $fileUpload->move('/var/www/www/' . $file);
        } else {
            $file = null;
        }

        return $file;
    }

    protected function resolveUplodFileName(string $fileName, string $fileExtension) : string
    {
        $name = $this->getFileUploadPath() . $fileName . '.' . $fileExtension;

        $rows = $this->getTable()
            ->where(['image' => $name])
            ->fetchAll();

        if (count($rows) !== 0) {
            $name = $this->resolveUplodFileName($this->randomizeFileName(), $fileExtension);
        }

        return $name;
    }

    protected function randomizeFileName() : string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 128; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    protected function getFileUploadPath() : string
    {
        return self::UPLOAD_IMAGE_PATH;
    }

    private function toUnderscore(string $input) : string
    {
        $pattern = '!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!';
        preg_match_all($pattern, $input, $matches);
        $ret = $matches[0];

        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ?
                strtolower($match) :
                lcfirst($match);
        }

        return implode('_', $ret);
    }
}