<?php

use Latte\Runtime as LR;

/** source: /var/www/app/Infrastructure/Content/Component/ContentBuilder/template/ContentBuilderControl.latte */
final class Template4780af299e extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		0 => ['contentBuilder' => 'blockContentBuilder', 'content' => 'blockContent', 'withContentBuilder' => 'blockWithContentBuilder', 'withoutContentBuilder' => 'blockWithoutContentBuilder', 'title' => 'blockTitle', 'description' => 'blockDescription', 'contentHeader' => 'blockContentHeader', 'contentBody' => 'blockContentBody'],
		'snippet' => ['contentBuilder' => 'blockContentBuilder1'],
	];


	public function main(): array
	{
		extract($this->params);
		echo "\n";
		if ($this->getParentName()) {
			return get_defined_vars();
		}
		$this->renderBlock('contentBuilder', get_defined_vars()) /* line 3 */;
		echo '









';
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	/** {block contentBuilder} on line 3 */
	public function blockContentBuilder(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <div class="content-builder"';
		echo ' id="' . htmlspecialchars($this->global->snippetDriver->getHtmlId('contentBuilder')) . '"';
		echo '>
';
		$this->renderBlock('contentBuilder', [], null, 'snippet');
		echo '    </div>
';
		
	}


	/** {define content} on line 9 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		$this->renderBlock('title', get_defined_vars(), 'html') /* line 10 */;
		echo "\n";
		if ($hasContentBuilder) /* line 12 */ {
			$this->renderBlock('withContentBuilder', get_defined_vars(), 'html') /* line 13 */;
		} else /* line 14 */ {
			$this->renderBlock('withoutContentBuilder', get_defined_vars(), 'html') /* line 15 */;
		}
		
	}


	/** {define withContentBuilder} on line 19 */
	public function blockWithContentBuilder(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <div class="content-builder-header">
';
		$this->renderBlock('contentHeader', get_defined_vars(), 'html') /* line 21 */;
		echo '    </div>
    <div class="content-builder-body">
';
		$this->renderBlock('contentBody', get_defined_vars(), 'html') /* line 24 */;
		echo '    </div>
';
	}


	/** {define withoutContentBuilder} on line 28 */
	public function blockWithoutContentBuilder(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <div class="no-content-builder">
        <a
            class="content-builder-create button"
         href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("createContentBuilder!")) /* line 30 */;
		echo '">
            Vytvořit dynamický obsah
        </a>
    </div>
';
	}


	/** {define title} on line 39 */
	public function blockTitle(array $ʟ_args): void
	{
		echo '    <h2 class="title">Dynamický obsah</h2>
';
	}


	/** {define description} on line 43 */
	public function blockDescription(array $ʟ_args): void
	{
		echo '    <div class="description">
        <p>
            Toto je šablonový systém dynamického obsahu.<br>
            Nový blok přidáte pomocí tlačítek s názvem bloku.
            Blok je možné vkládat kamkoliv do stávající struktury.<br>
            Každý blok je nutné po editaci uložit samostatně.
        </p>
    </div>
';
	}


	/** {define contentHeader} on line 54 */
	public function blockContentHeader(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		$this->renderBlock('description', get_defined_vars(), 'html') /* line 55 */;
		
	}


	/** {define contentBody} on line 58 */
	public function blockContentBody(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		/* line 59 */ $_tmp = $this->global->uiControl->getComponent("pluginList");
		if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
		
	}


	/** {snippet contentBuilder} on line 4 */
	public function blockContentBuilder1(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		$this->global->snippetDriver->enter("contentBuilder", 'static');
		try {
			echo '        ';
			$this->renderBlock('content', get_defined_vars(), 'html') /* line 5 */;
			echo "\n";
		} finally {
			$this->global->snippetDriver->leave();
		}
		
	}

}
