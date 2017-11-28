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
	<h1 class="stroke"><?=i18n("Add Session")?></h1>
	<br>
	<div id="edit-view" class="center-block col-xs-6 col-lg-4">
		<form id="edit-form" class="center-block form-horizontal"
			action="index.php?controller=session&amp;action=add" method="POST">
			<input type="hidden" name="id" value="<?=$session->getSessionId()?>" readonly>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
						<?=i18n("Table")?>:
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
						<?=i18n("Date")?>:
				</label>
				<div class="col-sm-8">
					<input class="form-control" type="date" name="date" >
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
						<?=i18n("Hour")?>:
				</label>
				<div class="col-sm-8">
					<input class="form-control" name="hours" type="time">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
						<?=i18n("Observations")?>:
				</label>
				<div class="col-sm-8">
					<textarea class="form-control" name="observations" rows="4"></textarea>
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
