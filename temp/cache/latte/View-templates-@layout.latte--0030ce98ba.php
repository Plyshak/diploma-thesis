<?php

use Latte\Runtime as LR;

/** source: /var/www/app/Infrastructure/View/templates/@layout.latte */
final class Template0030ce98ba extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		0 => ['scripts' => 'blockScripts'],
		'snippet' => ['page' => 'blockPage', 'flashMessageContainer' => 'blockFlashMessageContainer'],
	];


	public function main(): array
	{
		extract($this->params);
		echo '
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="author" content="Tomáš Zábranský">
	<title>';
		if ($this->hasBlock("title")) /* line 10 */ {
			$this->renderBlock('title', [], function ($s, $type) {
				$ʟ_fi = new LR\FilterInfo($type);
				return LR\Filters::convertTo($ʟ_fi, 'html', $this->filters->filterContent('striphtml', $ʟ_fi, $s));
			}) /* line 10 */;
			echo ' | ';
		}
		echo 'Nette Web</title>

';
		$iterations = 0;
		foreach ($cssFiles as $cssFile) /* line 12 */ {
			echo '	<link rel="stylesheet" href="';
			echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($cssFile)) /* line 12 */;
			echo '">
';
			$iterations++;
		}
		echo '	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
';
		$iterations = 0;
		foreach ($jsFiles as $jsFile) /* line 14 */ {
			echo '	<script rel="application/javascript" src="';
			echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($jsFile)) /* line 14 */;
			echo '" async defer></script>
';
			$iterations++;
		}
		echo '</head>

<body>
';
		$this->renderBlock('page', [], null, 'snippet') /* line 18 */;
		echo '</body>
</html>
';
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			foreach (array_intersect_key(['cssFile' => '12', 'jsFile' => '14', 'flash' => '20'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	/** {block scripts} on line 35 */
	public function blockScripts(array $ʟ_args): void
	{
		echo '			<script src="https://nette.github.io/resources/js/3/netteForms.min.js"></script>
';
	}


	/** {snippetArea page} on line 18 */
	public function blockPage(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		$this->global->snippetDriver->enter('page', 'area');
		try {
			echo '	<div>
		<div class="flashMessageContainer"';
			echo ' id="' . htmlspecialchars($this->global->snippetDriver->getHtmlId('flashMessageContainer')) . '"';
			echo '>
';
			$this->renderBlock('flashMessageContainer', [], null, 'snippet');
			echo '		</div>

';
			/* line 27 */ $_tmp = $this->global->uiControl->getComponent("header");
			if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
			$_tmp->render();
			echo '
		<div id="page" class="page">
';
			$this->renderBlock('content', [], 'html') /* line 30 */;
			echo '		</div>

';
			/* line 33 */ $_tmp = $this->global->uiControl->getComponent("footer");
			if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
			$_tmp->render();
			echo "\n";
			$this->renderBlock('scripts', get_defined_vars()) /* line 35 */;
			echo '
	</div>
';
		} finally {
			$this->global->snippetDriver->leave();
		}
		
	}


	/** {snippet flashMessageContainer} on line 19 */
	public function blockFlashMessageContainer(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		$this->global->snippetDriver->enter("flashMessageContainer", 'static');
		try {
			$iterations = 0;
			foreach ($flashes as $flash) /* line 20 */ {
				echo '			<div';
				echo ($ʟ_tmp = array_filter(['flash', $flash->type])) ? ' class="' . LR\Filters::escapeHtmlAttr(implode(" ", array_unique($ʟ_tmp))) . '"' : "" /* line 20 */;
				echo '>
				<div class="message">
					';
				echo LR\Filters::escapeHtmlText($flash->message) /* line 22 */;
				echo '
				</div>
			</div>
';
				$iterations++;
			}
		} finally {
			$this->global->snippetDriver->leave();
		}
		
	}

}
