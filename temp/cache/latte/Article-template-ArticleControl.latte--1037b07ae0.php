<?php

use Latte\Runtime as LR;

/** source: /var/www/app/Infrastructure/Library/Component/Article/template/ArticleControl.latte */
final class Template1037b07ae0 extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		['articleControl' => 'blockArticleControl'],
	];


	public function main(): array
	{
		extract($this->params);
		echo "\n";
		if ($this->getParentName()) {
			return get_defined_vars();
		}
		$this->renderBlock('articleControl', get_defined_vars()) /* line 5 */;
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			foreach (array_intersect_key(['label' => '35'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	/** {block articleControl} on line 5 */
	public function blockArticleControl(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <div class="library-article">
        <div class="image">
            <img
';
		if ($libraryEntity->getImage()) /* line 9 */ {
			echo '                    src="http://localhost/';
			echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($libraryEntity->getImage())) /* line 10 */;
			echo '"
';
		} else /* line 11 */ {
			echo '                        src="http://localhost/images/no-image.jpeg"
';
		}
		echo '                alt="';
		echo LR\Filters::escapeHtmlAttr($libraryEntity->getTitle()) /* line 14 */;
		echo '"
           >
        </div>
        <div class="content">
            <div class="title">
                ';
		echo LR\Filters::escapeHtmlText($libraryEntity->getTitle()) /* line 19 */;
		echo '
                <span class="created">
                    (';
		echo LR\Filters::escapeHtmlText(($this->filters->date)($libraryEntity->getCreatedAt(), 'd. m. Y')) /* line 21 */;
		echo ')
                </span>
            </div>
            <div class="edit-link">
';
		if ($user->isLoggedIn() && $user->getId() === $libraryEntity->getAuthor()->getId()) /* line 25 */ {
			echo '                <a class="button"
                    href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Library:edit", [$libraryEntity->getId()])) /* line 26 */;
			echo '"
                    data-ajax="false"
                >EDITOVAT</a>
';
		}
		echo '            </div>
            <div class="perex">
                ';
		echo LR\Filters::escapeHtmlText($libraryEntity->getPerex()) /* line 32 */;
		echo '
            </div>
            <div class="labels">
';
		$iterations = 0;
		foreach ($labels as $label) /* line 35 */ {
			echo '                    <span class="label">';
			echo LR\Filters::escapeHtmlText($label->getTitle()) /* line 36 */;
			echo '</span>
';
			$iterations++;
		}
		echo '            </div>
            <div class="view-link">
                <a class="button"
                    href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Library:view", [$libraryEntity->getId()])) /* line 41 */;
		echo '"
                    data-ajax="false"
                >ČÍST VÍCE</a>
            </div>
        </div>
    </div>
';
	}

}
