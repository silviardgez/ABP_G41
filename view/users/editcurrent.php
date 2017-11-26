<?php
//file: view/users/editcurrent.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$user = $view->getVariable("user");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Edit Currentuser");
?>

<h1>Modificar Perfil</h1>
<form action="index.php?controller=users&amp;action=editcurrent" method="POST" class="form-horizontal col-md-12" >
  <br><div class="form-group">
    <label class="col-lg-6 control-label"><?=i18n("Name")?>:<?= isset($errors["name"])?i18n($errors["name"]):"" ?></label>
    <div class="col-lg-6">
      <input type="text" name="nombre" value="<?=$user->getName()?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-6 control-label"><?=i18n("Surname")?>:<?= isset($errors["surname"])?i18n($errors["surname"]):"" ?></label>
    <div class="col-lg-6">
      <input type="text" name="apellidos" value="<?=$user->getSurname()?>">
    </div>
  </div>
	<div class="form-group">
    <label class="col-lg-6 control-label"><?=i18n("Date Born")?>:<?= isset($errors["dateborn"])?i18n($errors["dateborn"]):"" ?></label>
    <div class="col-lg-6">
      <input type="text" id="fecha" name="fechaNac" value="<?=$user->getDateBorn()?>">
    </div>
  </div>
	<div class="form-group">
    <label class="col-lg-6 control-label"><?=i18n("Email")?>:<?= isset($errors["email"])?i18n($errors["email"]):"" ?></label>
    <div class="col-lg-6">
      <input type="email" name="email" value="<?=$user->getEmail()?>">
    </div>
  </div>
	<div class="form-group">
    <label class="col-lg-6 control-label"><?=i18n("Telephone")?>:<?= isset($errors["tlf"])?i18n($errors["tlf"]):"" ?></label>
    <div class="col-lg-6">
      <input type="text" name="tel" value="<?=$user->getTlf()?>">
    </div>
  </div>
	<div class="form-group">
    <label class="col-lg-6 control-label"><?=i18n("DNI")?>:<?= isset($errors["DNI"])?i18n($errors["DNI"]):"" ?></label>
    <div class="col-lg-6">
    	<input type="text" name="dni" value="<?=$user->getUsername()?>" readonly="readonly">
    </div>
  </div>
	<div class="form-group">
		<label class="col-lg-6 control-label"><?=i18n("Password")?>:<?= isset($errors["oldpasswd"])?i18n($errors["oldpasswd"]):"" ?></label>
		<div class="col-lg-6">
			<input type="password" name="pass">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-6 control-label"><?=i18n("New Password")?>:<?= isset($errors["passwd"])?i18n($errors["passwd"]):"" ?></label>
		<div class="col-lg-6">
			<input type="password" name="newpass">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-6 control-label"><?=i18n("Repeat Password")?>:</label>
		<div class="col-lg-6">
			<input type="password" name="rpass">
		</div>
	</div>
  <div class="form-group">
    <div class="col-lg-offset-6 col-lg-6">
			<button type="button" onclick="history.back()"><?=i18n("Back")?></button>
			<button type="submit" name="submit"><?=i18n("Send")?></button>
    </div>
  </div>
</form>
