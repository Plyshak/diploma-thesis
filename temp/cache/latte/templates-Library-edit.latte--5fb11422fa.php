<?php

use Latte\Runtime as LR;

/** source: /var/www/app/Infrastructure/View/templates/Library/edit.latte */
final class Template5fb11422fa extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		0 => ['content' => 'blockContent', 'withPermission' => 'blockWithPermission', 'withoutPermission' => 'blockWithoutPermission'],
		'snippet' => ['editLibraryArticle' => 'blockEditLibraryArticle'],
	];


	public function main(): array
	{
		extract($this->params);
		echo "\n";
		if ($this->getParentName()) {
			return get_defined_vars();
		}
		$this->renderBlock('content', get_defined_vars()) /* line 3 */;
		echo '


';
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	/** {block content} on line 3 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <div class="right-button-container">
        <div>
            <a class="button" data-type="secondary" data-ajax="false" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Library:list")) /* line 6 */;
		echo '">Zpět na výpis</a>
        </div>
        <div>
            <a class="button" data-type="secondary" data-ajax="false" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Library:view", [$libraryEntity->getId()])) /* line 10 */;
		echo '">Zobrazit článek</a>
        </div>
    </div>
    <div';
		echo ' id="' . htmlspecialchars($this->global->snippetDriver->getHtmlId('editLibraryArticle')) . '"';
		echo '>
';
		$this->renderBlock('editLibraryArticle', [], null, 'snippet');
		echo '    </div>
';
		
	}


	/** {define withPermission} on line 23 */
	public function blockWithPermission(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <div class="edit-article">
        <div class="intro">
            <h1 class="title">
                Upravit článek
                <span class="article-name"> - "';
		echo LR\Filters::escapeHtmlText($libraryEntity->getTitle()) /* line 28 */;
		echo '"</span>
            </h1>
';
		if (!empty($libraryEntity->getImage())) /* line 30 */ {
			echo '            <div class="image">
                <img
                    class="article-image"
                    src="http://localhost/';
			echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($libraryEntity->getImage())) /* line 33 */;
			echo '"
                    alt="';
			echo LR\Filters::escapeHtmlAttr($libraryEntity->getTitle()) /* line 34 */;
			echo '"
               >
            </div>
';
		}
		echo '        </div>
        <div class="information">
';
		/* line 39 */ $_tmp = $this->global->uiControl->getComponent("editArticleForm");
		if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
		echo '        </div>
        <div class="labels">
';
		/* line 42 */ $_tmp = $this->global->uiControl->getComponent("editArticleLabelsForm");
		if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
		echo '        </div>
        <div class="add-label">
';
		/* line 45 */ $_tmp = $this->global->uiControl->getComponent("addArticleLabelForm");
		if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
		echo '        </div>
        <div class="content">
';
		/* line 48 */ $_tmp = $this->global->uiControl->getComponent("editContent");
		if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
		echo '        </div>
    </div>
';
	}


	/** {define withoutPermission} on line 53 */
	public function blockWithoutPermission(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <div class="no-permission">
        Nemáte oprávnění upravovat článek - "';
		echo LR\Filters::escapeHtmlText($libraryEntity->getTitle()) /* line 55 */;
		echo '"!
    </div>
';
	}


	/** {snippet editLibraryArticle} on line 14 */
	public function blockEditLibraryArticle(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		$this->global->snippetDriver->enter("editLibraryArticle", 'static');
		try {
			echo '        ';
			if ($libraryEntity->getAuthor()->getId() === $user->getId()) /* line 15 */ {
				echo "\n";
				$this->renderBlock('withPermission', get_defined_vars(), 'html') /* line 16 */;
			} else /* line 17 */ {
				$this->renderBlock('withoutPermission', get_defined_vars(), 'html') /* line 18 */;
			}
		} finally {
			$this->global->snippetDriver->leave();
		}
		
	}

}
