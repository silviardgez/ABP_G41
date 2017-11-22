<?php
//file: view/activitiesstatistics/show.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

//$view->setLayout("welcome");
$activities = $view->getVariable("activities");
$view->setVariable("title", "Show Activities");
?>

<section class="pagecontent full-width">
	<div class="users">
		<div class="home2 title-style">
			<h1><?=i18n("Activities")?></h1><br>
		</div>
		<div class="home2 bloques">
			<table class="full-width">
				<tr>
					<th><?=i18n("View statistic")?></th>
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
</section>