<?php
//file: view/login/home.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Home");
$view->setLayout("welcome");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>
<div class="recuadro">
	<div id="formulario">
		<div id="login">
			<form action="" method="POST">
				Bienvenido, seleccione opción en el menú principal
			</form>
		</div>
	</div>
</div>

<?php $view->moveToFragment("css");?>
<link rel="stylesheet" type="text/css" src="css/style.css">
<?php $view->moveToDefaultFragment(); ?>
