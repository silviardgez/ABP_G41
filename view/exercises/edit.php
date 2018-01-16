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

<div id="edit-view" class="center-block col-xs-6">
<form action="index.php?controller=exercises&amp;action=edit" method="POST" class="center-block form-horizontal">
	<br><div class="form-group">
		<div class="col-lg-6">
			<input class="form-control" type="hidden" name="id" value="<?=$exercise->getId()?>">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Name")?>:<b class="aviso-vacio"><?= isset($errors["name"])?i18n($errors["name"]):"" ?></b></label>
		<div class="col-lg-7">
			<input class="form-control" type="text" name="nombre" value="<?=$exercise->getName()?>">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Type")?>:</label>
		<div class="col-lg-7">
			<select name="tipo" class="form-control">
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
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Description")?>:</label>
		<div class="col-lg-7">
			<textarea class="form-control" type="text" rows="20" cols="20" name="description"><?=$exercise->getDescription()?></textarea>
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
	<br>
	<div class="row">
			<div class="col-xs-0 col-sm-2 col-md-3"></div>
			<div id="null_margin" class="form-group col-sm-4 col-md-3 col-xs-12">
				<button id="btn-styles" type="submit" name="submit"
				class="btn btn-success btn-lg"><?=i18n("Send")?></button>
			</div>
			<div id="null_margin" class="form-group col-sm-4 col-md-3 col-xs-12">
				<button type="button" id="btn-styles" onclick="history.back()" class="btn btn-primary btn-lg"><?=i18n("Back");?></button>
			</div>
			<div class="col-xs-0 col-sm-2 col-md-3"></div>
		</div>
</form>
</div>
