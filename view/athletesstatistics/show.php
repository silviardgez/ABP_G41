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
		<div class="home2">
		<h1><?=i18n("Deportists")?></h1><br>
			<?php foreach ($deportists as $deportist): ?>
				<a href="index.php?controller=users&amp;action=view&amp;dni=<?= $deportist->getDni(); ?>"><?= $deportist->getDni(); ?> </a>
				<a href="index.php?controller=athletesstatistics&amp;action=view&amp;dni=<?= $deportist->getDni(); ?>">
					<?= $deportist->getDeportistname(); ?> 
					<?= $deportist->getDeportistsurname(); ?>
				</a>
				<br/>
			<?php endforeach; ?>
		</div>
	</div>
</div>
