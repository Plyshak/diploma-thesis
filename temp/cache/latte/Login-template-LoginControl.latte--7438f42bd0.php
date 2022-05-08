<?php

use Latte\Runtime as LR;

/** source: /var/www/app/Infrastructure/Component/Login/template/LoginControl.latte */
final class Template7438f42bd0 extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		0 => ['content' => 'blockContent', 'loginOptions' => 'blockLoginOptions', 'userProfile' => 'blockUserProfile'],
		'snippet' => ['login' => 'blockLogin'],
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
		echo '    <div class="userProfileContext">
        <div class="userProfileMenu"';
		echo ' id="' . htmlspecialchars($this->global->snippetDriver->getHtmlId('login')) . '"';
		echo '>
';
		$this->renderBlock('login', [], null, 'snippet');
		echo '        </div>
    </div>
';
	}


	/** {define loginOptions} on line 15 */
	public function blockLoginOptions(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <span class="login">
        Přihlásit se:
    </span>
    <ul class="no-list">
        <li>
            <a class="loginLink" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("login!", ['Uživatel'])) /* line 21 */;
		echo '">Uživatel</a>
        </li>
        <li>
            <a class="loginLink" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("login!", ['Lektor'])) /* line 24 */;
		echo '">Lektor</a>
        </li>
        <li>
            <a class="loginLink" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("login!", ['Administrátor'])) /* line 27 */;
		echo '">Administrátor</a>
        </li>
    </ul>
';
	}


	/** {define userProfile} on line 32 */
	public function blockUserProfile(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <p>
';
		$identity = $user->getIdentity() /* line 34 */;
		echo '        ';
		echo LR\Filters::escapeHtmlText($identity->getName()) /* line 35 */;
		echo '
    </p>
    <ul>
        <li>
            <a class="logoutLink" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("logout!")) /* line 39 */;
		echo '">Odhlásit se</a>
        </li>
    </ul>
';
	}


	/** {snippet login} on line 5 */
	public function blockLogin(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		$this->global->snippetDriver->enter("login", 'static');
		try {
			echo '            ';
			if ($user->isLoggedIn()) /* line 6 */ {
				echo "\n";
				$this->renderBlock('userProfile', get_defined_vars(), 'html') /* line 7 */;
			} else /* line 8 */ {
				$this->renderBlock('loginOptions', get_defined_vars(), 'html') /* line 9 */;
			}
		} finally {
			$this->global->snippetDriver->leave();
		}
		
	}

}
