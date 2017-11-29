<?php
//file: view/activitiesstatistics/show.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

//$view->setLayout("welcome");
$deportists = $view->getVariable("deportists");
$view->setVariable("title", "Show deportists");
?>

<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("Statistics")?></h1>
	<br>
</div>

<div class="col-md-4"></div>
	<div class="row features margin-rows">
		<div class="col-md-4 col-sm-6 item">
			<div class="exercise-tables-background">
		<h1 id="font-title"><?=i18n("Athletes")?></h1>
		<br>
			<table id="table-margin" class="table">
				<thead>
					<tr class="active">
						<th><?=i18n("View user")?></th>
						<th></th>
						<th><?=i18n("View statistic")?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($deportists as $deportist): ?>
						<tr class="success">
							<td><a href="index.php?controller=users&amp;action=view&amp;dni=<?= $deportist->getDni(); ?>"><?= $deportist->getDni(); ?> </a></td>
							<td></td>
							<td><a href="index.php?controller=athletesstatistics&amp;action=view&amp;dni=<?= $deportist->getDni(); ?>">
								<?= $deportist->getDeportistname(); ?>									<?= $deportist->getDeportistsurname(); ?>
								</a></td>
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
