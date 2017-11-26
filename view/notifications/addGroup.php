<?php
//file: view/notifications/addGroup.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Add Group Notification");
$id = $view->getVariable("id");
?>

<h1><?=i18n("Add Group Notification")?></h1>
<form action="index.php?controller=notifications&amp;action=add" method="POST" class="form-horizontal col-md-12" >
	<br><div class="form-group">
		<div class="col-lg-6">
			<input type="hidden" name="id" value="<?= $id ?>">
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
