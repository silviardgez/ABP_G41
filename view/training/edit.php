<?php
//file: view/users/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$training = $view->getVariable("training");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Edit Training");

?>

<div class="recuadro">
	<div id="formulario">
		<div class="home2">
			<form action="index.php?controller=training&amp;action=edit" method="POST">
				<br><?=i18n("Id")?>:<?= isset($errors["id"])?i18n($errors["id"]):"" ?>
				<input type="text" name="id" value="<?=$training->getTrainingId()?>" readonly> 
				<br><?=i18n("Exercise")?>:<?= isset($errors["exerciseId"])?i18n($errors["exerciseId"]):"" ?>
				<input type="text" name="exerciseId" value="<?=$training->getExerciseId()?>"> 
				<br><?=i18n("Repeats")?>:<?= isset($errors["repeats"])?i18n($errors["repeats"]):"" ?>
				<input type="number" name="repeats" value="<?=$training->getRepeats()?>">
				<br><?=i18n("Time")?>:<?= isset($errors["repeats"])?i18n($errors["repeats"]):"" ?>
				<input name="time" type="time" value="<?=$training->getTime()?>">
				<br><br><br>
		
				<button type="submit" name="submit"><?=i18n("Send")?></button>

			</form>
		</div>
	</div>
</div>
