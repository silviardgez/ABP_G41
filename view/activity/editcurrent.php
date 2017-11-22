<?php
//file: view/users/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$activity = $view->getVariable("activity");
$coaches = $view->getVariable("monitors");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Edit Current Activity");

?>

<div class="recuadro">
	<div id="formulario">
		<div class="home2">
			<form action="index.php?controller=activity&amp;action=editcurrent" method="POST">
				<input type="hidden" name="id" value="<?=$activity->getActivityId()?>">
				<!--<br><?=i18n("Name")?>:<?= isset($errors["name"])?i18n($errors["name"]):"" ?><input type="text" name="name" value="<?=$activity->getActivityName()?>"> -->
				<br><?=i18n("Start Time")?>:<?= isset($errors["startTime"])?i18n($errors["startTime"]):"" ?>
				<input type="time" name="startTime" value="<?=$activity->getStartTime()?>">
				<br><?=i18n("End Time")?>:<?= isset($errors["endTime"])?i18n($errors["endTime"]):"" ?>
				<input type="time" name="endTime" value="<?=$activity->getEndTime()?>">
				<br><?=i18n("Day")?>:<?= isset($errors["day"])?i18n($errors["day"]):"" ?>
				<select name="day">
					<option value="LUNES"><?=i18n("MONDAY")?></option>
					<option value="MARTES"><?=i18n("TUESDAY")?></option>
					<option value="MIERCOLES"><?=i18n("WEDNESDAY")?></option>
					<option value="JUEVES"><?=i18n("THURSDAY")?></option>
					<option value="VIERNES"><?=i18n("FRIDAY")?></option>
					<option value="SABADO"><?=i18n("SATURDAY")?></option>
					<option value="DOMINGO"><?=i18n("SUNDAY")?></option>
					<option value="<?=$activity->getDay()?>" selected="selected"><?=i18n($activity->getDay())?></option>
				</select>
				<br><?=i18n("Monitor")?>:<?= isset($errors["monitor"])?i18n($errors["monitor"]):"" ?>
				<select name="monitor">
					<?php foreach ($coaches as $coach => $coachName): ?> 
					 	<option value="<?=$coach?>"><?=$coachName?></option>
					<?php endforeach; ?>
					<option value="<?=$activity->getMonitor()?>" selected="selected"><?=$activity->getMonitorName()?></option>
				</select>
				<button type="submit" name="submit"><?=i18n("Send")?></button>

			</form>
		</div>
	</div>
</div>
