<?php
//file: view/users/viewcurrent.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$user = $view->getVariable("user");
$view->setVariable("title", "View CurrentUser");
?>

	<h1><?=i18n("View Profile")?></h1>
	<form action="index.php?controller=users&amp;action=editcurrent&amp;dni=<?= $_SESSION['currentuser'] ?>" method="POST" class="form-horizontal col-md-12" >
		<br><div class="form-group">
			<label class="col-lg-6 control-label"><?=i18n("Name")?>:<?= isset($errors["name"])?i18n($errors["name"]):"" ?></label>
			<div class="col-lg-6">
				<input type="text" name="nombre" value="<?=$user->getName()?>" readonly="readonly">
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-6 control-label"><?=i18n("Surname")?>:<?= isset($errors["surname"])?i18n($errors["surname"]):"" ?></label>
			<div class="col-lg-6">
				<input type="text" name="apellidos" value="<?=$user->getSurname()?>" readonly="readonly">
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-6 control-label"><?=i18n("Date Born")?>:<?= isset($errors["dateborn"])?i18n($errors["dateborn"]):"" ?></label>
			<div class="col-lg-6">
				<input type="text" value="<?=$user->getDateBorn()?>"  readonly="readonly" name="fechaNac">
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-6 control-label"><?=i18n("Email")?>:<?= isset($errors["email"])?i18n($errors["email"]):"" ?></label>
			<div class="col-lg-6">
				<input type="tel" name="email" value="<?=$user->getEmail()?>" readonly="readonly">
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-6 control-label"><?=i18n("Telephone")?>:<?= isset($errors["tlf"])?i18n($errors["tlf"]):"" ?></label>
			<div class="col-lg-6">
				<input type="number" name="tel" value="<?=$user->getTlf()?>" readonly="readonly">
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-6 control-label"><?=i18n("DNI")?>:<?= isset($errors["DNI"])?i18n($errors["DNI"]):"" ?></label>
			<div class="col-lg-6">
				<input type="text" name="dni" value="<?=$user->getUsername()?>" readonly="readonly">
			</div>
		</div>
		<div class="form-group">
			<?php if($user->getAdmin() == 1){ ?>
	    <label class="col-lg-6 control-label"><?=i18n("Administrator");?>:</label>
					<div class="col-lg-6">
	          	<input type="text" name="administrador" value="<?=i18n("Administrator");?>" readonly="readonly">
	        </div>
					<?php }?>
	  </div>
		<div class="form-group">
			<?php if($user->getCoach() == 1){ ?>
	    <label class="col-lg-6 control-label"><?=i18n("Coach");?>:</label>
			<div class="col-lg-6">
	        <input type="text" name="entrenador" value="<?=i18n("Coach");?>" readonly="readonly">
	    </div>
			<?php }?>
	  </div>
		<div class="form-group">
			<?php if($user->getDeportist() == 1){ ?>
	    <label class="col-lg-6 control-label"><?=i18n("Athlete");?>:</label>
			<div class="col-lg-6">
	        <input type="text" name="deportista" value="<?=i18n("Athlete");?>" readonly="readonly">
	    </div>
			<?php }?>
	  </div>
		<div class="form-group">
	    <div class="col-lg-offset-6 col-lg-6">
				<button type="button" onclick="history.back()"><?=i18n("Back")?></button>
				<button type="submit" name="submit"><?=i18n("Edit")?></button>
	    </div>
	  </div>
	</form>
