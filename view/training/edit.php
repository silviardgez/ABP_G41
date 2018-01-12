<?php
// file: view/users/edit.php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance ();

$training = $view->getVariable ( "training" );
$exercises = $view->getVariable ( "exercises" );
$exerciseName = $view->getVariable ( "exerciseName" );
$exerciseType = $view->getVariable ( "exerciseType" );
$errors = $view->getVariable ( "errors" );

$view->setVariable ( "title", "Edit Training" );

$type = array("Cardio","Muscular","Stretching");
$i=0;

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
						<?=i18n("Exercise")?>:<b class="aviso-vacio"><?= isset($errors["exerciseId"])?i18n($errors["exerciseId"]):"" ?></b>
					</label> <input type="hidden" name="exerciseId"
					value="<?=$training->getExerciseId()?>">
				<div class="col-sm-8">
					<select class="form-control" name="exerciseId">
					<?php foreach ($exercises as $exerciseType):?>
						<optgroup label="<?=i18n($type[$i])?>">
					<?php foreach ($exerciseType as $exercise => $exerciseName): ?>
							<option value="<?=$exercise?>"><?=$exerciseName?></option>
					<?php endforeach;
					$i++;?>
						</optgroup>
					<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
						<?=i18n("Repeats")?>:<b class="aviso-vacio"><?= isset($errors["repeats"])?i18n($errors["repeats"]):"" ?></b>
					</label>
				<div class="col-sm-8">
					<input class="form-control" type="number" name="repeats"
						value="<?=$training->getRepeats()?>">
				</div>
			</div>
			<?php if($exerciseType != "MUSCULAR"):?>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
						<?=i18n("Duration")?>:<b class="aviso-vacio"><?= isset($errors["duration"])?i18n($errors["duration"]):"" ?></b>
				</label>
				<div class="col-sm-8">
					<input class="form-control" name="time" type="time" step="1"
						value="<?=$training->getTime()?>">
				</div>
			</div>
			<?php endif;?>
			<br>
			<div class="form-group">
				<div class="col-sm-12">
					<button id="btn-styles" type="submit" name="submit"
						class="btn btn-success btn-lg"><?=i18n("Send")?></button>
				</div>
			</div>
		</form>
	</div>
</div>
