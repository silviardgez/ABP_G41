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
	<div id="edit-view" class="center-block col-xs-6 col-lg-4 editactivity_box">
		<form id="edit-form" class="center-block form-horizontal"
			action="index.php?controller=activity&amp;action=edit" method="POST">
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
				<?=i18n("Name")?>:<b class="aviso-vacio"><?= isset($errors["name"])?i18n($errors["name"]):"" ?></b>
				</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="name"
						value="<?=$activity->getActivityName()?>">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
				<?=i18n("Color")?>:<b class="aviso-vacio"><?= isset($errors["color"])?i18n($errors["color"]):"" ?></b>
				</label>
				<div class="col-sm-8">
					<input class="form-control" type="color" name="color" value="<?=$activity->getColor()?>">
				</div>
			</div>
			<br> <input type="hidden" name="activities" value="<?= $activitiesArray?>">

			<div class="row">
				<div class="col-xs-0 col-sm-2"></div>
				<div id="null_margin" class="form-group col-sm-4 col-xs-12">
					<button id="btn-styles" type="submit" name="submit"
					class="btn btn-success btn-lg"><?=i18n("Send")?></button>
				</div>
				<div id="null_margin" class="form-group col-sm-4 col-xs-12">
				<button type="button" id="btn-styles" onclick="history.back()" class="btn btn-primary btn-lg"><?=i18n("Back");?></button>
			</div>
			<div class="col-xs-0 col-sm-2 col-xl-3"></div>
		</div>
		</form>
	</div>
</div>
