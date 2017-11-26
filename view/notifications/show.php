<?php
//file: view/notifications/show.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$view->setVariable("title", "Show Notifications");
$users = $view->getVariable("users");
$activities = $view->getVariable("activities");
$id = $view->getVariable("id");
?>

<div class="container">
	<div class="table-responsive col-md-6">
		<table class="table">
			<thead>
				<tr>
					<th></th>
					<th class="tittle"><?=i18n("Users")?></th>
					<th></th>
				</tr>
				<tr class="active">
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
	<div class="table-responsive col-md-6">
		<table class="table">
			<thead>
				<tr>
					<th></th>
					<th class="tittle"><?=i18n("Classes")?></th>
					<th></th>
				</tr>
				<tr class="active">
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
