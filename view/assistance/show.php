<?php
//file: view/assistance/show.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

//$view->setLayout("welcome");
$activities = $view->getVariable("activities");
$act = $view->getVariable("act");
$view->setVariable("title", "Show Activities");
$i = 0;
?>

<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("Assistance")?></h1>
	<br>
</div>

<div id="edit-view" class="center-block col-xs-6 col-lg-6">
		<br>
		<h1 id="font-title"><?=i18n("Activities")?></h1>
		<br>
			<table id="table-margin" class="table">
				<thead>
							<tr>
								<th><?=i18n("View assistance")?></th>
								<th><?=i18n("Day")?></th>
								<th><?=i18n("Time")?></th>
								<th></th>
							</tr>
						<thead>
						<tbody>
							<?php foreach ($activities as $activity): ?>
								<tr>
									<td><?= $activity->getActivityname(); ?><a href="index.php?controller=assistance&amp;action=view&amp;id_act=<?= $activity->getActivityid(); ?>"><i class="icons fa fa-search col-md-3"></i></a></td>
									<td><?= i18n($activity->getDia()); ?></td>
									<td><?= $activity->getHorainicio(); ?></td>
									<?php if($act[$i] == 1): ?>
										<td><a href="index.php?controller=assistance&amp;action=add&amp;id_act=<?= $activity->getActivityid(); ?>"><button id="button2" type="submit" name="submit" class="btn btn-success btn-lg"><?=i18n("Add")?></button></a></td>
									<?php else: ?>
										<td></td>
									<?php endif; ?>
								<tr>
									<?php $i = $i+1; ?>
							<?php endforeach; ?>
						</tbody>
			</table>
			<br>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<button id="btn-styles" type="button" onclick="history.back()" class="btn btn-warning btn-lg"><?=i18n("Back")?></button>
		</div>
	</div>
