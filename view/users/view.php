<?php
//file: view/users/view.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$user = $view->getVariable("user");
$view->setVariable("title", "View User");
?>

<div class="recuadro">
		<div id="formulario">
			
			<div class="home2">
				<form>
					<br><?=i18n("Name")?>:<input type="text" name="nombre" value="<?=$user->getName()?>" readonly="readonly"> 
					<?=i18n("Surname")?>:<input type="text" name="apellidos" value="<?=$user->getSurname()?>" readonly="readonly">
					<?=i18n("Date Born")?>:<input type="text" value="<?=$user->getDateBorn()?>"  readonly="readonly" name="fechaNac">
					<?=i18n("Email")?>:<input type="tel" name="email" value="<?=$user->getEmail()?>" readonly="readonly">
					<?=i18n("Telephone")?>:<input type="number" name="tel" value="<?=$user->getTlf()?>" readonly="readonly">
					<?=i18n("DNI")?>:<input type="text" name="dni" value="<?=$user->getUsername()?>" readonly="readonly">
					<?=i18n("Type")?>:
					<?php if ($user->getAdmin() == 1): ?>
						<input type="text" name="dni" value="<?=i18n("Administrator"); echo ' '?>" readonly="readonly">
					<?php endif ?>
					<?php if ($user->getCoach() == 1): ?>
						<input type="text" name="dni" value="<?=i18n("Coach"); echo ' '?>" readonly="readonly"> 
					<?php endif ?>
					<?php if ($user->getDeportist() == 1): ?>
						<input type="text" name="dni" value="<?=i18n("Deportist")?>" readonly="readonly">
					<?php endif ?>
					
				</form>
				<button type="button" onclick="history.back()"><?=i18n("OK")?></button>

			</div>
		</div>
	</div>