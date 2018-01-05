<?php
//file: view/assistance/view.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$assistances = $view->getVariable("assistances");
$view->setVariable("title", "View Assistance");
?>

<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("Assistance")?></h1>
	<br>
</div>

<div class="col-md-4"></div>
	<div class="row features margin-rows">
		<div class="col-md-5 col-sm-6 item">
			<div class="exercise-tables-background">
		<h1 id="font-title"><?=i18n("Activity assistance")?></h1>
		<br>
			<table id="table-margin" class="table">
				<thead>
					<tr class="active">
							<th><?=i18n("Athlete")?></th>
							<th><?=i18n("Date")?></th>
							<th><?=i18n("Time")?></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($assistances as $assistance): ?>
							<tr>
								<td><?= $assistance->getDni(); ?><a href="index.php?controller=users&amp;action=view&amp;dni=<?= $assistance->getDni(); ?>"><i class="fa fa-search col-md-3"></i></a></td>
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
	</div>
	<div class="form-group">
		<div class="col-lg-offset-6 col-lg-6">
			<button type="button" onclick="history.back()"><?=i18n("OK")?></button>
		</div>
	</div>
<div class="col-md-4"></div>