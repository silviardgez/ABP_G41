<?php
//file: view/users/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$coaches = $view->getVariable("monitors");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Add Activity");

?>

<div class="recuadro">
	<div id="formulario">
		<div class="home2">
			<form action="index.php?controller=activity&amp;action=add" method="POST">
				<br><?=i18n("Name")?>:<?= isset($errors["name"])?i18n($errors["name"]):"" ?>
				<input type="text" name="name">
				<br><?=i18n("Start Time")?>:
				<input type="time" name="startTime">
				<br><?=i18n("End Time")?>:
				<input type="time" name="endTime">
				<br><?=i18n("Day")?>:
				<select name="day">
					<option value="LUNES"><?=i18n("MONDAY")?></option>
					<option value="MARTES"><?=i18n("TUESDAY")?></option>
					<option value="MIERCOLES"><?=i18n("WEDNESDAY")?></option>
					<option value="JUEVES"><?=i18n("THURSDAY")?></option>
					<option value="VIERNES"><?=i18n("FRIDAY")?></option>
					<option value="SABADO"><?=i18n("SATURDAY")?></option>
					<option value="DOMINGO"><?=i18n("SUNDAY")?></option>
				</select>
				<br><?=i18n("Monitor")?>:<?= isset($errors["monitor"])?i18n($errors["monitor"]):"" ?>
				<select name="monitor">
					<?php foreach ($coaches as $coach => $coachName): ?> 
					 	<option value="<?=$coach?>"><?=$coachName?></option>
					<?php endforeach; ?>
				</select>
				<br><?=i18n("Color")?>:
				<input type="color" name="color">
				<br><br>
				<button type="submit" name="submit"><?=i18n("Send")?></button>

			</form>
		</div>
	</div>
</div>
