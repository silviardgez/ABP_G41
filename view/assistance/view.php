<?php
//file: view/assistance/view.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$assistances = $view->getVariable("assistances");
$view->setVariable("title", "View Assistance");
?>

<div class="col-md-12">
	<div class="col-md-4"></div>
		<div class="container">
			<div class="table-responsive col-md-4">
				<table class="table">
					<thead>
						<tr>
							<th></th>
							<th class="tittle"><?=i18n("Assistance")?></th>
							<th></th>
							<th></th>
						</tr>
						<tr class="active">
							<th><?=i18n("Athlete")?></th>
							<th><?=i18n("Date")?></th>
							<th><?=i18n("Time")?></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($assistances as $assistance): ?>
							<tr class="success">
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
					</tbody>
				</table>
			</div>
		</div>
	<div class="col-md-4"></div>
</div>