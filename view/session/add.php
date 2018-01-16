<?php
// file: view/users/edit.php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance ();

$session = $view->getVariable ( "session" );
$tables = $view->getVariable ( "tables" );
$errors = $view->getVariable ( "errors" );

$view->setVariable ( "title", "Add Session" );

?>

<div class="container-fluid">
	<h1 class="stroke"><?=i18n("Add Session")?></h1>
	<br>
	<div id="edit-view" class="center-block col-xs-6 col-lg-4">
		<form id="edit-form" class="center-block form-horizontal"
			action="index.php?controller=session&amp;action=add" method="POST">
			<input type="hidden" name="id" value="<?=$session->getSessionId()?>" readonly>
			<input type="hidden" name="startTime" value="<?=$_POST["startTime"]?>" readonly>
 			<input type="hidden" name="endTime" value="<?=$_POST["endTime"]?>" readonly>
 			<input type="hidden" name="day" value="<?=$_POST["day"]?>" readonly>
 			<input type="hidden" name="duration" value="<?=$_POST["duration"]?>" readonly>
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
						<?=i18n("Observations")?>:<b class="aviso-vacio"><?= isset($errors["observations"])?i18n($errors["observations"]):"" ?></b>
				</label>
				<div class="col-sm-8">
					<textarea class="form-control" name="observations" rows="6"></textarea>
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
