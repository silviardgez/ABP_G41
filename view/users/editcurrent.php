<?php
//file: view/users/editcurrent.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$user = $view->getVariable("user");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Edit Currentuser");
?>

<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("Edit Profile")?></h1>
	<br>
</div>

<div id="edit-view" class="center-block col-xs-6 col-lg-4">
<form action="index.php?controller=users&amp;action=editcurrent" method="POST" class="center-block form-horizontal">
  <br><div class="form-group">
    <label class="control-label text-size text-muted col-sm-4"><?=i18n("Name")?>:<?= isset($errors["name"])?i18n($errors["name"]):"" ?></label>
    <div class="col-lg-6">
      <input type="text" name="nombre" value="<?=$user->getName()?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label text-size text-muted col-sm-4"><?=i18n("Surname")?>:<?= isset($errors["surname"])?i18n($errors["surname"]):"" ?></label>
    <div class="col-lg-6">
      <input type="text" name="apellidos" value="<?=$user->getSurname()?>">
    </div>
  </div>
	<div class="form-group">
    <label class="control-label text-size text-muted col-sm-4"><?=i18n("Date Born")?>:<?= isset($errors["dateborn"])?i18n($errors["dateborn"]):"" ?></label>
    <div class="col-lg-6">
      <input type="text" id="fecha" name="fechaNac" value="<?=$user->getDateBorn()?>">
    </div>
  </div>
	<div class="form-group">
    <label class="control-label text-size text-muted col-sm-4"><?=i18n("Email")?>:<?= isset($errors["email"])?i18n($errors["email"]):"" ?></label>
    <div class="col-lg-6">
      <input type="email" name="email" value="<?=$user->getEmail()?>">
    </div>
  </div>
	<div class="form-group">
    <label class="control-label text-size text-muted col-sm-4"><?=i18n("Telephone")?>:<?= isset($errors["tlf"])?i18n($errors["tlf"]):"" ?></label>
    <div class="col-lg-6">
      <input type="text" name="tel" value="<?=$user->getTlf()?>">
    </div>
  </div>
	<div class="form-group">
    <label class="control-label text-size text-muted col-sm-4"><?=i18n("DNI")?>:<?= isset($errors["DNI"])?i18n($errors["DNI"]):"" ?></label>
    <div class="col-lg-6">
    	<input type="text" name="dni" value="<?=$user->getUsername()?>" readonly="readonly">
    </div>
  </div>
	<div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Password")?>:<?= isset($errors["oldpasswd"])?i18n($errors["oldpasswd"]):"" ?></label>
		<div class="col-lg-6">
			<input type="password" name="pass">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("New Password")?>:<?= isset($errors["passwd"])?i18n($errors["passwd"]):"" ?></label>
		<div class="col-lg-6">
			<input type="password" name="newpass">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label text-size text-muted col-sm-4"><?=i18n("Repeat Password")?>:</label>
		<div class="col-lg-6">
			<input type="password" name="rpass">
		</div>
	</div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="col-md-6">
        <button type="button" id="btn-styles" onclick="history.back()" class="btn btn-success btn-lg"><?=i18n("Back")?></button>
      </div>
      <div class="col-md-6">
        <button id="btn-styles" type="submit" name="submit" class="btn btn-success btn-lg"><?=i18n("Send")?></button>
      </div>
    </div>
  </div>
</form>
</div>
