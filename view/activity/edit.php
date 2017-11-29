<?php
// file: view/users/edit.php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance ();

$activity = $view->getVariable ( "activity" );
$activities = $view->getVariable ( "activities" );
$errors = $view->getVariable ( "errors" );

$activitiesArray = serialize($activities);
$activitiesArray = urlencode($activitiesArray);

$view->setVariable ( "title", "Edit Activity" );

?>

<div class="container-fluid">
	<h1 class="stroke"><?=i18n("Edit Activity")?></h1>
	<br>
	<div id="edit-view" class="center-block col-xs-6 col-lg-4">
		<form id="edit-form" class="center-block form-horizontal"
			action="index.php?controller=activity&amp;action=edit" method="POST">
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
				<?=i18n("Name")?>:<?= isset($errors["name"])?i18n($errors["name"]):"" ?>
				</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="name"
						value="<?=$activity->getActivityName()?>">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
				<?=i18n("Color")?>:<?= isset($errors["color"])?i18n($errors["color"]):"" ?>
				</label>
				<div class="col-sm-8">
					<input class="form-control" type="color" name="color" value="<?=$activity->getColor()?>">
				</div>
			</div>
			<br> <input type="hidden" name="activities" value="<?= $activitiesArray?>">

			<div class="form-group">
				<div class="col-sm-12">
					<button id="btn-styles" type="submit" name="submit"
						class="btn btn-success btn-lg"><?=i18n("Send")?></button>
				</div>
			</div>
		</form>
	</div>
</div>
