<?php
// file: view/users/edit.php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance ();

$coaches = $view->getVariable ( "monitors" );
$aulas = $view->getVariable ( "aulas" );
$errors = $view->getVariable ( "errors" );
$activityName = $view->getVariable("activityName");
$color = $view->getVariable("color");

$view->setVariable ( "title", "Add Activity" );

?>

<div class="container-fluid">
	<h1 class="stroke"><?=i18n("Add Activity")?></h1>
	<br>
	<div id="edit-view" class="center-block col-xs-6 col-lg-4">
		<form id="edit-form" class="center-block form-horizontal"
			action="index.php?controller=activity&amp;action=add" method="POST">
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
				<?=i18n("Name")?>:<b class="aviso-vacio"><?= isset($errors["name"])?i18n($errors["name"]):"" ?></b>
				</label>
				<div class="col-sm-8">
					<?php if($activityName == ""){ ?>
					<input class="form-control" type="text" name="name">
					<?php }else{ ?>
					<input class="form-control" type="text" name="name" value="<?=$activityName?>" readonly>
					<?php } ?>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
				<?=i18n("Start")?>:
				</label>
				<div class="col-sm-8">
					<input class="form-control" type="time" name="startTime">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
				<?=i18n("End")?>:
				</label>
				<div class="col-sm-8">
					<input class="form-control" type="time" name="endTime">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
				<?=i18n("Day")?>:
				</label>
				<div class="col-sm-8">
					<select class="form-control" name="day">
						<option value="MONDAY"><?=i18n("MONDAY")?></option>
						<option value="TUESDAY"><?=i18n("TUESDAY")?></option>
						<option value="WEDNESDAY"><?=i18n("WEDNESDAY")?></option>
						<option value="THURSDAY"><?=i18n("THURSDAY")?></option>
						<option value="FRIDAY"><?=i18n("FRIDAY")?></option>
						<option value="SATURDAY"><?=i18n("SATURDAY")?></option>
						<option value="SUNDAY"><?=i18n("SUNDAY")?></option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
				<?=i18n("Monitor")?>:<b class="aviso-vacio"><?= isset($errors["monitor"])?i18n($errors["monitor"]):"" ?></b>
				</label>
				<div class="col-sm-8">
					<select class="form-control" name="monitor">
					<?php foreach ($coaches as $coach => $coachName): ?>
					 	<option value="<?=$coach?>"><?=$coachName?></option>
					<?php endforeach; ?>
				</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
				<?=i18n("Classroom")?>:<b class="aviso-vacio"><?= isset($errors["classroom"])?i18n($errors["classroom"]):"" ?></b>
				</label>
				<div class="col-sm-8">
					<select class="form-control" name="aula">
					<?php foreach ($aulas as $aula => $aulaName): ?>
					 	<option value="<?=$aula?>"><?=$aulaName?></option>
					<?php endforeach; ?>
				</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
				<?=i18n("Places offered")?>:
				</label>
				<div class="col-sm-8">
					<input class="form-control" type="number" name="places">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
				<?=i18n("Color")?>:
				</label>
				<div class="col-sm-8">
					<?php if($color == ""){ ?>
						<input class="form-control" type="color" name="color">
					<?php }else{ ?>
						<input class="form-control" type="color" name="color" value="<?=$color?>" readonly onmouseover="this.disabled=true;" onmouseout="this.disabled=false;" >
					<?php } ?>
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
					<button id="btn-styles" type="button" onclick="history.back()"
					class="btn btn-primary btn-lg"><?=i18n("Back")?></button>
				</div>
			<div class="col-xs-0 col-sm-2 col-xl-3"></div>
		</div>
		</form>
	</div>
</div>
