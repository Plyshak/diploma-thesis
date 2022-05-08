<?php

use Latte\Runtime as LR;

/** source: /var/www/app/Infrastructure/Content/Component/Content/template/ContentControl.latte */
final class Template58b02d6e8a extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		['content' => 'blockContent'],
	];


	public function main(): array
	{
		extract($this->params);
		echo "\n";
		if ($this->getParentName()) {
			return get_defined_vars();
		}
		$this->renderBlock('content', get_defined_vars()) /* line 3 */;
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			foreach (array_intersect_key(['i' => '6', 'plugin' => '6'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	/** {block content} on line 3 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <div class="content list">
        <div class="plugin-list">
';
		$iterations = 0;
		foreach ($plugins as $i => $plugin) /* line 6 */ {
			echo '                <div class="single-plugin">
                    <div class="plugin">
';
			/* line 9 */ $_tmp = $this->global->uiControl->getComponent("plugin-$i");
			if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
			$_tmp->render();
			echo '                    </div>
                </div>
';
			$iterations++;
		}
		echo '        </div>
    </div>
';
	}

}
