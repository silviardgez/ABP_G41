<?php
//file: view/notifications/show.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$view->setVariable("title", "Show Notifications");
$users = $view->getVariable("users");
$activities = $view->getVariable("activities");
$id = $view->getVariable("id");
?>

<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("Notifications")?></h1>
	<br>
</div>

<div class="container-fluid">
	<div class="row features margin-rows">
		<div class="col-md-6 col-sm-6 item">
			<div class="exercise-tables-background">
				<h1 id="font-title"><?=i18n("Users")?></h1>
				<br>
				<table id="table-margin" class="table">
				<thead>
				<tr>
					<th><?=i18n("Send")?></th>
					<th><?=i18n("Surname")?></th>
					<th><?=i18n("Name")?></th>
					<th><?=i18n("DNI")?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($users as $user): ?>
						<tr>
							<td><a href="index.php?controller=notifications&amp;action=add&amp;dni=<?= $user->getUsername() ?>&amp;email=<?= $user->getEmail() ?>"><span class="fa fa-envelope-o"></span></a></td>
							<td><?= htmlentities($user->getSurname()) ?></td>
							<td><?= htmlentities($user->getName())?></td>
							<td><?= htmlentities($user->getUsername()) ?></td>
						</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<div class="col-md-6 col-sm-6 item">
	<div class="exercise-tables-background">
	<h1 id="font-title"><?=i18n("Classes")?></h1>
		<br>
		<table id="table-margin" class="table">
			<thead>
				<tr>
					<th><?=i18n("Send")?></th>
					<th><?=i18n("Name")?></th>
					<th><?=i18n("Type")?></th>
					<th><?=i18n("Day")?></th>
					<th><?=i18n("Time")?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($activities as $activity): ?>
						<tr>
							<td><a href="index.php?controller=notifications&amp;action=addGroup&amp;id=<?= $activity["ID_ACT"] ?>"><span class="fa fa-envelope-o"></span></a></td>
							<td><?= htmlentities($activity["NOMBRE"])?></td>
							<td><?= htmlentities($activity["TIPO"]) ?></td>
							<td><?= htmlentities($activity["DIA"]) ?></td>
							<td><?= htmlentities($activity["HORA_INI"])?></td>
						</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
</div>
</div>
