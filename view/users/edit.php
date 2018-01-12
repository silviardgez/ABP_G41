<?php
//file: view/users/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$user = $view->getVariable("user");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Edit User");

?>

<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("Edit User")?></h1>
	<br>
</div>

<div id="edit-view" class="center-block col-xs-6 col-lg-4">
<form action="index.php?controller=users&amp;action=edit" method="POST" class="center-block form-horizontal" >
  <br><div class="form-group">
    <label class="control-label text-size text-muted col-sm-4"><?=i18n("Name")?>:<b class="aviso-vacio"><?= isset($errors["name"])?i18n($errors["name"]):"" ?></b></label>
    <div class="col-lg-6">
      <input class="form-control" type="text" name="nombre" value="<?=$user->getName()?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label text-size text-muted col-sm-4"><?=i18n("Surname")?>:<b class="aviso-vacio"><?= isset($errors["surname"])?i18n($errors["surname"]):"" ?></b></label>
    <div class="col-lg-6">
      <input class="form-control" type="text" name="apellidos" value="<?=$user->getSurname()?>">
    </div>
  </div>
	<div class="form-group">
    <label class="control-label text-size text-muted col-sm-4"><?=i18n("Date Born")?>:<b class="aviso-vacio"><?= isset($errors["dateborn"])?i18n($errors["dateborn"]):"" ?></b></label>
    <div class="col-lg-6">
      <input class="form-control" type="date" id="date" name="fechaNac" value="<?=$user->getDateBorn()?>">
    </div>
  </div>
	<div class="form-group">
    <label class="control-label text-size text-muted col-sm-4"><?=i18n("Email")?>:<b class="aviso-vacio"><?= isset($errors["email"])?i18n($errors["email"]):"" ?></b></label>
    <div class="col-lg-6">
      <input class="form-control" type="email" name="email" value="<?=$user->getEmail()?>">
    </div>
  </div>
	<div class="form-group">
    <label class="control-label text-size text-muted col-sm-4"><?=i18n("Telephone")?>:<b class="aviso-vacio"><?= isset($errors["tlf"])?i18n($errors["tlf"]):"" ?></b></label>
    <div class="col-lg-6">
      <input class="form-control" type="text" name="tel" value="<?=$user->getTlf()?>">
    </div>
  </div>
	<div class="form-group">
    <label class="control-label text-size text-muted col-sm-4"><?=i18n("DNI")?>:<b class="aviso-vacio"><?= isset($errors["DNI"])?i18n($errors["DNI"]):"" ?></b></label>
    <div class="col-lg-6">
    	<input class="form-control" type="text" name="dni" value="<?=$user->getUsername()?>" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label class="control-label text-size text-muted col-sm-8">
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
    <div class="col-sm-12">
      <div class="checkbox">
        <label class="control-label text-size text-muted col-sm-8">
					<?php if($user->getCoach() == 1){ ?>
          	<input type="checkbox" name="entrenador" value="1" checked="checked"> <?=i18n("Coach")?>
						<?php }else{ ?>
							<input type="checkbox" name="entrenador" value="1"> <?=i18n("Coach")?>
							<?php }?>
        </label>
      </div>
    </div>
  </div>
	<b class="aviso-vacio"><?= isset($errors["athlete"])?i18n($errors["athlete"]):"" ?></b>
	<div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label class="control-label text-size text-muted col-sm-8">
					<?php if($user->getDeportistTdu() == 1){ ?>
          	<input type="checkbox" name="deportista_tdu" value="1" checked="checked"> <?=i18n("Athlete"); echo " TDU"?>
						<?php }else{ ?>
							<input type="checkbox" name="deportista_tdu" value="1"> <?=i18n("Athlete"); echo " TDU"?>
							<?php }?>
        </label>
      </div>
    </div>
  </div>
	<div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label class="control-label text-size text-muted col-sm-8">
					<?php if($user->getDeportistPef() == 1){ ?>
          	<input type="checkbox" name="deportista_pef" value="1" checked="checked"> <?=i18n("Athlete"); echo " PEF"?>
						<?php }else{ ?>
							<input type="checkbox" name="deportista_pef" value="1"> <?=i18n("Athlete"); echo " PEF"?>
							<?php }?>
        </label>
      </div>
    </div>
  </div>


  <div class="form-group">
		<div class="col-sm-6">
			<button type="button" id="btn-styles" onclick="history.back()" class="btn btn-warning btn-lg"><?=i18n("Back")?></button>
		</div>
    <div class="col-sm-6">
      <button id="btn-styles" type="submit" name="submit" class="btn btn-success btn-lg"><?=i18n("Send")?></button>
    </div>
  </div>
</form>
</div>
