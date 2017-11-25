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

<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/manage.js"></script>
<script type="text/javascript">
jQuery(function($){
	$.datepicker.regional['es'] = {
		closeText: 'Cerrar',
		prevText: '&#x3c;Ant',
		nextText: 'Sig&#x3e;',
		currentText: 'Hoy',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
		'Jul','Ago','Sep','Oct','Nov','Dic'],
		dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
		dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
		weekHeader: 'Sm',
		dateFormat: 'yy/mm/dd',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['es']);
});    
$(document).ready(function() {
   $("#datepicker").datepicker();
});
</script>
</head>

<body>
	<header>
		<?php if (isset($_SESSION["currentuser"])): ?>
				<ul class="navAdmin">
					<li><a href="index.php?controller=login&amp;action=home"><?= i18n("Home")?></a></li>
					<li><a><?=i18n("Profile")?></a>
						<ul>
							<li><a href="index.php?controller=users&amp;action=viewcurrent&amp;dni=<?= $_SESSION['currentuser'] ?>"><?=i18n("Connected as:")?> <?= $_SESSION["currentuser"]?></a></li>
							<?php if ($_SESSION["deportista"]): ?>
							<li><a href=""><?=i18n("Notifications")?></a></li>
							<?php endif; ?>
						</ul>
					</li>
					<?php if ($_SESSION["admin"] || $_SESSION["entrenador"]): ?>
					<li><a href=""><?=i18n("Administration")?></a>
						<ul>
							<li><a href="index.php?controller=notifications&amp;action=show"><?=i18n("Notifications")?></a></li>
							<?php if ($_SESSION["admin"]): ?>
							<li><a href="index.php?controller=users&amp;action=show"><?=i18n("Users")?></a></li>
							<?php endif; ?>
						</ul>
					</li>
					<?php endif; ?>
					<li><a href=""><?=i18n("Activities")?></a>
						<ul>
							<li><a href="index.php?controller=activity&amp;action=show"><?=i18n("Classes")?></a></li>
							<?php if($_SESSION["admin"]): ?>
							<li><a href="index.php?controller=book&amp;action=show"><?=i18n("Reservations")?></a></li>
							<?php endif; ?>
							<?php if($_SESSION["entrenador"]): ?>
							<li><a href="index.php?controller=assistance&amp;action=show"><?=i18n("Assistance")?></a></li>
							<?php endif; ?>
							<?php if($_SESSION["deportista"] && !$_SESSION["entrenador"]): ?>
							<li><a href="index.php?controller=activitiesstatistics&amp;action=show"><?=i18n("Statistics")?></a></li>
							<?php endif; ?>
						</ul>
					</li>
					<li><a href=""><?=i18n("Fitness")?></a>
						<ul>
							<?php if ($_SESSION["admin"] || $_SESSION["entrenador"]): ?>
							<li><a href="index.php?controller=exercises&amp;action=show"><?=i18n("Exercises")?></a></li>
							<li><a href="index.php?controller=training&amp;action=show"><?=i18n("Workouts")?></a></li>
							<?php endif; ?>
							<li><a href="index.php?controller=table&amp;action=show"><?=i18n("Tables")?></a></li>
							<?php if($_SESSION["deportista"] || $_SESSION["entrenador"]): ?>
							<li><a href="index.php?controller=sesion&amp;action=show"><?=i18n("Sessions")?></a></li>
							<?php endif; ?>

						</ul>
					</li>
					<?php if ($_SESSION["admin"] || $_SESSION["entrenador"]): ?>
					<li><a href=""><?=i18n("Statistics")?></a>
						<ul>
							<li><a href="index.php?controller=athletesstatistics&amp;action=show"><?=i18n("Athletes")?></a></li>
							<li><a href="index.php?controller=activitiesstatistics&amp;action=show"><?=i18n("Activities")?></a></li>
						</ul>
					</li>
					<?php endif; ?>
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
		<div class="flash">
		<?php $acumulador = $view->popFlash() ?>

		<?php if($acumulador != "") echo "<script>alert ('$acumulador');</script>"; ?>
			
		</div>
		<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
	</main>
	<footer>
	</footer>
</body>
</html>
