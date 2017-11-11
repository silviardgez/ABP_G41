<?php
//file: view/login/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Login");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>
<div class="recuadro">
	<div id="formulario">

		<div id="login">
			<form action="index.php?controller=users&amp;action=login" method="POST">
				<?= i18n("DNI")?>: <input class="typetext" type="text" name="username">
				<?= i18n("Password")?>: <input class="typetext" type="password" name="passwd">
				<button type="submit" name="submit" class="cancel"><i class="button fa fa-sign-in"></i></button>
			</form>
		</div>
	</div>
</div>

<?php $view->moveToFragment("css");?>
<link rel="stylesheet" type="text/css" src="css/style.css">
<?php $view->moveToDefaultFragment(); ?>
