<?php
//file: view/login/recover.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Recover Password");
$view->setLayout("default");
$errors = $view->getVariable("errors");
?>
<div class="recuadro">
	<div id="formulario">

		<div id="login">
			<form action="index.php?controller=users&amp;action=recover" method="POST">

				<?=i18n("DNI")?>:<?= isset($errors["DNI"])?i18n($errors["DNI"]):"" ?><input type="text" name="dni">

				<?=i18n("Email")?>:<?= isset($errors["email"])?i18n($errors["email"]):"" ?><input type="email" name="email">

				<button type="submit" name="submit"><?=i18n("Send")?></button>

			</form>
		</div>
	</div>
</div>