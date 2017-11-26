<?php
//file: view/users/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$user = $view->getVariable("user");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Edit User");

?>

<h1>Modificar Usuario</h1>
<form action="index.php?controller=users&amp;action=edit" method="POST" class="form-horizontal col-md-12" >
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
    <div class="col-lg-offset-6 col-lg-6">
      <div class="checkbox">
        <label>
					<?php if($user->getAdmin() == 1){ ?>
          	<input type="checkbox" name="administrador" value="1" checked="checked"> <?=i18n("Administrator")?>
						<?php }else{ ?>
							<input type="checkbox" name="administrador" value="1"> <?=i18n("Administrator")?>
							<?php }?>
        </label>
      </div>
    </div>
  </div>
	<div class="form-group">
    <div class="col-lg-offset-6 col-lg-6">
      <div class="checkbox">
        <label>
					<?php if($user->getCoach() == 1){ ?>
          	<input type="checkbox" name="entrenador" value="1" checked="checked"> <?=i18n("Coach")?>
						<?php }else{ ?>
							<input type="checkbox" name="entrenador" value="1"> <?=i18n("Coach")?>
							<?php }?>
        </label>
      </div>
    </div>
  </div>
	<div class="form-group">
    <div class="col-lg-offset-6 col-lg-6">
      <div class="checkbox">
        <label>
					<?php if($user->getDeportist() == 1){ ?>
          	<input type="checkbox" name="deportista" value="1" checked="checked"> <?=i18n("Athlete")?>
						<?php }else{ ?>
							<input type="checkbox" name="deportista" value="1"> <?=i18n("Athlete")?>
							<?php }?>
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
