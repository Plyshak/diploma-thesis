<?php

use Latte\Runtime as LR;

/** source: /var/www/app/Infrastructure/Library/Component/List/template/ListControl.latte */
final class Templateba9dee4e8b extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		['listControl' => 'blockListControl'],
	];


	public function main(): array
	{
		extract($this->params);
		echo "\n";
		if ($this->getParentName()) {
			return get_defined_vars();
		}
		$this->renderBlock('listControl', get_defined_vars()) /* line 3 */;
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			foreach (array_intersect_key(['article' => '10'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	/** {block listControl} on line 3 */
	public function blockListControl(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <div class="list">
        <div class="filter">
';
		/* line 6 */ $_tmp = $this->global->uiControl->getComponent("filterForm");
		if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
		echo '        </div>

        <div class="library-article-list">
';
		$iterations = 0;
		foreach ($iterator = $ʟ_it = new LR\CachingIterator($articleList, $ʟ_it ?? null) as $article) /* line 10 */ {
			$id = $article->getId() /* line 11 */;
			/* line 12 */ $_tmp = $this->global->uiControl->getComponent("article-$id");
			if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
			$_tmp->render();
			echo '                ';
			if (!$iterator->isLast()) /* line 13 */ {
				echo '<div class="library-article-list-separator"></div>';
			}
			echo "\n";
			$iterations++;
		}
		$iterator = $ʟ_it = $ʟ_it->getParent();
		echo '        </div>
    </div>
';
	}

}
