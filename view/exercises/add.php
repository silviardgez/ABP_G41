<?php
//file: view/exercises/add.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$exercise = $view->getVariable("exercise");
$view->setVariable("title", "Add Exercise");
$errors = $view->getVariable("errors");
?>

<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("Add Exercice")?></h1>
	<br>
</div>

<div id="edit-view" class="center-block col-xs-6 col-lg-4">
<form action="index.php?controller=exercises&amp;action=add" method="POST" class="center-block form-horizontal" >
	<br><div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Name")?>:<?= isset($errors["name"])?i18n($errors["name"]):"" ?></label>
		<div class="col-lg-7">
			<input type="text" name="name">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Type")?>:</label>
		<div class="col-lg-7">
			<select name="type">
				<option value="CARDIO"><?=i18n("Cardio")?></option>
				<option value="MUSCULAR"><?=i18n("Muscular")?></option>
				<option value="ESTIRAMIENTO"><?=i18n("Stretch")?></option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Description")?>:<?= isset($errors["description"])?i18n($errors["description"]):"" ?></label>
		<div class="col-lg-7">
			<textarea type="text" rows="20" cols="20" name="description"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Image")?>:</label>
		<div class="col-lg-7">
			<input type="file" name="image">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Video")?>:</label>
		<div class="col-lg-7">
			<input type="file" name="video">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-6">
      <button type="button" id="btn-styles" onclick="history.back()" class="btn btn-warning btn-lg"><?=i18n("Back")?></button>
    </div>
		<div class="col-sm-6">
			<button id="btn-styles" type="submit" name="submit" class="btn btn-success btn-lg"><?=i18n("Send")?></button>
		</div>
	</div>
</form>
</div>
