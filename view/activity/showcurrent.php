<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$activity = $view->getVariable("activity");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Show Current Activity");

?>

<div class="recuadro">
	<div id="formulario">
		<div class="home2">
			<form action="index.php?controller=activity&amp;action=edit" method="POST">
				<br><?=i18n("Name")?>:<?= isset($errors["name"])?i18n($errors["name"]):"" ?>
				<input type="text" name="name" value="<?=$activity->getActivityName()?>" readonly> 
				<br><?=i18n("Day")?>:<?= isset($errors["day"])?i18n($errors["day"]):"" ?>
				<select name="tipo" disabled="disabled">
					<option value="<?= $activity->getDay()?>" selected="selected" readonly><?=i18n($activity->getDay())?></option>
				</select>
				<br><?=i18n("Start Time")?>:<?= isset($errors["startTime"])?i18n($errors["startTime"]):"" ?>
				<input id="time" type="time" value="<?=$activity->getStartTime()?>" readonly>
				<br><?=i18n("End Time")?>:<?= isset($errors["endTime"])?i18n($errors["endTime"]):"" ?>
				<input id="time" type="time" value="<?=$activity->getEndTime()?>" readonly>

				<div class="icons" style="width: 100%">
					<form
					method="POST"
					action="index.php?controller=activity&amp;action=deletecurrent"
					id="delete_activity_<?= $activity->getActivityId(); ?>"
					style="display: inline"
					>

					<input type="hidden" name="id" value="<?= $activity->getActivityId() ?>">

					<a onclick="if (confirm('<?= i18n("are you sure?")?>')) {
						document.getElementById('delete_activity_<?= $activity->getActivityId() ?>').submit()
					}"><i class="fa fa-trash" style="margin-right: 12px; margin-bottom: : 10px"></i></a>

				</form>
				<a href="index.php?controller=activity&amp;action=editcurrent&amp;id=<?= $activity->getActivityId() ?>"><i class="fa fa-pencil-square-o"></i></a>
			</div>
		</form>
	</div>
</div>
</div>
