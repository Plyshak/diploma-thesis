<?php

use Latte\Runtime as LR;

/** source: /var/www/app/Infrastructure/Component/Footer/template/FooterControl.latte */
final class Template732729b633 extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		['footer' => 'blockFooter'],
	];


	public function main(): array
	{
		extract($this->params);
		if ($this->getParentName()) {
			return get_defined_vars();
		}
		$this->renderBlock('footer', get_defined_vars()) /* line 1 */;
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	/** {block footer} on line 1 */
	public function blockFooter(array $ʟ_args): void
	{
		echo '    <footer id="footer" class="footer">
        <p>
            Diplomová práce - XXX<br>
            <span>Tomáš Zábranský</span>
        </p>
    </footer>
';
	}

}
