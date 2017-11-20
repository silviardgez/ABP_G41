<?php
//file: view/users/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$activity = $view->getVariable("activity");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Edit Activity");

?>

<div class="recuadro">
	<div id="formulario">
		<div class="home2">
			<form action="index.php?controller=activity&amp;action=edit" method="POST">
				<br><?=i18n("Color")?>:<?= isset($errors["color"])?i18n($errors["color"]):"" ?>
				<input type="color" name="color" value="<?=$activity->getColor()?>">
				<br><br><br>
				<!--<select name="tipo">
					<option value="LUNES" selected="selected"><?=i18n("Monday")?></option>
					<option value="MARTES"><?=i18n("Tuesday")?></option>
					<option value="MIERCOLES"><?=i18n("Wednesday")?></option>
					<option value="JUEVES"><?=i18n("Thursday")?></option>
					<option value="VIERNES"><?=i18n("Friday")?></option>
					<option value="SABADO"><?=i18n("Saturday")?></option>
					<option value="DOMINGO"><?=i18n("Sunday")?></option>
				</select>
				<br><?=i18n("Day")?>:<?= isset($errors["day"])?i18n($errors["day"]):"" ?>
				<input id="time" type="time" value="<?=$activity->getStartTime()?>">-->


				<button type="submit" name="submit"><?=i18n("Send")?></button>

			</form>
		</div>
	</div>
</div>
