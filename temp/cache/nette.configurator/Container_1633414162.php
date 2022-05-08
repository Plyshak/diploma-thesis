<?php
// source: /var/www/config/default.neon
// source: /var/www/config/local.neon
// source: /var/www/app/Infrastructure/config/component.neon
// source: /var/www/app/Infrastructure/config/content.neon
// source: /var/www/app/Infrastructure/config/database.neon
// source: /var/www/app/Infrastructure/config/library.neon
// source: /var/www/app/Infrastructure/config/router.neon
// source: /var/www/app/Infrastructure/config/user.neon
// source: /var/www/app/Application/config/menu.neon
// source: /var/www/app/Domain/config/content.neon
// source: /var/www/app/Domain/config/label.neon
// source: array

/** @noinspection PhpParamsInspection,PhpMethodMayBeStaticInspection */

declare(strict_types=1);

class Container_1633414162 extends Nette\DI\Container
{
	protected $types = ['container' => 'Nette\DI\Container'];

	protected $aliases = [
		'application' => 'application.application',
		'cacheStorage' => 'cache.storage',
		'database.default' => 'database.default.connection',
		'database.default.context' => 'database.default.explorer',
		'httpRequest' => 'http.request',
		'httpResponse' => 'http.response',
		'nette.cacheJournal' => 'cache.journal',
		'nette.database.default' => 'database.default',
		'nette.database.default.context' => 'database.default.explorer',
		'nette.httpRequestFactory' => 'http.requestFactory',
		'nette.latteFactory' => 'latte.latteFactory',
		'nette.mailer' => 'mail.mailer',
		'nette.presenterFactory' => 'application.presenterFactory',
		'nette.templateFactory' => 'latte.templateFactory',
		'nette.userStorage' => 'security.userStorage',
		'session' => 'session.session',
		'user' => 'security.user',
	];

