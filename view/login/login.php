<?php
//file: view/login/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setLayout("default");
$view->setVariable("title", "Login");
$errors = $view->getVariable("errors");
?>

<div class="login-clean">
	<form action="index.php?controller=users&amp;action=login" method="post">
		<h2 class="sr-only">Login Form</h2>
		<div class="illustration">
			<i class="" aria-hidden="true"><img class="login-icon" src="src/BSBA.png" alt="<?=i18n("BSBASports")?>" /></i>
		</div>
			<div class="form-group">
				<input class="form-control" type="text" name="username" placeholder="<?= i18n("DNI")?>" />
			</div>
			<div class="form-group">
			<input class="form-control" type="password" name="passwd" placeholder="<?= i18n("Password")?>" />
		</div>
		<div class="form-group">
			<button class="btn btn-primary btn-block" type="submit">Logg In</button>
			</div>
				<a class="forgot" href="index.php?controller=users&amp;action=recover"><?= i18n("Forgot your password?")?></a>
			</form>
		</div>
<!-- flash message -->
		<div class="flash">
			<?php if(isset($errors["general"])){
				$acumulador = $errors["general"];
				echo "<script>alert ('$acumulador');</script>";
			} ?>

		</div>

<?php $view->moveToFragment("css");?>
<link rel="stylesheet" type="text/css" src="css/style.css">
<?php $view->moveToDefaultFragment(); ?>
