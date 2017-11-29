<?php
//file: view/notifications/addGroup.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Add Group Notification");
$id = $view->getVariable("id");
?>

<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("Add Group Notification")?></h1>
	<br>
</div>

<div id="edit-view" class="center-block col-xs-6 col-lg-4">
<form action="index.php?controller=notifications&amp;action=add" method="POST" class="center-block form-horizontal">
	<br><div class="form-group">
		<div class="col-lg-6">
			<input type="hidden" name="id" value="<?= $id ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Subject")?>:</label>
		<div class="col-lg-6">
			<input type="text" name="subject">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Message")?>:</label>
		<div class="col-lg-6">
			<textarea rows="3" name="message"></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<button id="btn-styles" type="submit" name="submit" class="btn btn-success btn-lg"><?=i18n("Send")?></button>
		</div>
	</div>
</form>
</div>
