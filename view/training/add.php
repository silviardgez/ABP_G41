<?php
// file: view/users/edit.php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance ();

$exercises = $view->getVariable ( "exercises" );
$training = $view->getVariable ( "training" );
$errors = $view->getVariable ( "errors" );

$view->setVariable ( "title", "Add Training" );

$type = array("Cardio","Muscular","Stretching");
$i=0;
?>


<div class="container-fluid">
	<h1 class="stroke"><?=i18n("Add Training")?></h1>
	<br>
	<div id="edit-view" class="center-block col-xs-6 col-lg-4">
		<form id="edit-form" class="center-block form-horizontal"
			action="index.php?controller=training&amp;action=add" method="POST">
			<input type="hidden" name="id"
				value="<?=$training->getTrainingId()?>" readonly>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
						<?=i18n("Exercise")?>:
					</label>
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
						<?=i18n("Repeats")?>:
					</label>
				<div class="col-sm-8">
					<input class="form-control" type="number" name="repeats"
						placeholder="<?=i18n("Number of repeats")?>">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
						<?=i18n("Duration")?>:
					</label>
				<div class="col-sm-8">
					<input class="form-control" name="time" type="time" step="1">
				</div>
			</div>
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
