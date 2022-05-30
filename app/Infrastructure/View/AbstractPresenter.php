<?php declare(strict_types = 1);

namespace Infrastructure\View;

use Domain\User\Exception\UserNotFoundException;
use Infrastructure\Component\Footer\FooterControl;
use Infrastructure\Component\Footer\FooterControlFactory;
use Infrastructure\Component\Header\HeaderControl;
use Infrastructure\Component\Header\HeaderControlFactory;
use Infrastructure\Exception\BadFileName;
use Infrastructure\Exception\FileExtensionNotSupported;
use Infrastructure\User\Entity\User;
use Infrastructure\User\Service\AuthenticatorService;
use Nette\Application\UI\Presenter;
use stdClass;

abstract class AbstractPresenter extends Presenter
{
    public const FLASH_MESSAGE_SUCCESS = 'success';
    public const FLASH_MESSAGE_ERROR = 'error';

    protected const CSS_FILE_PATH = "http://localhost/css/";
    protected const JS_FILE_PATH = "http://localhost/js/";

    protected const EXTENSION_CSS = "css";
    protected const EXTENSION_JS = "js";

    protected const SUPPORTED_FILE_EXTENSION = [
        self::EXTENSION_CSS,
        self::EXTENSION_JS,
    ];

    /** @var User @inject */
    public $user;

    /** @var HeaderControlFactory @inject */
    public $headerControlFactory;

    /** @var FooterControlFactory @inject */
    public $footerControlFactory;

    protected $cssFiles = [];
    protected $jsFiles = [];

    abstract function getModuleName() : string;

    public function createComponentHeader() : HeaderControl
    {
        $control = $this->headerControlFactory->create();
        $control->setOnLoginActions($this->getOnLoginActions());
        $control->setOnLogoutActions($this->getOnLogoutActions());

        return $control;
    }

    public function createComponentFooter() : FooterControl
    {
        return $this->footerControlFactory->create();
    }

    /**
     * @throws BadFileName
     * @throws FileExtensionNotSupported
     */
    protected function beforeRender() : void
    {
        parent::beforeRender();

        $this->addFileByExtension('common.css');
        $this->addFileByExtension('content.css');
        $this->addFileByExtension('header.css');
        $this->addFileByExtension('footer.css');
        $this->addFileByExtension('labels.css');
        $this->addFileByExtension('library.css');
        $this->addFileByExtension('discussion.css');
        $this->addFileByExtension('course.css');
        $this->addFileByExtension('nittro-min.css');
        $this->addFileByExtension('prism-min.css');
        $this->addFileByExtension('nittro-min.js');

        $this->appendFiles();

        $this->template->moduleName = $this->getModuleName();
    }

    protected function appendFiles() : void
    {
        $this->template->cssFiles = $this->cssFiles;
        $this->template->jsFiles = $this->jsFiles;
    }

    /**
     * @throws FileExtensionNotSupported
     * @throws BadFileName
     */
    protected function addFileByExtension(string $file) : void
    {
        $fileParts = explode('.', $file);

        if (count($fileParts) !== 2) {
            throw new BadFileName($file);
        }

        $extension = $fileParts[1];

        if (!in_array($extension, self::SUPPORTED_FILE_EXTENSION)) {
            throw new FileExtensionNotSupported($extension, self::SUPPORTED_FILE_EXTENSION);
        }

        switch ($extension) {
            case self::EXTENSION_CSS:
                $this->appendCssFile($file);
                break;
            case self::EXTENSION_JS:
                $this->appendJsFile($file);
                break;
        }
    }

    protected function appendCssFile(string $fileName) : void
    {
        $this->cssFiles[] = self::CSS_FILE_PATH . $fileName;
    }

    protected function appendJsFile(string $fileName) : void
    {
        $this->jsFiles[] = self::JS_FILE_PATH . $fileName;
    }

    /**
     * @return callable[]
     */
    private function getOnLoginActions() : array
    {
        $user = $this->getUser();

        return [
            function (string $username, string $password) use ($user) {
                try {
                    $user->login($username, $password);
                    $this->redrawControl('pageContent');
                } catch (UserNotFoundException $e) {
                    $this->redrawControl('pageContent');
                }
            },
        ];
    }

    /**
     * @return callable[]
     */
    private function getOnLogoutActions() : array
    {
        $user = $this->getUser();

        return [
            function () use ($user) {
                $this->redrawControl('pageContent');
                $user->logout(true);
            },
        ];
    }
}