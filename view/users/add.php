<?php
//file: view/users/add.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$user = $view->getVariable("user");
$view->setVariable("title", "Add User");
$errors = $view->getVariable("errors");
?>

<div class="recuadro">
		<div id="formulario">
			
			<div class="home2">
				<form action="index.php?controller=users&amp;action=add" method="POST">
					<br><?=i18n("Name")?>:<?= isset($errors["name"])?i18n($errors["name"]):"" ?><input type="text" name="nombre"> 
					
					<?=i18n("Surname")?>:<?= isset($errors["surname"])?i18n($errors["surname"]):"" ?><input type="text" name="apellidos">
					
					<?=i18n("Date Born")?>:<?= isset($errors["dateborn"])?i18n($errors["dateborn"]):"" ?><input type="text" id="datepicker" readonly="readonly" name="fechaNac">
					
					<?=i18n("Email")?>:<?= isset($errors["email"])?i18n($errors["email"]):"" ?><input type="email" name="email">
					
					<?=i18n("Telephone")?>:<?= isset($errors["tlf"])?i18n($errors["tlf"]):"" ?><input type="number" name="tel">

					<?=i18n("DNI")?>:<?= isset($errors["DNI"])?i18n($errors["DNI"]):"" ?><input type="text" name="dni">
					
					<?=i18n("Password")?>:<?= isset($errors["passwd"])?i18n($errors["passwd"]):"" ?><input type="password" name="pass">
					
					<?=i18n("Repeat Password")?>:<input type="password" name="rpass">
					<?=i18n("Type")?>:
					<select name="type">
						<option value="administrador"><?=i18n("Administrator")?></option>
						<option value="deportista"><?=i18n("Deportist")?></option>
						<option value="monitor"><?=i18n("Coach")?></option>
					</select>
					<button type="submit" name="submit"><?=i18n("Send")?></button>
					
				</form>
			</div>
		</div>
	</div>