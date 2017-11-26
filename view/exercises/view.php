<?php
//file: view/exercises/view.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$exercise = $view->getVariable("exercise");
$view->setVariable("title", "View exercise");
?>

<h1><?=i18n("View Exercice")?></h1>
<form class="form-horizontal col-md-12" >
	<br><div class="form-group">
		<label class="col-lg-5 control-label"><?=i18n("Name")?>:<?= isset($errors["name"])?i18n($errors["name"]):"" ?></label>
		<div class="col-lg-7">
			<input type="text" name="nombre" value="<?=$exercise->getName()?>" readonly="readonly">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-5 control-label"><?=i18n("Type")?>:</label>
		<div class="col-lg-7">
			<input type="text" name="tipo" value="<?=$exercise->getType()?>" readonly="readonly">
		</div>
	</div>
	<div class="form-group">
		<?php if($exercise->getImage() != NULL && $exercise->getImage() != ""){ ?>
			<label class="col-lg-5 control-label"><?=i18n("Image")?>:</label>
			<div class="col-lg-7">
				<img src="<?=$exercise->getImage()?>" alt="<?=i18n("Image not found")?>" />
			</div>
		<?php } ?>
	</div>
	<div class="form-group">
		<?php if($exercise->getVideo() != NULL && $exercise->getVideo() != ""){ ?>
		<label class="col-lg-5 control-label"><?=i18n("Video")?>:</label>
		<div class="col-lg-7">
			<iframe width="560" height="315" src="<?=$exercise->getVideo()?>" controls autoplay frameborder="0" allowfullscreen></iframe>
		</div>
		<?php }?>
	</div>
	<div class="form-group">
		<div class="col-lg-offset-6 col-lg-6">
			<button type="button" onclick="history.back()"><?=i18n("OK")?></button>
		</div>
	</div>
</form>
