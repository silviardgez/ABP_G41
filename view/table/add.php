<?php
//file: view/users/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$table = $view->getVariable("table");
$trainings = $view->getVariable("trainings");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Add Table");

?>

<div class="container-fluid">
	<h1 class="stroke"><?=i18n("Add Table") . " " . $table->getTableId()?></h1>
	<br>
	<div id="edit-view" class="center-block col-xs-6 col-lg-4">
		<form id="edit-form" class="center-block form-horizontal"
		action="index.php?controller=table&amp;action=add" method="POST">
		<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
				<?=i18n("Type")?>:
				</label>
				<div class="col-sm-8">
				<select class="form-control" name="type">
					<option value="ESTANDAR"><?=i18n("ESTANDAR")?></option>
					<option value="PERSONALIZADA"><?=i18n("PERSONALIZADA")?></option>
				</select>
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

