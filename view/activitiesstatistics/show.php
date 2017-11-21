<?php
//file: view/activitiesstatistics/show.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

//$view->setLayout("welcome");
$activities = $view->getVariable("activities");
$view->setVariable("title", "Show Activities");
?>

<div class="users">
	<div class="margin">
		<h1><?=i18n("Activities")?></h1><br>
		<table>
			<tr>
				<th><?=i18n("Name")?></th>
				<th><?=i18n("Day")?></th>
				<th><?=i18n("Time")?></th>
			</tr>
			<?php foreach ($activities as $activity): ?>
				<tr>
					<td><a href="index.php?controller=activitiesstatistics&amp;action=view&amp;id_act=<?= $activity->getActivityid(); ?>"><?= $activity->getActivityname(); ?></a></td>
					<td><?= $activity->getDia(); ?></td>
					<td><?= $activity->getHorainicio(); ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>
