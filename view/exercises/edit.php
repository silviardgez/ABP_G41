<?php
//file: view/exercises/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$exercise = $view->getVariable("exercise");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Edit Exercise");
?>

<div class="recuadro">
	<div id="formulario">

		<div class="home2">
			<form action="index.php?controller=exercises&amp;action=edit" method="POST">
				<br><?= isset($errors["id"])?i18n($errors["id"]):"" ?><input type="hidden" name="id" value="<?=$exercise->getId()?>">  
				<br><?=i18n("Name")?>:<?= isset($errors["name"])?i18n($errors["name"]):"" ?><input type="text" name="nombre" value="<?=$exercise->getName()?>">  

				<?=i18n("Type")?>:
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

				<?=i18n("Image")?>:<input type="file" name="imagen" value="<?=$exercise->getImage()?>"> 

				<?=i18n("Video")?>:<input type="file" name="video" value="<?=$exercise->getVideo()?>">

				<button type="submit" name="submit"><?=i18n("Send")?></button>

			</form>
		</div>
	</div>
</div>