<?php

use Latte\Runtime as LR;

/** source: /var/www/app/Infrastructure/Content/Component/ListPlugin/template/ListPluginControl.latte */
final class Template1ed9fc24c2 extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		0 => ['content' => 'blockContent', 'twoCols' => 'blockTwoCols', 'oneCol' => 'blockOneCol', 'pluginList' => 'blockPluginList', 'pluginLiveList' => 'blockPluginLiveList', 'liveView' => 'blockLiveView'],
		'snippet' => ['pluginList' => 'blockPluginList1'],
	];


	public function main(): array
	{
		extract($this->params);
		echo "\n";
		if ($this->getParentName()) {
			return get_defined_vars();
		}
		$this->renderBlock('content', get_defined_vars()) /* line 4 */;
		echo '





';
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			foreach (array_intersect_key(['i' => '33', 'plugin' => '33, 58', 'key' => '58'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	/** {block content} on line 4 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <div class="content-builder-plugin-list list"';
		echo ' id="' . htmlspecialchars($this->global->snippetDriver->getHtmlId('pluginList')) . '"';
		echo '>
';
		$this->renderBlock('pluginList', [], null, 'snippet');
		echo '    </div>
';
		
	}


	/** {define twoCols} on line 18 */
	public function blockTwoCols(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <div class="left-column">
';
		$this->renderBlock('pluginList', get_defined_vars(), 'html') /* line 20 */;
		echo '    </div>
    <div class="right-column">
';
		$this->renderBlock('pluginLiveList', get_defined_vars(), 'html') /* line 23 */;
		echo '    </div>
';
	}


	/** {define oneCol} on line 27 */
	public function blockOneCol(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		$this->renderBlock('pluginList', get_defined_vars(), 'html') /* line 28 */;
		
	}


	/** {define pluginList} on line 31 */
	public function blockPluginList(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <div class="plugin-list">
';
		$iterations = 0;
		foreach ($iterator = $ʟ_it = new LR\CachingIterator($plugins, $ʟ_it ?? null) as $i => $plugin) /* line 33 */ {
			echo '            <div class="single-plugin">
';
			$count = $iterator->getCounter() /* line 35 */;
			echo '
                <div class="plugin">
                    <div class="delete">
                        <a
                                class="button"
                         href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("delete!", [$i])) /* line 39 */;
			echo '">
                            Smazat blok
                        </a>
                    </div>
                    <div class="plugin-edit-form">
';
			/* line 47 */ $_tmp = $this->global->uiControl->getComponent("plugin-{$i}");
			if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
			$_tmp->render();
			echo '                    </div>
                </div>
            </div>
';
			/* line 51 */ $_tmp = $this->global->uiControl->getComponent("addPlugin-{$count}");
			if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
			$_tmp->render();
			$iterations++;
		}
		$iterator = $ʟ_it = $ʟ_it->getParent();
		echo '    </div>
';
	}


	/** {define pluginLiveList} on line 56 */
	public function blockPluginLiveList(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <div class="plugin-live-list">
';
		$iterations = 0;
		foreach ($plugins as $key => $plugin) /* line 58 */ {
			/* line 59 */ $_tmp = $this->global->uiControl->getComponent("livePlugin-{$key}");
			if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
			$_tmp->render();
			$iterations++;
		}
		echo '    </div>
';
	}


	/** {define liveView} on line 64 */
	public function blockLiveView(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <div class="plugin-life-view">
        <a class="popup-button" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("liveView!", [!$live])) /* line 66 */;
		echo '">
';
		if ($live) /* line 67 */ {
			echo '                Vypnout režim živého náhledu
';
		} else /* line 69 */ {
			echo '                Zapnout režim živého náhledu
';
		}
		echo '        </a>
    </div>
';
	}


	/** {snippet pluginList} on line 5 */
	public function blockPluginList1(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		$this->global->snippetDriver->enter("pluginList", 'static');
		try {
			echo '        ';
			/* line 6 */ $_tmp = $this->global->uiControl->getComponent("addPlugin-0");
			if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
			$_tmp->render();
			echo '

';
			if ($live) /* line 8 */ {
				$this->renderBlock('twoCols', get_defined_vars(), 'html') /* line 9 */;
			} else /* line 10 */ {
				$this->renderBlock('oneCol', get_defined_vars(), 'html') /* line 11 */;
			}
			echo "\n";
			$this->renderBlock('liveView', get_defined_vars(), 'html') /* line 14 */;
		} finally {
			$this->global->snippetDriver->leave();
		}
		
	}

}
