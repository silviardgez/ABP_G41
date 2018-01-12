<?php
// file: view/users/add.php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance ();
$user = $view->getVariable ( "user" );
$view->setVariable ( "title", "Add User" );
$errors = $view->getVariable ( "errors" );
?>

<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("Add User")?></h1>
	<br>
</div>

<div id="edit-view" class="center-block col-xs-6 col-lg-4">
	<form id="edit-form" class="center-block form-horizontal"
	action="index.php?controller=users&amp;action=add" method="POST">
	<br>
	<div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Name")?>:<b class="aviso-vacio"><?= isset($errors["name"])?i18n($errors["name"]):"" ?></b></label>
		<div class="col-sm-8">
			<input class="form-control" type="text" name="nombre">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Surname")?>:<b class="aviso-vacio"><?= isset($errors["surname"])?i18n($errors["surname"]):"" ?><b></label>
		<div class="col-sm-8">
			<input class="form-control" type="text" name="apellidos">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Date Born")?>:<b class="aviso-vacio"><?= isset($errors["dateborn"])?i18n($errors["dateborn"]):"" ?></b></label>
		<div class="col-sm-8">
			<input type="date" id="date" class="form-control"
			name="fechaNac">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Email")?>:<b class="aviso-vacio"><?= isset($errors["email"])?i18n($errors["email"]):"" ?></b></label>
		<div class="col-sm-8">
			<input class="form-control" type="email" name="email">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Telephone")?>:<b class="aviso-vacio"><?= isset($errors["tlf"])?i18n($errors["tlf"]):"" ?></b></label>
		<div class="col-sm-8">
			<input class="form-control" type="text" name="tel"
			value="<?=$user->getTlf()?>">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("DNI")?>:<b class="aviso-vacio"><?= isset($errors["DNI"])?i18n($errors["DNI"]):"" ?></b></label>
		<div class="col-sm-8">
			<input class="form-control" type="text" name="dni">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Password")?>:<b class="aviso-vacio"><?= isset($errors["passwd"])?i18n($errors["passwd"]):"" ?></b></label>
		<div class="col-sm-8">
			<input class="form-control" type="password" name="pass">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Repeat Password")?>:</label>
		<div class="col-sm-8">
			<input class="form-control" type="password" name="rpass">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<div class="checkbox">
				<label class="control-label text-size text-muted col-sm-8"> <input
					type="checkbox" name="administrador" value="1"><?=i18n("Administrator")?>
				</label>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<div class="checkbox">
				<label class="control-label text-size text-muted col-sm-8"> <input
					type="checkbox" name="entrenador" value="1"><?=i18n("Coach")?>
				</label>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<div class="checkbox">
				<b class="aviso-vacio"><?= isset($errors["athlete"])?i18n($errors["athlete"]):"" ?></b>
				<label class="control-label text-size text-muted col-sm-8">
					<input type="checkbox" name="deportista_tdu" value="1"> <?=i18n("Athlete"); echo " TDU"?>
				</label>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<div class="checkbox">
				<label class="control-label text-size text-muted col-sm-8">
					<input type="checkbox" name="deportista_pef" value="1"> <?=i18n("Athlete"); echo " PEF"?>
				</label>
			</div>
		</div>
	</div>
	</br>
	<div class="form-group">
		<div class="col-sm-6">
			<button type="button" id="btn-styles" onclick="history.back()" class="btn btn-warning btn-lg"><?=i18n("Back")?></button>
		</div>
		<div class="col-sm-6">
			<button id="btn-styles" type="submit" name="submit"
			class="btn btn-success btn-lg"><?=i18n("Send")?></button>
		</div>
	</div>
</form>
</div>
