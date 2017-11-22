<?php
//file: view/assistance/view.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$assistances = $view->getVariable("assistances");
$view->setVariable("title", "View Assistance");
?>

<section class="pagecontent full-width">
	<div class="users">
		<div class="home2 title-style">
			<h1><?=i18n("Assistance")?></h1><br/>
		</div>
		<div class="home2 bloques">
			<table class="full-width">
				<tr>
					<th><?=i18n("Deportista")?></th>
					<th><?=i18n("Date")?></th>
					<th><?=i18n("Time")?></th>
					<th></th>
				</tr>
				<?php foreach ($assistances as $assistance): ?>
					<tr>
						<td><a href="index.php?controller=users&amp;action=view&amp;dni=<?= $assistance->getDni(); ?>"><?= $assistance->getDni(); ?></a></td>
						<td><?= $assistance->getDateassistance(); ?></td>
						<td><?= $assistance->getTime(); ?></td>
						<td><form method="POST" action="index.php?controller=assistance&amp;action=delete" id="delete_user_<?= $assistance->getDni(); ?>" style="display: inline">
								<input type="hidden" name="dni" value="<?= $assistance->getDni() ?>">
								<input type="hidden" name="date" value="<?= $assistance->getDateassistance() ?>">
								<input type="hidden" name="time" value="<?= $assistance->getTime() ?>">

								<a onclick="if (confirm('<?= i18n("are you sure?")?>')) {
									document.getElementById('delete_user_<?= $assistance->getDni() ?>').submit()
								}"><i class="fa fa-trash"></i></a>
							</form>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
</section>