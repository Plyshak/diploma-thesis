<?php

use Latte\Runtime as LR;

/** source: /var/www/app/Infrastructure/Content/Plugin/Component/TextBlock/template/TextBlockPluginControl.latte */
final class Templateef65ce2dfa extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		['content' => 'blockContent', 'header' => 'blockHeader', 'body' => 'blockBody', 'footer' => 'blockFooter'],
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
		echo '    <div class="plugin-text-block plugin-item">
';
		$this->renderBlock('header', get_defined_vars(), 'html') /* line 5 */;
		$this->renderBlock('body', get_defined_vars(), 'html') /* line 6 */;
		$this->renderBlock('footer', get_defined_vars(), 'html') /* line 7 */;
		echo '    </div>
';
	}


	/** {define header} on line 11 */
	public function blockHeader(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <div class="plugin-header">
';
		if ($entity->isShowTitle()) /* line 13 */ {
			echo '        <div class="subtitle">';
			echo LR\Filters::escapeHtmlText($entity->getTitle()) /* line 13 */;
			echo '</div>
';
		}
		if ($entity->getPerex()) /* line 14 */ {
			echo '        <div class="description">';
			echo LR\Filters::escapeHtmlText($entity->getPerex()) /* line 14 */;
			echo '</div>
';
		}
		echo '    </div>
';
	}


	/** {define body} on line 18 */
	public function blockBody(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <div class="plugin-body">
        <div class="body">
            ';
		echo $entity->getBody() /* line 21 */;
		echo '
        </div>
    </div>
';
	}


	/** {define footer} on line 26 */
	public function blockFooter(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <div class="plugin-footer">
';
		if ($entity->isButtonShow()) /* line 28 */ {
			echo '        <div>
            <a class="button"
               href="';
			echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($entity->getButtonUrl())) /* line 30 */;
			echo '"
               ';
			if ($entity->isButtonBlank()) /* line 31 */ {
				echo 'target="_blank"';
			}
			echo '
            >';
			echo LR\Filters::escapeHtmlText($entity->getButtonTitle()) /* line 32 */;
			echo '</a>
        </div>
';
		}
		echo '    </div>
';
	}

}
