<?php
// file: view/layouts/welcome.php

$view = ViewManager::getInstance();

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
			<ul class="nav">
				<li><a href="index.php?controller=login&amp;action=home"><?= i18n("Start")?></a></li>
				<li><a><?=i18n("User")?></a>
					<ul>
						<li><a><?=i18n("Connected as:")?> <?= $_SESSION["currentuser"]?></a></li>
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
