<?php
//file: view/login/newpassword.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "New Password");
//$view->setLayout("default");
$errors = $view->getVariable("errors");
?>
<div class="recuadro">
	<div id="formulario">

		<div id="login">
			<form action="index.php?controller=users&amp;action=newpass" method="POST">

				<?=i18n("DNI")?>:<?= isset($errors["DNI"])?i18n($errors["DNI"]):"" ?><input type="text" name="dni">

				<?=i18n("Password")?>:<?= isset($errors["passwd"])?i18n($errors["passwd"]):"" ?><input type="password" name="pass">
					
				<?=i18n("Repeat Password")?>:<input type="password" name="rpass">

				<button type="submit" name="submit"><?=i18n("Send")?></button>

			</form>
		</div>
	</div>
</div>