	protected $wiring = [
		'Nette\DI\Container' => [['container']],
		'Nette\Application\Application' => [['application.application']],
		'Nette\Application\IPresenterFactory' => [['application.presenterFactory']],
		'Nette\Application\LinkGenerator' => [['application.linkGenerator']],
		'Nette\Caching\Storages\Journal' => [['cache.journal']],
		'Nette\Caching\Storage' => [['cache.storage']],
		'Nette\Database\Connection' => [['database.default.connection']],
		'Nette\Database\IStructure' => [['database.default.structure']],
		'Nette\Database\Structure' => [['database.default.structure']],
		'Nette\Database\Conventions' => [['database.default.conventions']],
		'Nette\Database\Conventions\DiscoveredConventions' => [['database.default.conventions']],
		'Nette\Database\Explorer' => [['database.default.explorer']],
		'Nette\Http\RequestFactory' => [['http.requestFactory']],
		'Nette\Http\IRequest' => [['http.request']],
		'Nette\Http\Request' => [['http.request']],
		'Nette\Http\IResponse' => [['http.response']],
		'Nette\Http\Response' => [['http.response']],
		'Nette\Bridges\ApplicationLatte\LatteFactory' => [['latte.latteFactory']],
		'Nette\Application\UI\TemplateFactory' => [['latte.templateFactory']],
		'Nette\Bridges\ApplicationLatte\TemplateFactory' => [['latte.templateFactory']],
		'Nette\Mail\Mailer' => [['mail.mailer']],
		'Nette\Security\Passwords' => [['security.passwords']],
		'Nette\Security\UserStorage' => [['security.userStorage']],
		'Nette\Security\IUserStorage' => [['security.legacyUserStorage']],
		'Nette\Security\User' => [['security.user']],
		'Infrastructure\User\Entity\User' => [['security.user']],
		'Nette\Http\Session' => [['session.session']],
		'Tracy\ILogger' => [['tracy.logger']],
		'Tracy\BlueScreen' => [['tracy.blueScreen']],
		'Tracy\Bar' => [['tracy.bar']],
		'Infrastructure\Component\Footer\FooterControlFactory' => [['component.footerControl']],
		'Infrastructure\Component\Header\HeaderControlFactory' => [['component.headerControl']],
		'Infrastructure\Component\Login\LoginControlFactory' => [['component.loginControl']],
		'Infrastructure\Content\Plugin\Component\PluginControlFactoryInterface' => [
			['content.plugin.component.pictureBlock.factory', 'content.plugin.component.textBlock.factory'],
		],
		'Infrastructure\Content\Plugin\Component\PictureBlock\PictureBlockPluginControlFactory' => [
			['content.plugin.component.pictureBlock.factory'],
		],
		'Infrastructure\Content\Plugin\Component\TextBlock\TextBlockPluginControlFactory' => [
			['content.plugin.component.textBlock.factory'],
		],
		'Infrastructure\Content\Component\AddPlugin\AddPluginControlFactory' => [['content.component.addPlugin']],
		'Infrastructure\Content\Component\Content\ContentControlFactory' => [['content.component.content']],
		'Infrastructure\Content\Component\ContentBuilder\ContentBuilderControlFactory' => [
			['content.component.contentBuilder'],
		],
		'Infrastructure\Content\Component\ListPlugin\ListPluginControlFactory' => [['content.component.listPlugin']],
		'Infrastructure\Content\Service\PluginFormFactoryService' => [['content.service.pluginFormFactory']],
		'Infrastructure\Content\Service\PluginService' => [['content.service.pluginService']],
		'Infrastructure\Database\Manager\AbstractManager' => [
			[
				'database.manager.library.libraryManager',
				'database.manager.label.labelBridgeManager',
				'database.manager.label.labelStackManager',
				'database.manager.label.labelManager',
				'database.manager.content.plugin.textBlock',
				'database.manager.content.plugin.pictureBlock',
				'database.manager.content.contentManager',
				'database.manager.content.pluginManager',
				'database.manager.user.usersManager',
				'database.manager.user.userTypeManager',
			],
		],
		'Domain\Library\Repository\LibraryRepositoryInterface' => [['database.manager.library.libraryManager']],
		'Infrastructure\Database\Manager\LibraryManager' => [['database.manager.library.libraryManager']],
		'Domain\Label\Repository\LabelBridgeRepositoryInterface' => [['database.manager.label.labelBridgeManager']],
		'Infrastructure\Database\Manager\LabelBridgeManager' => [['database.manager.label.labelBridgeManager']],
		'Domain\Label\Repository\LabelStackRepositoryInterface' => [['database.manager.label.labelStackManager']],
		'Infrastructure\Database\Manager\LabelStackManager' => [['database.manager.label.labelStackManager']],
		'Domain\Label\Repository\LabelRepositoryInterface' => [['database.manager.label.labelManager']],
		'Infrastructure\Database\Manager\LabelManager' => [['database.manager.label.labelManager']],
		'Domain\Content\Repository\Plugin\PluginTextBlockRepositoryInterface' => [
			['database.manager.content.plugin.textBlock'],
		],
		'Domain\Content\Repository\Plugin\PluginBlockRepositoryInterface' => [
			['database.manager.content.plugin.textBlock', 'database.manager.content.plugin.pictureBlock'],
		],
		'Infrastructure\Database\Manager\PluginTextBlockManager' => [['database.manager.content.plugin.textBlock']],
		'Domain\Content\Repository\Plugin\PluginPictureBlockRepositoryInterface' => [
			['database.manager.content.plugin.pictureBlock'],
		],
		'Infrastructure\Database\Manager\PluginPictureBlockManager' => [['database.manager.content.plugin.pictureBlock']],
		'Domain\Content\Repository\ContentRepositoryInterface' => [['database.manager.content.contentManager']],
		'Infrastructure\Database\Manager\ContentManager' => [['database.manager.content.contentManager']],
		'Domain\Content\Repository\PluginRepositoryInterface' => [['database.manager.content.pluginManager']],
		'Infrastructure\Database\Manager\PluginManager' => [['database.manager.content.pluginManager']],
		'Domain\User\Repository\UsersRepositoryInterface' => [['database.manager.user.usersManager']],
		'Infrastructure\Database\Manager\UsersManager' => [['database.manager.user.usersManager']],
		'Domain\User\Repository\UserTypeRepositoryInterface' => [['database.manager.user.userTypeManager']],
		'Infrastructure\Database\Manager\UserTypeManager' => [['database.manager.user.userTypeManager']],
		'Infrastructure\Database\Service\Database' => [['database.service.database']],
		'Infrastructure\Library\Component\Article\ArticleControlFactory' => [['library.component.articleControl']],
		'Infrastructure\Library\Component\List\ListControlFactory' => [['library.component.listControl']],
		'Infrastructure\Router\RouterServiceInterface' => [
			['router.service.homepage', 'router.service.course', 'router.service.library', 'router.service.discussion'],
		],
		'Infrastructure\Router\HomepageRouter' => [['router.service.homepage']],
		'Infrastructure\Router\CourseRouter' => [['router.service.course']],
		'Infrastructure\Router\LibraryRouter' => [['router.service.library']],
		'Infrastructure\Router\DiscussionRouter' => [['router.service.discussion']],
		'Infrastructure\Router\RouterFactory' => [['router.factory']],
		'Nette\Routing\RouteList' => [['router']],
		'Nette\Routing\Router' => [['router']],
		'ArrayAccess' => [2 => ['router', 'application.1', 'application.2', 'application.3', 'application.4']],
		'Countable' => [2 => ['router']],
		'IteratorAggregate' => [2 => ['router']],
		'Traversable' => [2 => ['router']],
		'Nette\Application\Routers\RouteList' => [['router']],
		'Nette\Security\Authenticator' => [['user.service.authenticator']],
		'Nette\Security\IAuthenticator' => [['user.service.authenticator']],
		'Infrastructure\User\Service\AuthenticatorService' => [['user.service.authenticator']],
		'Domain\Menu\Service\MenuProviderInterface' => [['application.menu.provider']],
		'Application\Menu\Service\MenuProvider' => [['application.menu.provider']],
		'Domain\Content\Service\ContentService' => [['content.service.contentService']],
		'Domain\Label\Service\LabelService' => [['label.service.labelService']],
		'Infrastructure\View\AbstractPresenter' => [
			2 => ['application.1', 'application.2', 'application.3', 'application.4'],
		],
		'Nette\Application\UI\Presenter' => [2 => ['application.1', 'application.2', 'application.3', 'application.4']],
		'Nette\Application\UI\Control' => [2 => ['application.1', 'application.2', 'application.3', 'application.4']],
		'Nette\Application\UI\Component' => [2 => ['application.1', 'application.2', 'application.3', 'application.4']],
		'Nette\ComponentModel\Container' => [2 => ['application.1', 'application.2', 'application.3', 'application.4']],
		'Nette\ComponentModel\Component' => [2 => ['application.1', 'application.2', 'application.3', 'application.4']],
		'Nette\ComponentModel\IComponent' => [2 => ['application.1', 'application.2', 'application.3', 'application.4']],
		'Nette\ComponentModel\IContainer' => [2 => ['application.1', 'application.2', 'application.3', 'application.4']],
		'Nette\Application\UI\SignalReceiver' => [
			2 => ['application.1', 'application.2', 'application.3', 'application.4'],
		],
		'Nette\Application\UI\StatePersistent' => [
			2 => ['application.1', 'application.2', 'application.3', 'application.4'],
		],
		'Nette\Application\UI\Renderable' => [2 => ['application.1', 'application.2', 'application.3', 'application.4']],
		'Nette\Application\IPresenter' => [
			2 => ['application.1', 'application.2', 'application.3', 'application.4', 'application.5', 'application.6'],
		],
		'Infrastructure\View\CoursePresenter' => [2 => ['application.1']],
		'Infrastructure\View\DiscussionPresenter' => [2 => ['application.2']],
		'Infrastructure\View\HomepagePresenter' => [2 => ['application.3']],
		'Infrastructure\View\LibraryPresenter' => [2 => ['application.4']],
		'NetteModule\ErrorPresenter' => [2 => ['application.5']],
		'NetteModule\MicroPresenter' => [2 => ['application.6']],
	];


