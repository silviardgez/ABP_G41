<?php
//file: view/assistance/view.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$assistances = $view->getVariable("assistances");
$view->setVariable("title", "View Assistance");
?>

<section class="pagecontent">
	<div class="users">
		<div class="margin">
			<div class="home2">
				<h1><?=i18n("Assistance")?></h1><br>
				<table>
					<tr>
						<th><?=i18n("Deportista")?></th>
						<th><?=i18n("Date")?></th>
						<th><?=i18n("Time")?></th>
					</tr>
					<?php foreach ($assistances as $assistance): ?>
						<tr>
							<td><a href="index.php?controller=users&amp;action=view&amp;dni=<?= $assistance->getDni(); ?>"><?= $assistance->getDni(); ?></a></td>
							<td><?= $assistance->getDateassistance(); ?></td>
							<td><?= $assistance->getTime(); ?></td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>
</section>
