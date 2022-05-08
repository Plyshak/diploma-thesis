<?php

use Latte\Runtime as LR;

/** source: /var/www/app/Infrastructure/View/templates/Homepage/default.latte */
final class Template12f37bb74f extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		['content' => 'blockContent'],
	];


	public function main(): array
	{
		extract($this->params);
		if ($this->getParentName()) {
			return get_defined_vars();
		}
		$this->renderBlock('content', get_defined_vars()) /* line 1 */;
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		echo '    <div>
        <h1>Vítejte!</h1>
        <p>
            Tato platforma je součástí diplomové práce XXX Bc. Tomáše Zábranského
            a byla vytvořena ve spolupráci a pro potřeby neziskové organizace Czechitas.
            Na této platformě najdete celkem tři moduly:
        </p>
        <ul>
            <li>Kurzy</li>
            <li>Diskuzi</li>
            <li>Knihovnu</li>
        </ul>
        <h2>Kurzy</h2>
        <p>
            Slouží k zobrazení kurzů, které jsou dostupné na platformě.
            Některé kurzy jsou dostupné jen pro přihlášené uživatele - více později.
        </p>
        <h2>Diskuze</h2>
        <p>
            Slouží k zobrazení příspěvků týkajících se kurzu nebo žádostí o radu.
            Zobrazit diskuzní vlákno si může kdokoliv, ale přispívat může pouze přihlášený uživatel.
        </p>
        <h2>Knihovna</h2>
        <p>
            Slouží k zobrazení zajímavých událostí popřípadě věcí, které je dobré sledovat.
            Sledovat a prohlížet může kdokoliv. Vztvářet nový příspěvek může pouze přihlášený uživatel.
        </p>
    </div>
';
	}

}
