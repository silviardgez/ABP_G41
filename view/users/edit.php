<?php
//file: view/users/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$user = $view->getVariable("user");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Edit User");

?>

<div class="recuadro">
	<div id="formulario">

		<div class="home2">
			<form action="index.php?controller=users&amp;action=edit" method="POST">
				<br><?=i18n("Name")?>:<?= isset($errors["name"])?i18n($errors["name"]):"" ?><input type="text" name="nombre" value="<?=$user->getName()?>"> 

				<?=i18n("Surname")?>:<?= isset($errors["surname"])?i18n($errors["surname"]):"" ?><input type="text" name="apellidos" value="<?=$user->getSurname()?>">

				<?=i18n("Date Born")?>:<?= isset($errors["dateborn"])?i18n($errors["dateborn"]):"" ?><input type="text" id="datepicker" readonly="readonly" name="fechaNac" value="<?=$user->getDateBorn()?>">

				<?=i18n("Email")?>:<?= isset($errors["email"])?i18n($errors["email"]):"" ?><input type="email" name="email" value="<?=$user->getEmail()?>">

				<?=i18n("Telephone")?>:<?= isset($errors["tlf"])?i18n($errors["tlf"]):"" ?><input type="number" name="tel" value="<?=$user->getTlf()?>">

				<?=i18n("DNI")?>:<?= isset($errors["DNI"])?i18n($errors["DNI"]):"" ?><input type="text" name="dni" value="<?=$user->getUsername()?>" readonly="readonly">

				<?=i18n("Type")?>:
				<select name="type">
					<?php if($user->getAdmin() == 1){ ?>
					<option value="administrador" selected="selected"><?=i18n("Administrator")?></option>
					<option value="deportista"><?=i18n("Deportist")?></option>
					<option value="monitor"><?=i18n("Coach")?></option>
					<?php }elseif ($user->getCoach() == 1) { ?>
					<option value="administrador"><?=i18n("Administrator")?></option>
					<option value="deportista"><?=i18n("Deportist")?></option>
					<option value="monitor" selected="selected"><?=i18n("Coach")?></option>
					<?php }else{ ?>
					<option value="administrador"><?=i18n("Administrator")?></option>
					<option value="deportista" selected="selected"><?=i18n("Deportist")?></option>
					<option value="monitor"><?=i18n("Coach")?></option>
					<?php } ?>
				</select>
				<button type="submit" name="submit"><?=i18n("Send")?></button>

			</form>
		</div>
	</div>
</div>