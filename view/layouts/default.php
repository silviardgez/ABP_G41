<?php
// file: view/layouts/default.php
$view = ViewManager::getInstance ();
$currentuser = $view->getVariable ( "currentusername" );

?>
<!DOCTYPE html>
<html>
<head>
<title><?= $view->getVariable("title", "WorldNote®") ?></title>
<meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
<!--<link rel="stylesheet" href="css/style.css" type="text/css">-->
<!-- Versión compilada y comprimida del CSS de Bootstrap -->
<link rel="stylesheet"
	href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">

<!-- Tema opcional -->
<link rel="stylesheet"
	href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">

<!-- Versión compilada y comprimida del JavaScript de Bootstrap -->
<script
	src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="bootstrap.min.css" />

<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="css/style.css" />
<!-- enable ji18n() javascript function to translate inside your scripts -->
<script src="index.php?controller=language&amp;action=i18njs">	</script>
<script type="text/javscript" src="js/manage.js"></script>
	<?= $view->getFragment("css")?>
	<?= $view->getFragment("javascript")?>
</head>
<body>

	<div>
		<nav class="navbar navbar-default navigation-clean-search">
			<div class="navbar-header">
				<a class="navbar-brand"> BSBASports</a>
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target=".navbar-ex1-collapse">
					<span class="sr-only">Desplegar navegación</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li role="presentation"><a href="#">Contacto</a></li>
					<li role="presentation"><a> <?= i18n("Language:") ?></a></li>
					<?php
					include (__DIR__ . "/language_select_element.php");
					?>
				</ul>
				<a class="btn btn-default navbar-btn navbar-rigth action-button"
					role="button" href="index.php?controller=users&amp;action=login"><?= i18n("Start") ?></a>
			</div>
		</nav>
	</div>

	<main>
	<div id="flash">
		<?php $acumulador = $view->popFlash()?>

		<?php if($acumulador != "") echo "<script>alert ('$acumulador');</script>"; ?>
	</div>

	<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT)?>
	</main>

	<footer> </footer>

</body>
</html>