	public function __construct(array $params = [])
	{
		parent::__construct($params);
		$this->parameters += [];
	}


	public function createServiceApplication__1(): Infrastructure\View\CoursePresenter
	{
		$service = new Infrastructure\View\CoursePresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('router'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory'),
		);
		$service->user = $this->getService('security.user');
		$service->headerControlFactory = $this->getService('component.headerControl');
		$service->footerControlFactory = $this->getService('component.footerControl');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__2(): Infrastructure\View\DiscussionPresenter
	{
		$service = new Infrastructure\View\DiscussionPresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('router'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory'),
		);
		$service->user = $this->getService('security.user');
		$service->headerControlFactory = $this->getService('component.headerControl');
		$service->footerControlFactory = $this->getService('component.footerControl');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__3(): Infrastructure\View\HomepagePresenter
	{
		$service = new Infrastructure\View\HomepagePresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('router'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory'),
		);
		$service->user = $this->getService('security.user');
		$service->headerControlFactory = $this->getService('component.headerControl');
		$service->footerControlFactory = $this->getService('component.footerControl');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__4(): Infrastructure\View\LibraryPresenter
	{
		$service = new Infrastructure\View\LibraryPresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('router'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory'),
		);
		$service->user = $this->getService('security.user');
		$service->listControlFactory = $this->getService('library.component.listControl');
		$service->libraryManager = $this->getService('database.manager.library.libraryManager');
		$service->labelService = $this->getService('label.service.labelService');
		$service->headerControlFactory = $this->getService('component.headerControl');
		$service->footerControlFactory = $this->getService('component.footerControl');
		$service->contentControlFactory = $this->getService('content.component.content');
		$service->contentBuilderFactory = $this->getService('content.component.contentBuilder');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__5(): NetteModule\ErrorPresenter
	{
		return new NetteModule\ErrorPresenter($this->getService('tracy.logger'));
	}


	public function createServiceApplication__6(): NetteModule\MicroPresenter
	{
		return new NetteModule\MicroPresenter($this, $this->getService('http.request'), $this->getService('router'));
	}


	public function createServiceApplication__application(): Nette\Application\Application
	{
		$service = new Nette\Application\Application(
			$this->getService('application.presenterFactory'),
			$this->getService('router'),
			$this->getService('http.request'),
			$this->getService('http.response'),
		);
		$service->catchExceptions = null;
		$service->errorPresenter = 'Nette:Error';
		Nette\Bridges\ApplicationDI\ApplicationExtension::initializeBlueScreenPanel(
			$this->getService('tracy.blueScreen'),
			$service,
		);
		$this->getService('tracy.bar')->addPanel(new Nette\Bridges\ApplicationTracy\RoutingPanel(
			$this->getService('router'),
			$this->getService('http.request'),
			$this->getService('application.presenterFactory'),
		));
		return $service;
	}


	public function createServiceApplication__linkGenerator(): Nette\Application\LinkGenerator
	{
		return new Nette\Application\LinkGenerator(
			$this->getService('router'),
			$this->getService('http.request')->getUrl()->withoutUserInfo(),
			$this->getService('application.presenterFactory'),
		);
	}


	public function createServiceApplication__menu__provider(): Application\Menu\Service\MenuProvider
	{
		return new Application\Menu\Service\MenuProvider;
	}


	public function createServiceApplication__presenterFactory(): Nette\Application\IPresenterFactory
	{
		$service = new Nette\Application\PresenterFactory(new Nette\Bridges\ApplicationDI\PresenterFactoryCallback($this, 5, '/var/www/temp/cache/nette.application/touch'));
		$service->setMapping(['*' => 'Infrastructure\View\*Presenter']);
		return $service;
	}


	public function createServiceCache__journal(): Nette\Caching\Storages\Journal
	{
		return new Nette\Caching\Storages\SQLiteJournal('/var/www/temp/cache/journal.s3db');
	}


	public function createServiceCache__storage(): Nette\Caching\Storage
	{
		return new Nette\Caching\Storages\FileStorage('/var/www/temp/cache', $this->getService('cache.journal'));
	}


	public function createServiceComponent__footerControl(): Infrastructure\Component\Footer\FooterControlFactory
	{
		return new class ($this) implements Infrastructure\Component\Footer\FooterControlFactory {
			private $container;


			public function __construct(Container_1633414162 $container)
			{
				$this->container = $container;
			}


			public function create(): Infrastructure\Component\Footer\FooterControl
			{
				return new Infrastructure\Component\Footer\FooterControl;
			}
		};
	}


	public function createServiceComponent__headerControl(): Infrastructure\Component\Header\HeaderControlFactory
	{
		return new class ($this) implements Infrastructure\Component\Header\HeaderControlFactory {
			private $container;


			public function __construct(Container_1633414162 $container)
			{
				$this->container = $container;
			}


			public function create(): Infrastructure\Component\Header\HeaderControl
			{
				return new Infrastructure\Component\Header\HeaderControl(
					$this->container->getService('application.menu.provider'),
					$this->container->getService('component.loginControl'),
				);
			}
		};
	}


	public function createServiceComponent__loginControl(): Infrastructure\Component\Login\LoginControlFactory
	{
		return new class ($this) implements Infrastructure\Component\Login\LoginControlFactory {
			private $container;


			public function __construct(Container_1633414162 $container)
			{
				$this->container = $container;
			}


			public function create(): Infrastructure\Component\Login\LoginControl
			{
				return new Infrastructure\Component\Login\LoginControl;
			}
		};
	}


	public function createServiceContainer(): Container_1633414162
	{
		return $this;
	}


	public function createServiceContent__component__addPlugin(): Infrastructure\Content\Component\AddPlugin\AddPluginControlFactory
	{
		return new class ($this) implements Infrastructure\Content\Component\AddPlugin\AddPluginControlFactory {
			private $container;


			public function __construct(Container_1633414162 $container)
			{
				$this->container = $container;
			}


			public function create(Domain\Content\Entity\ContentEntity $entity): Infrastructure\Content\Component\AddPlugin\AddPluginControl
			{
				return new Infrastructure\Content\Component\AddPlugin\AddPluginControl(
					$entity,
					$this->container->getService('content.service.pluginService'),
					$this->container->getService('content.service.pluginFormFactory'),
					[
						$this->container->getService('content.plugin.component.pictureBlock.factory'),
						$this->container->getService('content.plugin.component.textBlock.factory'),
					],
				);
			}
		};
	}


	public function createServiceContent__component__content(): Infrastructure\Content\Component\Content\ContentControlFactory
	{
		return new class ($this) implements Infrastructure\Content\Component\Content\ContentControlFactory {
			private $container;


			public function __construct(Container_1633414162 $container)
			{
				$this->container = $container;
			}


			public function create(Domain\Content\Entity\ContentInterface $contentEntity): Infrastructure\Content\Component\Content\ContentControl
			{
				return new Infrastructure\Content\Component\Content\ContentControl(
					$contentEntity,
					$this->container->getService('content.service.contentService'),
					$this->container->getService('content.service.pluginService'),
				);
			}
		};
	}


	public function createServiceContent__component__contentBuilder(): Infrastructure\Content\Component\ContentBuilder\ContentBuilderControlFactory
	{
		return new class ($this) implements Infrastructure\Content\Component\ContentBuilder\ContentBuilderControlFactory {
			private $container;


			public function __construct(Container_1633414162 $container)
			{
				$this->container = $container;
			}


			public function create(Domain\Content\Entity\ContentInterface $entity): Infrastructure\Content\Component\ContentBuilder\ContentBuilderControl
			{
				return new Infrastructure\Content\Component\ContentBuilder\ContentBuilderControl(
					$entity,
					$this->container->getService('content.service.contentService'),
					$this->container->getService('content.component.listPlugin'),
				);
			}
		};
	}


	public function createServiceContent__component__listPlugin(): Infrastructure\Content\Component\ListPlugin\ListPluginControlFactory
	{
		return new class ($this) implements Infrastructure\Content\Component\ListPlugin\ListPluginControlFactory {
			private $container;


			public function __construct(Container_1633414162 $container)
			{
				$this->container = $container;
			}


			public function create(Domain\Content\Entity\ContentEntity $entity): Infrastructure\Content\Component\ListPlugin\ListPluginControl
			{
				return new Infrastructure\Content\Component\ListPlugin\ListPluginControl(
					$entity,
					$this->container->getService('content.service.pluginService'),
					$this->container->getService('content.component.addPlugin'),
					$this->container->getService('content.service.pluginFormFactory'),
				);
			}
		};
	}


	public function createServiceContent__plugin__component__pictureBlock__factory(): Infrastructure\Content\Plugin\Component\PictureBlock\PictureBlockPluginControlFactory
	{
		return new class ($this) implements Infrastructure\Content\Plugin\Component\PictureBlock\PictureBlockPluginControlFactory {
			private $container;


			public function __construct(Container_1633414162 $container)
			{
				$this->container = $container;
			}


			public function create(?Domain\Content\Entity\Plugin\PluginBlockEntityInterface $entity = null): Infrastructure\Content\Plugin\Component\PictureBlock\PictureBlockPluginControl
			{
				return new Infrastructure\Content\Plugin\Component\PictureBlock\PictureBlockPluginControl($entity);
			}
		};
	}


	public function createServiceContent__plugin__component__textBlock__factory(): Infrastructure\Content\Plugin\Component\TextBlock\TextBlockPluginControlFactory
	{
		return new class ($this) implements Infrastructure\Content\Plugin\Component\TextBlock\TextBlockPluginControlFactory {
			private $container;


			public function __construct(Container_1633414162 $container)
			{
				$this->container = $container;
			}


			public function create(?Domain\Content\Entity\Plugin\PluginBlockEntityInterface $entity = null): Infrastructure\Content\Plugin\Component\TextBlock\TextBlockPluginControl
			{
				return new Infrastructure\Content\Plugin\Component\TextBlock\TextBlockPluginControl($entity);
			}
		};
	}


	public function createServiceContent__service__contentService(): Domain\Content\Service\ContentService
	{
		return new Domain\Content\Service\ContentService($this->getService('database.manager.content.contentManager'));
	}


	public function createServiceContent__service__pluginFormFactory(): Infrastructure\Content\Service\PluginFormFactoryService
	{
		return new Infrastructure\Content\Service\PluginFormFactoryService;
	}


	public function createServiceContent__service__pluginService(): Infrastructure\Content\Service\PluginService
	{
		return new Infrastructure\Content\Service\PluginService($this->getService('database.manager.content.pluginManager'), $this);
	}


	public function createServiceDatabase__default__connection(): Nette\Database\Connection
	{
		$service = new Nette\Database\Connection('pgsql:host=postgresql-db;port=5432;dbname=postgres', 'postgres', 'diploma-thesis', []);
		Nette\Bridges\DatabaseTracy\ConnectionPanel::initialize(
			$service,
			true,
			'default',
			true,
			$this->getService('tracy.bar'),
			$this->getService('tracy.blueScreen'),
		);
		return $service;
	}


	public function createServiceDatabase__default__conventions(): Nette\Database\Conventions\DiscoveredConventions
	{
		return new Nette\Database\Conventions\DiscoveredConventions($this->getService('database.default.structure'));
	}


	public function createServiceDatabase__default__explorer(): Nette\Database\Explorer
	{
		return new Nette\Database\Explorer(
			$this->getService('database.default.connection'),
			$this->getService('database.default.structure'),
			$this->getService('database.default.conventions'),
			$this->getService('cache.storage'),
		);
	}


	public function createServiceDatabase__default__structure(): Nette\Database\Structure
	{
		return new Nette\Database\Structure($this->getService('database.default.connection'), $this->getService('cache.storage'));
	}


	public function createServiceDatabase__manager__content__contentManager(): Infrastructure\Database\Manager\ContentManager
	{
		return new Infrastructure\Database\Manager\ContentManager($this->getService('database.default.explorer'));
	}


	public function createServiceDatabase__manager__content__plugin__pictureBlock(): Infrastructure\Database\Manager\PluginPictureBlockManager
	{
		return new Infrastructure\Database\Manager\PluginPictureBlockManager($this->getService('database.default.explorer'));
	}


	public function createServiceDatabase__manager__content__plugin__textBlock(): Infrastructure\Database\Manager\PluginTextBlockManager
	{
		return new Infrastructure\Database\Manager\PluginTextBlockManager($this->getService('database.default.explorer'));
	}


	public function createServiceDatabase__manager__content__pluginManager(): Infrastructure\Database\Manager\PluginManager
	{
		return new Infrastructure\Database\Manager\PluginManager(
			$this->getService('database.default.explorer'),
			$this->getService('database.manager.content.contentManager'),
		);
	}


	public function createServiceDatabase__manager__label__labelBridgeManager(): Infrastructure\Database\Manager\LabelBridgeManager
	{
		return new Infrastructure\Database\Manager\LabelBridgeManager($this->getService('database.default.explorer'));
	}


	public function createServiceDatabase__manager__label__labelManager(): Infrastructure\Database\Manager\LabelManager
	{
		return new Infrastructure\Database\Manager\LabelManager($this->getService('database.default.explorer'));
	}


	public function createServiceDatabase__manager__label__labelStackManager(): Infrastructure\Database\Manager\LabelStackManager
	{
		return new Infrastructure\Database\Manager\LabelStackManager(
			$this->getService('database.default.explorer'),
			$this->getService('database.manager.label.labelBridgeManager'),
			$this->getService('database.manager.label.labelManager'),
		);
	}


	public function createServiceDatabase__manager__library__libraryManager(): Infrastructure\Database\Manager\LibraryManager
	{
		return new Infrastructure\Database\Manager\LibraryManager(
			$this->getService('database.manager.user.usersManager'),
			$this->getService('database.default.explorer'),
		);
	}


	public function createServiceDatabase__manager__user__userTypeManager(): Infrastructure\Database\Manager\UserTypeManager
	{
		return new Infrastructure\Database\Manager\UserTypeManager($this->getService('database.default.explorer'));
	}


	public function createServiceDatabase__manager__user__usersManager(): Infrastructure\Database\Manager\UsersManager
	{
		return new Infrastructure\Database\Manager\UsersManager(
			$this->getService('database.manager.user.userTypeManager'),
			$this->getService('database.default.explorer'),
		);
	}


	public function createServiceDatabase__service__database(): Infrastructure\Database\Service\Database
	{
		return new Infrastructure\Database\Service\Database($this->getService('database.manager.user.userTypeManager'));
	}


	public function createServiceHttp__request(): Nette\Http\Request
	{
		return $this->getService('http.requestFactory')->fromGlobals();
	}


	public function createServiceHttp__requestFactory(): Nette\Http\RequestFactory
	{
		$service = new Nette\Http\RequestFactory;
		$service->setProxy([]);
		return $service;
	}


	public function createServiceHttp__response(): Nette\Http\Response
	{
		$service = new Nette\Http\Response;
		$service->cookieSecure = $this->getService('http.request')->isSecured();
		return $service;
	}


	public function createServiceLabel__service__labelService(): Domain\Label\Service\LabelService
	{
		return new Domain\Label\Service\LabelService(
			$this->getService('database.manager.label.labelManager'),
			$this->getService('database.manager.label.labelBridgeManager'),
			$this->getService('database.manager.label.labelStackManager'),
		);
	}


	public function createServiceLatte__latteFactory(): Nette\Bridges\ApplicationLatte\LatteFactory
	{
		return new class ($this) implements Nette\Bridges\ApplicationLatte\LatteFactory {
			private $container;


			public function __construct(Container_1633414162 $container)
			{
				$this->container = $container;
			}


			public function create(): Latte\Engine
			{
				$service = new Latte\Engine;
				$service->setTempDirectory('/var/www/temp/cache/latte');
				$service->setAutoRefresh(true);
				$service->setContentType('html');
				Nette\Utils\Html::$xhtml = false;
				return $service;
			}
		};
	}


	public function createServiceLatte__templateFactory(): Nette\Bridges\ApplicationLatte\TemplateFactory
	{
		$service = new Nette\Bridges\ApplicationLatte\TemplateFactory(
			$this->getService('latte.latteFactory'),
			$this->getService('http.request'),
			$this->getService('security.user'),
			$this->getService('cache.storage'),
			null,
		);
		Nette\Bridges\ApplicationDI\LatteExtension::initLattePanel($service, $this->getService('tracy.bar'), false);
		return $service;
	}


	public function createServiceLibrary__component__articleControl(): Infrastructure\Library\Component\Article\ArticleControlFactory
	{
		return new class ($this) implements Infrastructure\Library\Component\Article\ArticleControlFactory {
			private $container;


			public function __construct(Container_1633414162 $container)
			{
				$this->container = $container;
			}


			public function create(Domain\Library\Entity\LibraryEntity $libraryEntity): Infrastructure\Library\Component\Article\ArticleControl
			{
				return new Infrastructure\Library\Component\Article\ArticleControl(
					$libraryEntity,
					$this->container->getService('database.manager.label.labelStackManager'),
				);
			}
		};
	}


	public function createServiceLibrary__component__listControl(): Infrastructure\Library\Component\List\ListControlFactory
	{
		return new class ($this) implements Infrastructure\Library\Component\List\ListControlFactory {
			private $container;


			public function __construct(Container_1633414162 $container)
			{
				$this->container = $container;
			}


			public function create(): Infrastructure\Library\Component\List\ListControl
			{
				return new Infrastructure\Library\Component\List\ListControl(
					$this->container->getService('database.manager.label.labelManager'),
					$this->container->getService('database.manager.library.libraryManager'),
					$this->container->getService('library.component.articleControl'),
				);
			}
		};
	}


	public function createServiceMail__mailer(): Nette\Mail\Mailer
	{
		return new Nette\Mail\SendmailMailer;
	}


	public function createServiceRouter(): Nette\Application\Routers\RouteList
	{
		return $this->getService('router.factory')->createRouter([
			$this->getService('router.service.homepage'),
			$this->getService('router.service.course'),
			$this->getService('router.service.library'),
			$this->getService('router.service.discussion'),
		]);
	}


	public function createServiceRouter__factory(): Infrastructure\Router\RouterFactory
	{
		return new Infrastructure\Router\RouterFactory;
	}


	public function createServiceRouter__service__course(): Infrastructure\Router\CourseRouter
	{
		return new Infrastructure\Router\CourseRouter;
	}


	public function createServiceRouter__service__discussion(): Infrastructure\Router\DiscussionRouter
	{
		return new Infrastructure\Router\DiscussionRouter;
	}


	public function createServiceRouter__service__homepage(): Infrastructure\Router\HomepageRouter
	{
		return new Infrastructure\Router\HomepageRouter;
	}


	public function createServiceRouter__service__library(): Infrastructure\Router\LibraryRouter
	{
		return new Infrastructure\Router\LibraryRouter;
	}


	public function createServiceSecurity__legacyUserStorage(): Nette\Security\IUserStorage
	{
		return new Nette\Http\UserStorage($this->getService('session.session'));
	}


	public function createServiceSecurity__passwords(): Nette\Security\Passwords
	{
		return new Nette\Security\Passwords;
	}


	public function createServiceSecurity__user(): Infrastructure\User\Entity\User
	{
		$service = new Infrastructure\User\Entity\User(
			$this->getService('security.legacyUserStorage'),
			$this->getService('user.service.authenticator'),
		);
		$this->getService('tracy.bar')->addPanel(new Nette\Bridges\SecurityTracy\UserPanel($service));
		return $service;
	}


	public function createServiceSecurity__userStorage(): Nette\Security\UserStorage
	{
		return new Nette\Bridges\SecurityHttp\SessionStorage($this->getService('session.session'));
	}


	public function createServiceSession__session(): Nette\Http\Session
	{
		$service = new Nette\Http\Session($this->getService('http.request'), $this->getService('http.response'));
		$service->setExpiration('14 days');
		$service->setOptions(['readAndClose' => null, 'cookieSamesite' => 'Lax']);
		return $service;
	}


	public function createServiceTracy__bar(): Tracy\Bar
	{
		return Tracy\Debugger::getBar();
	}


	public function createServiceTracy__blueScreen(): Tracy\BlueScreen
	{
		return Tracy\Debugger::getBlueScreen();
	}


	public function createServiceTracy__logger(): Tracy\ILogger
	{
		return Tracy\Debugger::getLogger();
	}


	public function createServiceUser__service__authenticator(): Infrastructure\User\Service\AuthenticatorService
	{
		return new Infrastructure\User\Service\AuthenticatorService($this->getService('database.manager.user.usersManager'));
	}


	public function initialize()
	{
		// di.
		(function () {
			$this->getService('tracy.bar')->addPanel(new Nette\Bridges\DITracy\ContainerPanel($this));
		})();
		// http.
		(function () {
			$response = $this->getService('http.response');
			$response->setHeader('X-Powered-By', 'Nette Framework 3');
			$response->setHeader('Content-Type', 'text/html; charset=utf-8');
			$response->setHeader('X-Frame-Options', 'SAMEORIGIN');
			Nette\Http\Helpers::initCookie($this->getService('http.request'), $response);
		})();
		// session.
		(function () {
			$this->getService('session.session')->autoStart(false);
		})();
		// tracy.
		(function () {
			if (!Tracy\Debugger::isEnabled()) { return; }
			Tracy\Debugger::getLogger()->mailer = [
				new Tracy\Bridges\Nette\MailSender($this->getService('mail.mailer'), null),
				'send',
			];
		})();
	}
}
