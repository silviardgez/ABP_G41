<?php
// file: view/users/edit.php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance ();
$activity = $view->getVariable ( "activity" );
$coaches = $view->getVariable ( "monitors" );
$booking = $view->getVariable ( "booking" );
$errors = $view->getVariable ( "errors" );
$view->setVariable ( "title", "Edit Current Activity" );
?>

<div class="container-fluid col-xs-12">
	<?php if(!$_SESSION["deportista"]):?>
		<h1 class="stroke"><?=i18n("Edit Activity")?></h1>
	<?php endif;?>
	<?php if($_SESSION["deportista"]):?>
		<h1 class="stroke"><?=i18n("Reservation")?></h1>
	<?php endif;?>
	<br>
	<div id="edit-view" class="center-block col-xs-6 col-lg-4 editactivity_box">
		<?php if(!$_SESSION["deportista"]):?>
			<form id="edit-form" class="center-block form-horizontal"
			action="index.php?controller=activity&amp;action=editcurrent"
			method="POST">
		<?php elseif($_SESSION["deportista"]):?>
			<form id="edit-form" class="center-block form-horizontal"
			action="index.php?controller=book&amp;action=addBook"
			method="POST">
		<?php endif;?>

		<input type="hidden" name="id"
		value="<?=$activity->getActivityId()?>">
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
				<?=i18n("Start")?>:<?= isset($errors["startTime"])?i18n($errors["startTime"]):"" ?>
			</label>
			<div class="col-sm-8">
				<input class="form-control" type="time" name="startTime"
				value="<?=$activity->getStartTime()?>" <?php if($_SESSION["deportista"]):?> readonly <?php endif;?>>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label text-size text-muted col-sm-4">
				<?=i18n("End")?>:<?= isset($errors["endTime"])?i18n($errors["endTime"]):"" ?>
			</label>
			<div class="col-sm-8">
				<input class="form-control" type="time" name="endTime"
				value="<?=$activity->getEndTime()?>" <?php if($_SESSION["deportista"]):?> readonly <?php endif;?>>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label text-size text-muted col-sm-4">
				<?=i18n("Day")?>:<?= isset($errors["day"])?i18n($errors["day"]):"" ?>
			</label>
			<div class="col-sm-8">
				<select class="form-control" name="day" <?php if($_SESSION["deportista"]):?> readonly <?php endif;?>>
					<option value="MONDAY"><?=i18n("MONDAY")?></option>
					<option value="THURSDAY"><?=i18n("TUESDAY")?></option>
					<option value="WEDNESDAY"><?=i18n("WEDNESDAY")?></option>
					<option value="THURSDAY"><?=i18n("THURSDAY")?></option>
					<option value="FRIDAY"><?=i18n("FRIDAY")?></option>
					<option value="SATURDAY"><?=i18n("SATURDAY")?></option>
					<option value="SUNDAY"><?=i18n("SUNDAY")?></option>
					<option value="<?=$activity->getDay()?>" selected="selected"><?=i18n($activity->getDay())?></option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label text-size text-muted col-sm-4">
				<?=i18n("Monitor")?>:<?= isset($errors["monitor"])?i18n($errors["monitor"]):"" ?>
			</label>
			<div class="col-sm-8">
				<select class="form-control" name="monitor" <?php if($_SESSION["deportista"]):?> readonly <?php endif;?>>
					<?php foreach ($coaches as $coach => $coachName): ?>
						<option value="<?=$coach?>"><?=$coachName?></option>
					<?php endforeach; ?>
					<option value="<?=$activity->getMonitor()?>" selected="selected"><?=$activity->getMonitorName()?></option>
				</select>
			</div>
		</div>
		<br>

		<?php if(!$_SESSION["deportista"]):?>
			<div class="row">
				<div class="col-xs-0 col-sm-2"></div>
				<div id="null_margin" class="form-group col-sm-4 col-xs-12">
					<button id="btn-styles" type="submit" name="submit"
					class="btn btn-success btn-lg"><?=i18n("Send")?></button>
				</div>
				<div id="null_margin" class="form-group col-xs-12 col-sm-4">
					<form method="POST"
					action="index.php?controller=activity&amp;action=delete"
					id="delete_activity_<?= $activity->getActivityId(); ?>"
					style="display: inline">
					<input type="hidden" name="id"
					value="<?= $activity->getActivityId() ?>">
				</form>

				<button id="btn-styles" class="btn btn-danger btn-lg"
				onclick="
				if (confirm('<?= i18n("are you sure?")?>')) {
					document.getElementById('delete_activity_<?=$activity->getActivityId()?>').submit()
				}"
				form="delete_activity_<?= $activity->getActivityId(); ?>"><?=i18n("Delete")?></button>
			</div>
		</div>
		<div class="col-xs-0 col-sm-2 col-xl-3"></div>
	<?php endif;?>

	<!-- BOTÓN DEL DEPORTISTA PARA REALIZAR LA RESERVA -->
	<?php if($_SESSION["deportista"] && $booking->getConfirmed() == NULL):?>
		<div class="form-group">
			<div class="col-sm-12">
				<button id="btn-styles" type="submit" name="submit"
				class="btn btn-success btn-lg"><?=i18n("To reserve")?></button>
			</div>
		</div>
	<?php else:?>
		<div class="form-group">
			<div class="col-sm-12">
				<button type="button" id="btn-styles" onclick="history.back()" class="btn btn-warning btn-lg"><?=i18n("Back")?></button>
			</div>
		</div>
	<?php endif;?>
</form>
</div>
</div>
