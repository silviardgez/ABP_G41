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
					<?php foreach ($exercises as $exercisesType):?>
						<optgroup label="<?=i18n($type[$i])?>">
							<?php if(strcasecmp($exerciseType,$type[$i])==0): ?>
								<option value="<?=$training->getExerciseId()?>" selected><?=$exerciseName?></option>
							<?php endif; ?>
							<?php foreach ($exercisesType as $exercise => $exercisesName): ?>
								<option value="<?=$exercise?>"><?=$exercisesName?></option>
							<?php endforeach;
							$i++;?>
						</optgroup>
					<?php endforeach; ?>
				</select>
				<script type="text/javascript">
					$("select[name=exerciseId]").change(function(){
						if($('select[name=exerciseId] :selected').closest('optgroup').prop('label') == "Muscular"){
							$('#duration').hide();
						} else {
							$('#duration').show();
						};
					}); 
				</script>
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
		<div id="duration" class="form-group" <?php if($exerciseType == "MUSCULAR"): ?> style="display: none;" <?php endif;?>>
			<label class="control-label text-size text-muted col-sm-4">
				<?=i18n("Duration")?>:<b class="aviso-vacio"><?= isset($errors["duration"])?i18n($errors["duration"]):"" ?></b>
			</label>
			<div class="col-sm-8">
				<input class="form-control" name="time" type="time" step="1"
				value="<?=$training->getTime()?>">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-xs-0 col-sm-2"></div>
			<div id="null_margin" class="form-group col-sm-4 col-xs-12">
				<button id="btn-styles" type="submit" name="submit"
				class="btn btn-success btn-lg"><?=i18n("Send")?></button>
			</div>
			<div id="null_margin" class="form-group col-sm-4 col-xs-12">
				<button type="button" id="btn-styles" onclick="history.back()" class="btn btn-primary btn-lg"><?=i18n("Back");?></button>
			</div>
			<div class="col-xs-0 col-sm-2"></div>
		</div>
	</form>
</div>
</div>
