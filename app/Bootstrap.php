<?php declare(strict_types = 1);

namespace App;

use Nette\Bootstrap\Configurator;
use Nette\Utils\Finder;

class Bootstrap
{
	public static function boot(): Configurator
	{
		$configurator = new Configurator;
		$appDir = dirname(__DIR__);

		$configurator->setDebugMode(true); // enable for your remote IP
		$configurator->enableTracy($appDir . '/log');

		$configurator->setTimeZone('Europe/Prague');
		$configurator->setTempDirectory($appDir . '/temp');

		$configurator->createRobotLoader()
			->addDirectory(__DIR__)
			->register();

        # load project config files
        $projectConfigFiles = Finder::findFiles("*.neon")->from($appDir . '/config');

        foreach ($projectConfigFiles as $projectConfigFile) {
            $configurator->addConfig($projectConfigFile->getPathname());
        }

        # load infrastructure project files
        $infrastructureConfigFiles = Finder::findFiles("*.neon")->from($appDir . '/app/Infrastructure/config');

        foreach ($infrastructureConfigFiles as $infrastructureConfigFile) {
            $configurator->addConfig($infrastructureConfigFile->getPathname());
        }

        # load application project files
        $applicationConfigFiles = Finder::findFiles("*.neon")->from($appDir . '/app/Application/config');

        foreach ($applicationConfigFiles as $applicationConfigFile) {
            $configurator->addConfig($applicationConfigFile->getPathname());
        }

        # load domain project files
        $domainConfigFiles = Finder::findFiles("*.neon")->from($appDir . '/app/Domain/config');

        foreach ($domainConfigFiles as $domainConfigFile) {
            $configurator->addConfig($domainConfigFile->getPathname());
        }

		return $configurator;
	}
}
