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

		<object class="home" type="text/html" data="https://www.deportes.uvigo.es/instalacions/campus-de-ourense/" width="820" height="500"></object>

	</div>
</div>

<?php $view->moveToFragment("css");?>
<link rel="stylesheet" type="text/css" src="css/style.css">
<?php $view->moveToDefaultFragment(); ?>
