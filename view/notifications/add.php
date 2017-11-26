<?php
//file: view/notifications/add.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Add notification");
$dni = $view->getVariable("dni");
$email = $view->getVariable("email");
?>

<h1>Añadir Notificación Individual</h1>
<form action="index.php?controller=notifications&amp;action=add" method="POST" class="form-horizontal col-md-12" >
	<br><div class="form-group">
		<label class="col-lg-6 control-label"><?=i18n("Email")?>:</label>
		<div class="col-lg-6">
			<input type="text" name="email" value="<?= $email ?>" readonly="readonly">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-6 control-label"><?=i18n("Subject")?>:</label>
		<div class="col-lg-6">
			<input type="text" name="subject">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-6 control-label"><?=i18n("Message")?>:</label>
		<div class="col-lg-6">
			<textarea rows="3" name="message"></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-lg-offset-6 col-lg-6">
			<button type="submit" name="submit" class="btn btn-default"><?=i18n("Send")?></button>
		</div>
	</div>
</form>
