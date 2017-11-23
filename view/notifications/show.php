<?php
//file: view/notifications/show.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$view->setVariable("title", "Show Notifications");
$users = $view->getVariable("users");
$activities = $view->getVariable("activities");
$id = $view->getVariable("id");
?>

<div class="users">
	<div class="margin">
		<div class="home2">
			<h1><?=i18n("Users")?></h1><br>
			<?php foreach ($users as $user): ?>

				<a href="index.php?controller=notifications&amp;action=add&amp;dni=<?= $user->getUsername() ?>&amp;email=<?= $user->getEmail() ?>"><?= htmlentities($user->getName()); echo ' '.htmlentities($user->getSurname()) ?></a><br><br>

			<?php endforeach; ?>
		</div>
	</div>

	<div class="margin">
		<div class="home2">
			<h1><?=i18n("Classes")?></h1><br>
			<?php foreach ($activities as $activity): ?>

				<a href="index.php?controller=notifications&amp;action=addGroup&amp;id=<?= $activity["ID_ACT"] ?>"><?= htmlentities($activity["NOMBRE"]);?></a><br><br>

			<?php endforeach; ?>
		</div>
	</div>

</div>


