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
						<?=i18n("Table")?>:<b class="aviso-vacio"><?= isset($errors["table"])?i18n($errors["table"]):"" ?></b>
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
						<?=i18n("Date")?>:<b class="aviso-vacio"><?= isset($errors["date"])?i18n($errors["date"]):"" ?></b>
				</label>
				<div class="col-sm-8">
					<input class="form-control" type="date" name="date"
						value="<?=$session->getSessionDay()?>" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
						<?=i18n("Start time")?>:<b class="aviso-vacio"><?= isset($errors["startTime"])?i18n($errors["startTime"]):"" ?></b>
				</label>
				<div class="col-sm-8">
					<input class="form-control" name="hourIni" type="time"
						value="<?=substr($session->getSessionHourIni(),0,5)?>" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
						<?=i18n("End time")?>:<b class="aviso-vacio"><?= isset($errors["endTime"])?i18n($errors["endTime"]):"" ?></b>
				</label>
				<div class="col-sm-8">
					<input class="form-control" name="hourFin" type="time"
						value="<?=substr($session->getSessionHourFin(),0,5)?>" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
						<?=i18n("Duration")?>:<b class="aviso-vacio"><?= isset($errors["duration"])?i18n($errors["duration"]):"" ?></b>
				</label>
				<div class="col-sm-8">
					<input class="form-control" name="duration" type="time"
						value="<?=$session->getDuration()?>" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
						<?=i18n("Observations")?>:<b class="aviso-vacio"><?= isset($errors["observations"])?i18n($errors["observations"]):"" ?></b>
				</label>
				<div class="col-sm-8">
					<textarea class="form-control" name="observations" rows="6"><?=$session->getObservations()?></textarea>
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
