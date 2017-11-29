<?php
//file: view/exercises/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$exercise = $view->getVariable("exercise");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Edit Exercise");
?>

<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("Edit Exercise")?></h1>
	<br>
</div>

<div id="edit-view" class="center-block col-xs-6 col-lg-4">
<form action="index.php?controller=exercises&amp;action=edit" method="POST" class="center-block form-horizontal">
	<br><div class="form-group">
		<div class="col-lg-6">
			<input type="hidden" name="id" value="<?=$exercise->getId()?>">
		</div>
	</div>
	<br><div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Name")?>:<?= isset($errors["name"])?i18n($errors["name"]):"" ?></label>
		<div class="col-lg-7">
			<input type="text" name="nombre" value="<?=$exercise->getName()?>">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Type")?>:</label>
		<div class="col-lg-7">
			<select name="tipo">
				<?php if($exercise->getType() == "CARDIO"){ ?>
				<option value="CARDIO" selected="selected"><?=i18n("Cardio")?></option>
				<option value="MUSCULAR"><?=i18n("Muscular")?></option>
				<option value="ESTIRAMIENTO"><?=i18n("Stretch")?></option>
				<?php }elseif ($exercise->getType() == "MUSCULAR") { ?>
				<option value="CARDIO"><?=i18n("Cardio")?></option>
				<option value="ESTIRAMIENTO"><?=i18n("Stretch")?></option>
				<option value="MUSCULAR" selected="selected"><?=i18n("Muscular")?></option>
				<?php }else{ ?>
				<option value="CARDIO"><?=i18n("Cardio")?></option>
				<option value="ESTIRAMIENTO" selected="selected"><?=i18n("Stretch")?></option>
				<option value="MUSCULAR"><?=i18n("Muscular")?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Image")?>:</label>
		<div class="col-lg-7">
			<input type="file" name="imagen" value="<?=$exercise->getImage()?>">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Video")?>:</label>
		<div class="col-lg-7">
			<input type="file" name="video" value="<?=$exercise->getVideo()?>">
		</div>
	</div>
	<div class="form-group">
    <div class="col-sm-12">
      <button id="btn-styles" type="submit" name="submit" class="btn btn-success btn-lg"><?=i18n("Send")?></button>
    </div>
  </div>
</form>
</div>
