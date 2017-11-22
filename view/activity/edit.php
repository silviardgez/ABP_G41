<?php
//file: view/users/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$activity = $view->getVariable("activity");
$activities = $view->getVariable("activities");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Edit Activity");

?>

<div class="recuadro">
	<div id="formulario">
		<div class="home2">
			<form action="index.php?controller=activity&amp;action=edit" method="POST">
				<br><?=i18n("Name")?>:<?= isset($errors["name"])?i18n($errors["name"]):"" ?>
				<input type="text" name="name" value="<?=$activity->getActivityName()?>"> 
				<br><?=i18n("Color")?>:<?= isset($errors["color"])?i18n($errors["color"]):"" ?>
				<input type="color" name="color" value="<?=$activity->getColor()?>">
				<input type="hidden" name="activities" value="<?=$activities?>">
				<br><br><br>
				
				<button type="submit" name="submit"><?=i18n("Send")?></button>

			</form>
		</div>
	</div>
</div>
