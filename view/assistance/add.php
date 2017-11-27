<?php
//file: view/assistance/view.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$assistants = $view->getVariable("assistants");
$assistance = $view->getVariable("assistance");

$view->setVariable("title", "Add Assistance");
?>

<div class="col-md-12">
	<div class="col-md-4"></div>
		<div class="container">
			<div class="table-responsive col-md-5">
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
						<?php foreach ($assistants as $assistant): ?>
							<tr class="success">
								<form action="index.php?controller=assistance&amp;action=add&amp;id_act=<?= $assistance->getActivityid(); ?>" method="POST">
									<input type="hidden" name="id_act" value="<?= $assistance->getActivityid(); ?>">
									<input type="hidden" name="asistente" value="<?= $assistant->getDni(); ?>">
									<td><a href="index.php?controller=users&amp;action=view&amp;dni=<?= $assistant->getDni(); ?>"><?= $assistant->getDni(); ?> </a></td>
									<td><input type="date" id="fecha" name="fecha"></td>
									<td><input type="time" id="hora" name="hora"></td>
									
									<td><button id="button2" type="submit" name="submit"><?=i18n("Add")?></button></td>
								</form>
							</tr>
						<?php endforeach; ?>
			</table>
		</div>
	</div>
</div>