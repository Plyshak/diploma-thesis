<?php

use Latte\Runtime as LR;

/** source: /var/www/app/Infrastructure/View/templates/Library/view.latte */
final class Template9184c6fc28 extends Latte\Runtime\Template
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
		$this->renderBlock('content', get_defined_vars()) /* line 4 */;
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			foreach (array_intersect_key(['label' => '18'], $this->params) as $ʟ_v => $ʟ_l) {
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
		echo '    <div class="article">
        <div class="intro">
            <div class="left-column">
                <div>
                    <div class="headline">
                        <h1 class="title">
                            ';
		echo LR\Filters::escapeHtmlText($libraryEntity->getTitle()) /* line 11 */;
		echo '
                            <span class="created">
                                (';
		echo LR\Filters::escapeHtmlText(($this->filters->date)($libraryEntity->getCreatedAt(), 'd. m. Y')) /* line 13 */;
		echo ')
                            </span>
                        </h1>
                    </div>
                    <div class="labels">
';
		$iterations = 0;
		foreach ($labels as $label) /* line 18 */ {
			echo '                            <span class="label">';
			echo LR\Filters::escapeHtmlText($label->getTitle()) /* line 19 */;
			echo '</span>
';
			$iterations++;
		}
		echo '                    </div>
                    <div class="image">
                        <img
                            class="fullwidth"
                            src="http://localhost/';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($libraryEntity->getImage())) /* line 25 */;
		echo '"
                            alt="';
		echo LR\Filters::escapeHtmlAttr($libraryEntity->getTitle()) /* line 26 */;
		echo '"
                       >
                    </div>
                </div>
            </div>
            <div class="right-column">
                <div class="author">
                    <div class="image">
                        <img
                            class="profilePicture"
                            src="http://localhost/images/userProfile.png"
                            alt="';
		echo LR\Filters::escapeHtmlAttr($libraryEntity->getAuthor()->getName()) /* line 37 */;
		echo '"
                       >
                    </div>
                    <div class="information">
                        <span class="name">
                            ';
		echo LR\Filters::escapeHtmlText($libraryEntity->getAuthor()->getName()) /* line 42 */;
		echo '
                        </span>
                        <span class="type">
                            ';
		echo LR\Filters::escapeHtmlText($libraryEntity->getAuthor()->getType()->getName()) /* line 45 */;
		echo '
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
';
		/* line 52 */ $_tmp = $this->global->uiControl->getComponent("articleContent");
		if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
		echo '        </div>
    </div>
';
	}

}
