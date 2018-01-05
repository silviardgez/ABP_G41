<?php
//file: view/activitiesstatistics/show.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

//$view->setLayout("welcome");
$activities = $view->getVariable("activities");
$view->setVariable("title", "Show Activities");
?>

<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("Statistics")?></h1>
	<br>
</div>

<div class="col-md-4"></div>
	<div class="row features margin-rows">
		<div class="col-md-4 col-sm-6 item">
			<div class="exercise-tables-background">
		<h1 id="font-title"><?=i18n("Activities")?></h1>
		<br>
			<table id="table-margin" class="table">
				<thead>
					<tr>
						<th><?=i18n("View statistic")?></th>
						<th><?=i18n("Day")?></th>
						<th><?=i18n("Time")?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($activities as $activity): ?>
							<tr>
								<td><?= $activity->getActivityname(); ?><a href="index.php?controller=activitiesstatistics&amp;action=view&amp;id_act=<?= $activity->getActivityid(); ?>"><i class="fa fa-search col-md-3"></i></a></td>
								<td><?= $activity->getDia(); ?></td>
								<td><?= $activity->getHorainicio(); ?></td>
							</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
	</div>
	<div class="form-group">
		<div class="col-lg-offset-6 col-lg-6">
			<button type="button" onclick="history.back()"><?=i18n("OK")?></button>
		</div>
	</div>
<div class="col-md-4"></div>
