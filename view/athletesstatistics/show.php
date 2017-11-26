<?php
//file: view/activitiesstatistics/show.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

//$view->setLayout("welcome");
$deportists = $view->getVariable("deportists");
$view->setVariable("title", "Show deportists");
?>
<div class="col-md-12">
	<div class="col-md-4"></div>
	<div class="container">
		<div class="table-responsive col-md-4">
			<table class="table">
				<thead>
					<tr>
						<th></th>
						<th class="tittle"><?=i18n("Athletes")?></th>
						<th></th>
					</tr>
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
<div class="col-md-4"></div>
</div>
