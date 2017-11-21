<?php
//file: view/activitiesstatistics/show.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

//$view->setLayout("welcome");
$deportists = $view->getVariable("deportists");
$view->setVariable("title", "Show deportists");
?>

<div class="users">
	<div class="margin">
		<h1><?=i18n("Deportists")?></h1><br>
			<table>
				<tr>
					<th><?=i18n("View user")?></th>
					<th><?=i18n("View statistic")?></th>
				</tr>
				<?php foreach ($deportists as $deportist): ?>
				
					<tr>
						<td><a href="index.php?controller=users&amp;action=view&amp;dni=<?= $deportist->getDni(); ?>"><?= $deportist->getDni(); ?> </a></td>
						<td><a href="index.php?controller=athletesstatistics&amp;action=view&amp;dni=<?= $deportist->getDni(); ?>">
								<?= $deportist->getDeportistname(); ?> 
								<?= $deportist->getDeportistsurname(); ?>
							</a>
						</td>
					<tr/>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
</div>
