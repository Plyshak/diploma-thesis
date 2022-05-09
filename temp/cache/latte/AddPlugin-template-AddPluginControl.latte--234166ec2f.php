<?php

use Latte\Runtime as LR;

/** source: /var/www/app/Infrastructure/Content/Component/AddPlugin/template/AddPluginControl.latte */
final class Template234166ec2f extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		0 => ['content' => 'blockContent', 'plugins' => 'blockPlugins', 'plugin' => 'blockPlugin'],
		'snippet' => ['' => 'block1'],
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
			foreach (array_intersect_key(['prefix' => '12', 'name' => '12'], $this->params) as $ʟ_v => $ʟ_l) {
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
		echo '    <div class="add-plugin-list"';
		echo ' id="' . htmlspecialchars($this->global->snippetDriver->getHtmlId('')) . '"';
		echo '>
';
		$this->renderBlock('', [], null, 'snippet');
		echo '    </div>
';
		
	}


	/** {define plugins} on line 10 */
	public function blockPlugins(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <div class="list">
';
		$iterations = 0;
		foreach ($iterator = $ʟ_it = new LR\CachingIterator($plugins, $ʟ_it ?? null) as $prefix => $name) /* line 12 */ {
			$this->renderBlock('plugin', ['prefix' => $prefix, 'name' => $name] + get_defined_vars(), 'html') /* line 13 */;
			$iterations++;
		}
		$iterator = $ʟ_it = $ʟ_it->getParent();
		echo '    </div>
';
		if ($addPluginFactory) /* line 16 */ {
			echo '    <div class="factory">
        ';
			/* line 17 */ $_tmp = $this->global->uiControl->getComponent("factory");
			if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
			$_tmp->render();
			echo '
    </div>
';
		}
		
	}


	/** {define plugin} on line 21 */
	public function blockPlugin(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <div class="add-plugin-item item">
        <a
            class="button"
         href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("addPlugin!", [$prefix])) /* line 23 */;
		echo '">
            ';
		echo LR\Filters::escapeHtmlText($name) /* line 27 */;
		echo '
        </a>
    </div>
';
	}


	/** {snippet } on line 5 */
	public function block1(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		$this->global->snippetDriver->enter("", 'static');
		try {
			echo '        ';
			$this->renderBlock('plugins', get_defined_vars(), 'html') /* line 6 */;
			echo "\n";
		} finally {
			$this->global->snippetDriver->leave();
		}
		
	}

}
