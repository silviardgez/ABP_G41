<?php
//file: view/activitiesstatistics/show.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

//$view->setLayout("welcome");
$deportists = $view->getVariable("deportists");
$view->setVariable("title", "Show deportists");
?>

<section class="pagecontent full-width">
	<div class="users">
		<div class="home2 title-style">
			<h1><?=i18n("Athlete")?></h1><br>
		</div>
		<div class="home2 bloques">
				<table class="full-width">
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
<section class="pagecontent full-width">