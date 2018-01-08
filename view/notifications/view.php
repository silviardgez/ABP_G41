<?php
//file: view/notifications/view.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$exercise = $view->getVariable("notification");
$view->setVariable("title", "View notification");
$errors = $view->getVariable ( "errors" );
?>
<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("View Notification")?></h1>
	<br>
</div>

<div id="edit-view" class="center-block col-xs-6 col-lg-6">
<form class="center-block form-horizontal" >
	<br><div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Sender")?>:</label>
		<div class="col-lg-7">
			<input class="form-control" type="text" name="sender" value="<?=$exercise->getSender()?>" readonly="readonly">
		</div>
	</div>
  <div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Subject")?>:</label>
		<div class="col-lg-7">
			<input class="form-control" type="text" name="subject" value="<?=$exercise->getSubject()?>" readonly="readonly">
		</div>
	</div>

  <div class="form-group">
    <label class="control-label text-size text-muted col-sm-4"><?=i18n("Message")?>:</label>
    <div class="col-lg-7">
      <textarea class="form-control" rows="20" cols="40" name="message" readonly="readonly"><?=$exercise->getMessage()?></textarea>
    </div>
  </div>

	<div class="form-group">
  	<div class="col-sm-12">
  			<button type="button" id="btn-styles" onclick="history.back()" class="btn btn-success btn-lg"><?=i18n("Back")?></button>
  	</div>
	</div>
</form>
</div>
