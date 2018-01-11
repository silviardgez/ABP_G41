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

<div id="edit-view" class="center-block col-xs-6 col-lg-6">
		<br>
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
								<td><?= $activity->getActivityname(); ?><a href="index.php?controller=activitiesstatistics&amp;action=view&amp;id_act=<?= $activity->getActivityid(); ?>"><i class="icons fa fa-search col-md-3"></i> </a></td>
								<td><?= i18n($activity->getDia()) ?></td>
								<td><?= $activity->getHorainicio(); ?></td>
							</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<br/>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<button id="btn-styles" type="button" onclick="history.back()" class="btn btn-warning btn-lg"><?=i18n("Back")?></button>
		</div>
	</div>
