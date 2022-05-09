<?php

use Latte\Runtime as LR;

/** source: /var/www/app/Infrastructure/Component/Header/template/HeaderControl.latte */
final class Template500cef03be extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		['header' => 'blockHeader', 'logo' => 'blockLogo', 'menu' => 'blockMenu', 'userProfile' => 'blockUserProfile'],
	];


	public function main(): array
	{
		extract($this->params);
		echo "\n";
		if ($this->getParentName()) {
			return get_defined_vars();
		}
		$this->renderBlock('header', get_defined_vars()) /* line 4 */;
		echo '



';
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			foreach (array_intersect_key(['menuItem' => '25'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	/** {block header} on line 4 */
	public function blockHeader(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <header id="header" class="header">
        <div class="headerContainer">
';
		$this->renderBlock('userProfile', get_defined_vars(), 'html') /* line 7 */;
		$this->renderBlock('menu', get_defined_vars(), 'html') /* line 8 */;
		$this->renderBlock('logo', get_defined_vars(), 'html') /* line 9 */;
		echo '        </div>
    </header>
';
	}


	/** {define logo} on line 14 */
	public function blockLogo(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <div class="logo">
        <a href="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($homepageLink)) /* line 16 */;
		echo '" >
            <img class="logo" src="http://localhost/images/logo.png" alt="Czechitas logo">
        </a>
    </div>
';
	}


	/** {define menu} on line 22 */
	public function blockMenu(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <div id="menu" class="menu">
        <div class="menuContainer">
';
		$iterations = 0;
		foreach ($menu as $menuItem) /* line 25 */ {
			echo '                <div class="menuItem">
                    <a
                        href="';
			echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($menuItem->getLink())) /* line 28 */;
			echo '"
                        class="menuLink ';
			echo LR\Filters::escapeHtmlAttr($menuItem->isActive() ? 'active' : '') /* line 29 */;
			echo '"
                        data-ajax="false"
                    >
                        ';
			echo LR\Filters::escapeHtmlText(($this->filters->upper)($menuItem->getTitle())) /* line 32 */;
			echo '
                    </a>
                </div>
';
			$iterations++;
		}
		echo '        </div>
    </div>
';
	}


	/** {define userProfile} on line 40 */
	public function blockUserProfile(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <div id="userProfile" class="userProfile">
';
		/* line 42 */ $_tmp = $this->global->uiControl->getComponent("login");
		if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
		echo '    </div>
';
	}

}
