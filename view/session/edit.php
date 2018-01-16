<?php
// file: view/users/edit.php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance ();

$session = $view->getVariable ( "session" );
$tables = $view->getVariable ( "tables" );
$errors = $view->getVariable ( "errors" );

$view->setVariable ( "title", "Edit Training" );

?>

<div class="container-fluid">
	<h1 class="stroke"><?=i18n("Edit Session")?></h1>
	<br>
	<div id="edit-view" class="center-block col-xs-6 col-lg-4">
		<form id="edit-form" class="center-block form-horizontal"
			action="index.php?controller=session&amp;action=edit" method="POST">
			<input type="hidden" name="id" value="<?=$session->getSessionId()?>" readonly>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
						<?=i18n("Table")?>:<?= isset($errors["table"])?i18n($errors["table"]):"" ?>
					</label> 
				<div class="col-sm-8">
					<select class="form-control" name="table">
					<?php foreach ($tables as $id => $table): ?> 
						<option value="<?=$id?>"><?= i18n("Table") . " " . $table?></option>
					<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
						<?=i18n("Date")?>:<?= isset($errors["date"])?i18n($errors["date"]):"" ?>
				</label>
				<div class="col-sm-8">
					<input class="form-control" type="date" name="date"
						value="<?=$session->getSessionDay()?>" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
						<?=i18n("Start time")?>:<?= isset($errors["startTime"])?i18n($errors["startTime"]):"" ?>
				</label>
				<div class="col-sm-8">
					<input class="form-control" name="hourIni" type="time"
						value="<?=substr($session->getSessionHourIni(),0,5)?>" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
						<?=i18n("End time")?>:<?= isset($errors["endTime"])?i18n($errors["endTime"]):"" ?>
				</label>
				<div class="col-sm-8">
					<input class="form-control" name="hourFin" type="time"
						value="<?=substr($session->getSessionHourFin(),0,5)?>" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
						<?=i18n("Duration")?>:<?= isset($errors["duration"])?i18n($errors["duration"]):"" ?>
				</label>
				<div class="col-sm-8">
					<input class="form-control" name="duration" type="time"
						value="<?=$session->getDuration()?>" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
						<?=i18n("Observations")?>:<?= isset($errors["observations"])?i18n($errors["observations"]):"" ?>
				</label>
				<div class="col-sm-8">
					<textarea class="form-control" name="observations" rows="6"><?=$session->getObservations()?></textarea>
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
