<?php
//file: view/assistance/show.php

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
					<th><?=i18n("View assistance")?></th>
					<th><?=i18n("Day")?></th>
					<th><?=i18n("Time")?></th>
					<th></th>
				</tr>
				<?php foreach ($activities as $activity): ?>
					<tr>
						<td><a href="index.php?controller=assistance&amp;action=view&amp;id_act=<?= $activity->getActivityid(); ?>"><?= $activity->getActivityname(); ?></a></td>
						<td><?= $activity->getDia(); ?></td>
						<td><?= $activity->getHorainicio(); ?></td>
							<td><a href="index.php?controller=assistance&amp;action=add&amp;id_act=<?= $activity->getActivityid(); ?>"><button id="button2" type="submit" name="submit"><?=i18n("Add")?></button></a></td>
					<tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
</section>
