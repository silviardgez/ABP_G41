<?php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance ();

$view->setVariable ( "title", "Crono" );
?>
<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("Time elapsed");?></h1>
	<br>
</div>




<div class="container-fluid">
	<div id="center-view" class="center-block col-xs-11 col-sm-5 col-md-4">

		<div id="cronometro">
			<big><h1 id="crono">00:00:00</h1></big>

			<input type="button" class="btn btn-success btn-lg" value="<?= i18n("Start"); ?>" id="boton" onclick="empezarDetener(this);"  />
			<input type="button" class="btn btn-warning btn-lg" value="<?= i18n("Pause"); ?>" id="boton3" disabled="disabled" onclick="continuarPausar(this);" /><br/>
			<input type="button" class="btn btn-danger btn-lg" value="<?= i18n("End session"); ?>" id="boton2" onclick="terminarSesion(this);" /><br/>

		</div>
	</div>
	<br/>
	<input id="center-view" type="button" class="btn btn-primary btn-lg center-block col-xs-4 col-sm-2 col-md-1" value="<?= i18n("Back"); ?>" id="boton" onclick="recogeTiempo()"  />
	<!--<a id="center-view" href="index.php?controller=session&amp;action=show&amp;back=true;" class="btn btn-primary btn-lg center-block col-xs-4 col-sm-2 col-md-1" role="button"><?= i18n("Back"); ?></a>-->
</div>
<br/>

