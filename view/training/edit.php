<?php
//file: view/users/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$training = $view->getVariable("training");
$exerciseName = $view->getVariable("exerciseName");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Edit Training");

?>

<div class="recuadro">
	<div id="formulario">
		<div class="home2">
			<form action="index.php?controller=training&amp;action=edit" method="POST">
				<input type="hidden" name="id" value="<?=$training->getTrainingId()?>" readonly> 
				<br><?=i18n("Exercise")?>:<?= isset($errors["exerciseId"])?i18n($errors["exerciseId"]):"" ?>
				<input type="hidden" name="exerciseId" value="<?=$training->getExerciseId()?>"> 
				<input type="text" name="exerciseName" value="<?=$exerciseName?>"> 
				<br><?=i18n("Repeats")?>:<?= isset($errors["repeats"])?i18n($errors["repeats"]):"" ?>
				<input type="number" name="repeats" value="<?=$training->getRepeats()?>">
				<br><?=i18n("Time")?>:<?= isset($errors["repeats"])?i18n($errors["repeats"]):"" ?>
				<input name="time" type="time" value="<?=$training->getTime()?>">
				<br>
				<button type="submit" name="submit"><?=i18n("Send")?></button>
			</form>
		</div>
	</div>
</div>
