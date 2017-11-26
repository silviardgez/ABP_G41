<?php
//file: view/users/add.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$user = $view->getVariable("user");
$view->setVariable("title", "Add User");
$errors = $view->getVariable("errors");
?>
	<h1>Añadir Usuario</h1>
	<form action="index.php?controller=users&amp;action=edit" method="POST" class="form-horizontal col-md-12" >
	  <br><div class="form-group">
	    <label class="col-lg-6 control-label"><?=i18n("Name")?>:<?= isset($errors["name"])?i18n($errors["name"]):"" ?></label>
	    <div class="col-lg-6">
	      <input type="text" name="nombre">
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-lg-6 control-label"><?=i18n("Surname")?>:<?= isset($errors["surname"])?i18n($errors["surname"]):"" ?></label>
	    <div class="col-lg-6">
	      <input type="text" name="apellidos">
	    </div>
	  </div>
		<div class="form-group">
	    <label class="col-lg-6 control-label"><?=i18n("Date Born")?>:<?= isset($errors["dateborn"])?i18n($errors["dateborn"]):"" ?></label>
	    <div class="col-lg-6">
	      <input type="text" id="datepicker" name="fechaNac">
	    </div>
	  </div>
		<div class="form-group">
	    <label class="col-lg-6 control-label"><?=i18n("Email")?>:<?= isset($errors["email"])?i18n($errors["email"]):"" ?></label>
	    <div class="col-lg-6">
	      <input type="email" name="email">
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
	    	<input type="text" name="dni">
	    </div>
	  </div>
		<div class="form-group">
	    <label class="col-lg-6 control-label"><?=i18n("Password")?>:<?= isset($errors["passwd"])?i18n($errors["passwd"]):"" ?></label>
	    <div class="col-lg-6">
	    	<input type="password" name="pass">
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
	      <div class="checkbox">
	        <label>
	          	<input type="checkbox" name="administrador" value="1"><?=i18n("Administrator")?>
	        </label>
	      </div>
	    </div>
	  </div>
		<div class="form-group">
	    <div class="col-lg-offset-6 col-lg-6">
	      <div class="checkbox">
	        <label>
	          	<input type="checkbox" name="entrenador" value="1"><?=i18n("Coach")?>
	        </label>
	      </div>
	    </div>
	  </div>
		<div class="form-group">
	    <div class="col-lg-offset-6 col-lg-6">
	      <div class="checkbox">
	        <label>
	          	<input type="checkbox" name="deportista" value="1"> <?=i18n("Athlete")?>
	        </label>
	      </div>
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-lg-offset-6 col-lg-6">
	      <button type="submit" name="submit" class="btn btn-default"><?=i18n("Send")?></button>
	    </div>
	  </div>
	</form>
