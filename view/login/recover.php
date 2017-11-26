<?php
//file: view/login/recover.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Recover Password");
$view->setLayout("default");
$errors = $view->getVariable("errors");
?>
<div class="login-clean">
	<form action="index.php?controller=users&amp;action=recover" method="post">
		<div class="illustration">
			<i class="" aria-hidden="true"><img class="login-icon" src="src/BSBA.png" alt="<?=i18n("BSBASports")?>" /></i>
		</div>
			<div class="form-group">
				<?=i18n("DNI")?>:<?= isset($errors["DNI"])?i18n($errors["DNI"]):"" ?>
				<input class="form-control" type="text" name="dni" placeholder="<?= i18n("DNI")?>" />
			</div>
			<div class="form-group">
				<?=i18n("Email")?>:<?= isset($errors["email"])?i18n($errors["email"]):"" ?>
			<input class="form-control" type="email" name="email" placeholder="<?= i18n("Email")?>" />
		</div>
		<div class="form-group">
			<button class="btn btn-primary btn-block" type="submit" name="submit"><?=i18n("Send")?></button>
		</div>
			</form>
		</div>
