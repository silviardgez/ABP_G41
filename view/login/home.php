<?php
//file: view/login/home.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Home");
$view->setLayout("welcome");
$errors = $view->getVariable("errors");
?>
	<div class="container">
		<div class="row features">
			<div class="col-md-4 col-sm-6 item">
				<div class="box">
					<i class="fa fa-envelope-o icon"></i>
					<h3 class="name">Contacto</h3>
					<p class="description">Pabellón Universitario</p>
					<p class="description">Campus A Lonia (Ourense)</p>
					<p class="description">Teléfono: 988 101 717</p>
					<p><a class="description" href="http://ourense.gaiagd.com/">Web: Ourense.gaiagd.com</a></p>
					<p><a class="description" href="https://www.facebook.com/aqa.orense">Facebook: AQUA Ourense</a></p>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 item">
				<div class="box">
					<i class="fa fa-university icon"></i>
					<h3 class="name">Espacios Deportivos</h3>
					<p class="description">En el Campus de Ourense las personas usuarias al Área de Bienestar, Salud y Deporte podrán utilizar una serie de instalaciones deportivas gestionadas por la UVigo:</p>
					<p class="learn-more">Pabellón Polideportivo, Sala cardio-fitness,</p>
					<p class="learn-more">Área de tenis de mesa, Pistas de tenis,</p>
					<p class="learn-more">Campo de hierba artificial, Pista de Atletismo y AQUA.</p>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 item">
				<div class="box">
					<i class="fa fa-calendar icon"></i>
					<h3 class="name">Horarios</h3>
					<p class="description">Septiembre a Junio: De lunes a viernes de 08:30 a 23:30. Sábados y domingos de 10:00 a 14:00 y de 16:00 a 21:00.</p>
					<p class="description">Julio, Semana Santa y Navidad: De lunes a viernes de 09:00 a 21:00. Sábados y domingos de 10:00 a 14:00 y de 16:00 a 21:00.</p>
					<p class="description">Agosto: De lunes a viernes de 09:00 a 20:30. Sábados y domingos: Cerrado.</p>
				</div>
			</div>
		</div>
	</div>


<?php $view->moveToFragment("css");?>
<link rel="stylesheet" type="text/css" src="css/style.css">
<?php $view->moveToDefaultFragment(); ?>
