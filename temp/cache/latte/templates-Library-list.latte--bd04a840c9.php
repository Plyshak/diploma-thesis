<?php

use Latte\Runtime as LR;

/** source: /var/www/app/Infrastructure/View/templates/Library/list.latte */
final class Templatebd04a840c9 extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		0 => ['content' => 'blockContent'],
		'snippet' => ['libraryArticleList' => 'blockLibraryArticleList'],
	];


	public function main(): array
	{
		extract($this->params);
		echo "\n";
		if ($this->getParentName()) {
			return get_defined_vars();
		}
		$this->renderBlock('content', get_defined_vars()) /* line 4 */;
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	/** {block content} on line 4 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <div class="library">
        <div class="intro">
            <div class="left-column">
                <h1 class="title">
                    Články v knihovně
                    <span class="article-count"> - ';
		echo LR\Filters::escapeHtmlText($libraryArticleCount) /* line 10 */;
		echo ' ';
		echo LR\Filters::escapeHtmlText($libraryArticleCountText) /* line 10 */;
		echo '</span>
                </h1>
            </div>
            <div class="right-column">
';
		if ($user->isLoggedIn()) /* line 14 */ {
			echo '                <div class="add-article">
                    <a data-ajax="false" href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("addArticle!", [$user->getId()])) /* line 15 */;
			echo '">
                    <span class="button">
                        Přidat článek
                    </span>
                    </a>
                </div>
';
		}
		echo '            </div>
        </div>
        <div class="library-list"';
		echo ' id="' . htmlspecialchars($this->global->snippetDriver->getHtmlId('libraryArticleList')) . '"';
		echo '>
';
		$this->renderBlock('libraryArticleList', [], null, 'snippet');
		echo '        </div>
    </div>
';
	}


	/** {snippet libraryArticleList} on line 23 */
	public function blockLibraryArticleList(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		$this->global->snippetDriver->enter("libraryArticleList", 'static');
		try {
			echo '            ';
			/* line 24 */ $_tmp = $this->global->uiControl->getComponent("list");
			if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
			$_tmp->render();
			echo "\n";
		} finally {
			$this->global->snippetDriver->leave();
		}
		
	}

}
