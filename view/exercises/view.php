<?php
//file: view/exercises/view.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$exercise = $view->getVariable("exercise");
$view->setVariable("title", "View exercise");
$errors = $view->getVariable ( "errors" );
?>
<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("View Exercise")?></h1>
	<br>
</div>

<div id="edit-view" class="center-block col-xs-6 col-lg-6">
<form class="center-block form-horizontal" >
	<br><div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Name")?>:<?= isset($errors["name"])?i18n($errors["name"]):"" ?></label>
		<div class="col-lg-7">
			<input class="form-control" type="text" name="nombre" value="<?=$exercise->getName()?>" readonly="readonly">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Type")?>:</label>
		<div class="col-lg-7">
			<input class="form-control" type="text" name="tipo" value="<?=$exercise->getType()?>" readonly="readonly">
		</div>
	</div>
	<div class="form-group">
		<?php if($exercise->getDescription() != NULL && $exercise->getDescription() != ""){ ?>
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Description")?>:</label>
		<div class="col-lg-7">
			<textarea class="form-control" rows="18" cols="36" name="descripcion" readonly="readonly"><?=$exercise->getDescription()?></textarea>
		</div>
		<?php } ?>
	</div>
	<div class="form-group">
		<?php if($exercise->getImage() != NULL && $exercise->getImage() != ""){ ?>
			<label class="control-label text-size text-muted col-sm-4"><?=i18n("Image")?>:</label>
			<div class="col-lg-7">
				<img src="<?=$exercise->getImage()?>" alt="<?=i18n("Image not found")?>" />
			</div>
		<?php } ?>
	</div>
	<div class="form-group">
		<?php if($exercise->getVideo() != NULL && $exercise->getVideo() != ""){ ?>
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Video")?>:</label>
		<div class="col-lg-7">
			<iframe width="560" height="315" src="<?=$exercise->getVideo()?>" controls autoplay frameborder="0" allowfullscreen></iframe>
		</div>
		<?php }?>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<button type="button" id="btn-styles" onclick="history.back()" class="btn btn-primary btn-lg"><?=i18n("Back")?></button>
		</div>
	</div>
</form>
</div>
