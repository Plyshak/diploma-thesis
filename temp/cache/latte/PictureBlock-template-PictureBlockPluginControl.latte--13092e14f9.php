<?php

use Latte\Runtime as LR;

/** source: /var/www/app/Infrastructure/Content/Plugin/Component/PictureBlock/template/PictureBlockPluginControl.latte */
final class Template13092e14f9 extends Latte\Runtime\Template
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
			echo '        <div class="title">';
			echo LR\Filters::escapeHtmlText($entity->getTitle()) /* line 13 */;
			echo '</div>
';
		}
		echo '    </div>
';
	}


	/** {define body} on line 17 */
	public function blockBody(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <div class="plugin-body">
        <div class="body align-';
		echo LR\Filters::escapeHtmlAttr($entity->getPictureAlign()) /* line 19 */;
		echo '">
            <div class="picture width-';
		echo LR\Filters::escapeHtmlAttr($entity->getPictureWidth()) /* line 20 */;
		echo '">
                 <img
                    class="image"
                    src="http://localhost/';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($entity->getImage() ?? 'images/no-image.jpg')) /* line 23 */;
		echo '"
                    alt="';
		echo LR\Filters::escapeHtmlAttr($entity->getPictureDescription()) /* line 24 */;
		echo '"
                >
            </div>
';
		if ($entity->isPictureShowDescription()) /* line 27 */ {
			echo '            <div class="picture-description">
                ';
			echo LR\Filters::escapeHtmlText($entity->getPictureDescription()) /* line 28 */;
			echo '
            </div>
';
		}
		echo '        </div>
    </div>
';
	}


	/** {define footer} on line 34 */
	public function blockFooter(array $ʟ_args): void
	{
		echo '    <div class="plugin-footer">
    </div>
';
	}

}
