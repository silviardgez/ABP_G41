<?php
// file: view/users/edit.php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance ();

$training = $view->getVariable ( "training" );
$exerciseName = $view->getVariable ( "exerciseName" );
$errors = $view->getVariable ( "errors" );

$view->setVariable ( "title", "Edit Training" );

?>

<div class="container-fluid">
	<h1 class="stroke"><?=i18n("Edit Training")?></h1>
	<br>
	<div id="edit-view" class="center-block col-xs-6 col-lg-4">
		<form id="edit-form" class="center-block form-horizontal"
			action="index.php?controller=training&amp;action=edit" method="POST">
			<input type="hidden" name="id"
				value="<?=$training->getTrainingId()?>" readonly>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
						<?=i18n("Exercise")?>:<?= isset($errors["exerciseId"])?i18n($errors["exerciseId"]):"" ?>
					</label> <input type="hidden" name="exerciseId"
					value="<?=$training->getExerciseId()?>">
				<div class="col-sm-8">
					<input class="form-control" type="text" name="exerciseName"
						value="<?=$exerciseName?>">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
						<?=i18n("Repeats")?>:<?= isset($errors["repeats"])?i18n($errors["repeats"]):"" ?>
					</label>
				<div class="col-sm-8">
					<input class="form-control" type="number" name="repeats"
						value="<?=$training->getRepeats()?>">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
						<?=i18n("Duration")?>:<?= isset($errors["repeats"])?i18n($errors["repeats"]):"" ?>
					</label>
				<div class="col-sm-8">
					<input class="form-control" name="time" type="time"
						value="<?=$training->getTime()?>">
				</div>
			</div>
			<br>
			<div class="form-group">
				<div class="col-sm-12">
					<button id="btn-styles" type="submit" name="submit" class="btn btn-success btn-lg"><?=i18n("Send")?></button>
				</div>
			</div>
		</form>
	</div>
</div>
