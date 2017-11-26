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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"/>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">

	<!-- Tema opcional -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">

	<!-- Versión compilada y comprimida del JavaScript de Bootstrap -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="bootstrap.min.css"/>

	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="css/style.css" />
	<script type="text/javascript" src="js/manage.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.min.js"></script>
	<script>
		$(document).ready(function(){
      var date_input=$('input[id="fecha"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
      	format: 'yyyy/mm/dd',
      	container: container,
      	todayHighlight: true,
      	autoclose: true,
      };
      date_input.datepicker(options);
  })
</script>
</head>

<body>
	<header>
		<nav class="navbar navbar-default" role="navigation">
		<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse"
            data-target=".navbar-ex1-collapse">
      <span class="sr-only">Desplegar navegación</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="index.php?controller=login&amp;action=home"><img class="icon" src="src/BSBA.png" alt="<?=i18n("Home")?>" /></a>
  </div>
		
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<?php if (isset($_SESSION["currentuser"])): ?>
					<ul class="nav navbar-nav">
						<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"><?=i18n("Profile")?> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="index.php?controller=users&amp;action=viewcurrent&amp;dni=<?= $_SESSION['currentuser'] ?>"><?=i18n("Connected as:")?> <?= $_SESSION["currentuser"]?></a></li>
								<?php if ($_SESSION["deportista"]): ?>
									<li><a href=""><?=i18n("Notifications")?></a></li>
								<?php endif; ?>
							</ul>
						</li>
						<?php if ($_SESSION["admin"] || $_SESSION["entrenador"]): ?>
							<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown"><?=i18n("Administration")?> <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="index.php?controller=notifications&amp;action=show"><?=i18n("Notifications")?></a></li>
									<?php if ($_SESSION["admin"]): ?>
										<li><a href="index.php?controller=users&amp;action=show"><?=i18n("Users")?></a></li>
									<?php endif; ?>
								</ul>
							</li>
						<?php endif; ?>
						<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown"><?=i18n("Activities")?> <b class="caret"></b></a>
							<ul class="dropdown-menu">
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
						<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown"><?=i18n("Fitness")?> <b class="caret"></b></a>
							<ul class="dropdown-menu">
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
							<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown"><?=i18n("Statistics")?> <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="index.php?controller=athletesstatistics&amp;action=show"><?=i18n("Athletes")?></a></li>
									<li><a href="index.php?controller=activitiesstatistics&amp;action=show"><?=i18n("Activities")?></a></li>
								</ul>
							</li>
						<?php endif; ?>
						<li class="dropdown"><a class="dropdown-toggle"><?=i18n("Language")?></a>
							<ul class="dropdown-menu">
								<li><a href="index.php?controller=language&amp;action=change&amp;lang=es"><?= i18n("Spanish") ?></a></li>
								<li><a href="index.php?controller=language&amp;action=change&amp;lang=en"><?= i18n("English") ?></a></li>
							</ul>
						</li>
						<li><a id="logout" href="index.php?controller=users&amp;action=logout"><?= i18n("Logout")?></a></li>
					</ul>
					<form class="navbar-form navbar-left" role="search">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Buscar">
						</div>
						<button type="submit" class="btn btn-default">Enviar</button>
					</form>
				<?php endif ?>
			</div>
		</nav>		
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
