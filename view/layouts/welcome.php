<?php
// file: view/layouts/welcome.php

$view = ViewManager::getInstance();
$type = $view->getVariable("type2"); 

?><!DOCTYPE html>
<html>
<head>
	<title><?= $view->getVariable("title", "no title") ?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<?= $view->getFragment("css") ?>
	<?= $view->getFragment("javascript") ?>
</head>

<body>
	<header>
		<?php if (isset($_SESSION["currentuser"])): ?>
			<?php if ($type == "admin"): ?>
				<ul class="navAdmin">
					<li><a href="index.php?controller=login&amp;action=home"><?= i18n("Start")?></a></li>
					<li><a><?=i18n("User")?></a>
						<ul>
							<li><a><?=i18n("Connected as:")?> <?= $_SESSION["currentuser"]?></a></li>
						</ul>
					</li>
					<li><a href=""><?=i18n("Administration")?></a>
						<ul>
							<li><a href=""><?=i18n("Notifications")?></a></li>
							<li><a href=""><?=i18n("Users")?></a></li>
						</ul>
					</li>
					<li><a href=""><?=i18n("Statistics")?></a>
						<ul>
							<li><a href=""><?=i18n("Athletes")?></a></li>
							<li><a href=""><?=i18n("Activities")?></a></li>
						</ul>
					</li>
					<li><a href=""><?=i18n("Fitness")?></a>
						<ul>
							<li><a href=""><?=i18n("Activities")?></a></li>
							<li><a href=""><?=i18n("Reservations")?></a></li>
							<li><a href=""><?=i18n("Assistance")?></a></li>
						</ul>
					</li>
					<li><a href=""><?=i18n("Activities")?></a>
						<ul>
							<li><a href=""><?=i18n("Exercises")?></a></li>
							<li><a href=""><?=i18n("Workouts")?></a></li>
							<li><a href=""><?=i18n("Tables")?></a></li>
						</ul>
					</li>
					<li><a><?=i18n("Language")?></a>
						<ul>
							<li><a href="index.php?controller=language&amp;action=change&amp;lang=es"><?= i18n("Spanish") ?></a></li>
							<li><a href="index.php?controller=language&amp;action=change&amp;lang=en"><?= i18n("English") ?></a></li>
						</ul>
					</li>
					<li><a id="logout" href="index.php?controller=users&amp;action=logout"><?= i18n("Logout")?></a></li>
				</ul>
			<?php endif ?>
			<?php if ($type == "entrenador"): ?>
				<ul class="navEn">
					<li><a href="index.php?controller=login&amp;action=home"><?= i18n("Start")?></a></li>
					<li><a><?=i18n("User")?></a>
						<ul>
							<li><a><?=i18n("Connected as:")?> <?= $_SESSION["currentuser"]?></a></li>
						</ul>
					</li>
					<li><a href=""><?=i18n("Statistics")?></a>
						<ul>
							<li><a href=""><?=i18n("Athletes")?></a></li>
							<li><a href=""><?=i18n("Activities")?></a></li>
						</ul>
					</li>
					<li><a href=""><?=i18n("Fitness")?></a>
						<ul>
							<li><a href=""><?=i18n("Activities")?></a></li>
							<li><a href=""><?=i18n("Reservations")?></a></li>
							<li><a href=""><?=i18n("Assistance")?></a></li>
						</ul>
					</li>
					<li><a href=""><?=i18n("Activities")?></a>
						<ul>
							<li><a href=""><?=i18n("Exercises")?></a></li>
							<li><a href=""><?=i18n("Workouts")?></a></li>
							<li><a href=""><?=i18n("Tables")?></a></li>
						</ul>
					</li>
					<li><a><?=i18n("Language")?></a>
						<ul>
							<li><a href="index.php?controller=language&amp;action=change&amp;lang=es"><?= i18n("Spanish") ?></a></li>
							<li><a href="index.php?controller=language&amp;action=change&amp;lang=en"><?= i18n("English") ?></a></li>
						</ul>
					</li>
					<li><a id="logout" href="index.php?controller=users&amp;action=logout"><?= i18n("Logout")?></a></li>
				</ul>
			<?php endif ?>
			<?php if ($type == "deportista"): ?>
				<ul class="navDep">
					<li><a href="index.php?controller=login&amp;action=home"><?= i18n("Start")?></a></li>
					<li><a><?=i18n("Profile")?></a>
						<ul>
							<li><a><?=i18n("Connected as:")?> <?= $_SESSION["currentuser"]?></a></li>
							<li><a href=""><?=i18n("Notifications")?></a></li>
							<li><a href=""><?=i18n("Sesions")?></a></li>
						</ul>
					</li>
					<li><a href=""><?=i18n("Workouts")?></a></li>
					<li><a href=""><?=i18n("Exercises")?></a></li>
					<li><a href=""><?=i18n("Tables")?></a></li>
					<li><a href=""><?=i18n("Services")?></a></li>
					<li><a><?=i18n("Language")?></a>
						<ul>
							<li><a href="index.php?controller=language&amp;action=change&amp;lang=es"><?= i18n("Spanish") ?></a></li>
							<li><a href="index.php?controller=language&amp;action=change&amp;lang=en"><?= i18n("English") ?></a></li>
						</ul>
					</li>
					<li><a id="logout" href="index.php?controller=users&amp;action=logout"><?= i18n("Logout")?></a></li>
				</ul>
			<?php endif ?>
		<?php endif ?>
	</header>
	<main>
		<!-- flash message -->
		<div id="flash">
			<?= $view->popFlash() ?>
		</div>
		<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
	</main>
	<footer>
	</footer>
</body>
</html>
