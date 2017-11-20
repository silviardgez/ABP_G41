<?php
//file: view/assistance/show.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

//$view->setLayout("welcome");
$activities = $view->getVariable("activities");
$view->setVariable("title", "Show Activities");
?>


<section class="pagecontent">
	<div class="users">
		<div class="margin">
			<div class="home2">
			<h1><?=i18n("Activities")?></h1><br>
				<?php foreach ($activities as $activity): ?>
					<a href="index.php?controller=assistance&amp;action=view&amp;id_act=<?= $activity->getActivityid(); ?>"><?= $activity->getActivityname(); ?></a>
					
					<a href="index.php?controller=assistance&amp;action=add&amp;id_act=<?= $activity->getActivityid(); ?>">add</a><br/>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
