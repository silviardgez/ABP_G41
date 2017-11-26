<?php
//file: view/assistance/show.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

//$view->setLayout("welcome");
$activities = $view->getVariable("activities");
$view->setVariable("title", "Show Activities");
?>

<div class="col-md-12">
	<div class="col-md-4"></div>
		<div class="container">
			<div class="table-responsive col-md-4">
					<table class="table">
						<thead>
							<tr>
								<th></th>
								<th class="tittle"><?=i18n("Activities")?></th>
								<th></th>
								<th></th>
							</tr>
							<tr class="active">
								<th><?=i18n("View assistance")?></th>
								<th><?=i18n("Day")?></th>
								<th><?=i18n("Time")?></th>
								<th></th>
							</tr>
						<thead>
						<tbody>
							<?php foreach ($activities as $activity): ?>
								<tr class="success">
									<td><a href="index.php?controller=assistance&amp;action=view&amp;id_act=<?= $activity->getActivityid(); ?>"><?= $activity->getActivityname(); ?></a></td>
									<td><?= $activity->getDia(); ?></td>
									<td><?= $activity->getHorainicio(); ?></td>
									<td><a href="index.php?controller=assistance&amp;action=add&amp;id_act=<?= $activity->getActivityid(); ?>"><button id="button2" type="submit" name="submit"><?=i18n("Add")?></button></a></td>
								<tr>
							<?php endforeach; ?>
						</tbody>
					</table>
			</div>
		</div>
	<div class="col-md-4"></div>
</div>
