<?php
//file: view/exercises/add.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$exercise = $view->getVariable("exercise");
$view->setVariable("title", "Add Exercise");
$errors = $view->getVariable("errors");
?>

<h1>Añadir Ejercicio</h1>
<form action="index.php?controller=exercises&amp;action=add" method="POST" class="form-horizontal col-md-12" >
	<br><div class="form-group">
		<label class="col-lg-5 control-label"><?=i18n("Name")?>:<?= isset($errors["name"])?i18n($errors["name"]):"" ?></label>
		<div class="col-lg-7">
			<input type="text" name="nombre">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-5 control-label"><?=i18n("Type")?>:</label>
		<div class="col-lg-7">
			<select name="type">
				<option value="CARDIO"><?=i18n("Cardio")?></option>
				<option value="MUSCULAR"><?=i18n("Muscular")?></option>
				<option value="ESTIRAMIENTO"><?=i18n("Stretch")?></option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-5 control-label"><?=i18n("Image")?>:</label>
		<div class="col-lg-7">
			<input type="file" name="image">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-5 control-label"><?=i18n("Video")?>:</label>
		<div class="col-lg-7">
			<input type="file" name="video">
		</div>
	</div>
	<div class="form-group">
		<div class="col-lg-offset-5 col-lg-7">
			<button type="submit" name="submit"><?=i18n("Send")?></button>
		</div>
	</div>
</form>
