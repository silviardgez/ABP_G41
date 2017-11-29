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
					<th><?=i18n("Name")?></th>
					<th><?=i18n("Surname")?></th>
					<th><?=i18n("DNI")?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($users as $user): ?>
						<tr class="success">
							<td><a href="index.php?controller=notifications&amp;action=add&amp;dni=<?= $user->getUsername() ?>&amp;email=<?= $user->getEmail() ?>"><?= htmlentities($user->getName())?></a></td>
							<td><?= htmlentities($user->getSurname()) ?></td>
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
					<th><?=i18n("Name")?></th>
					<th><?=i18n("Type")?></th>
					<th><?=i18n("Day")?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($activities as $activity): ?>
						<tr class="success">
							<td><a href="index.php?controller=notifications&amp;action=addGroup&amp;id=<?= $activity["ID_ACT"] ?>"><?= htmlentities($activity["NOMBRE"])?></a></td>
							<td><?= htmlentities($activity["TIPO"]) ?></td>
							<td><?= htmlentities($activity["DIA"]) ?></td>
						</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
</div>
</div>
