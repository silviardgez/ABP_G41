<?php
//file: view/notifications/add.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Add notification");
$dni = $view->getVariable("dni");
$email = $view->getVariable("email");
?>

<div class="recuadro">
	<div id="formulario">

		<div class="home2">
			<form action="index.php?controller=notifications&amp;action=add" method="POST">
				<br><input type="hidden" name="dni" value="<?= $dni ?>" readonly="readonly">  
 
				<?=i18n("Email")?>:<input type="text" name="email" value="<?= $email ?>" readonly="readonly">

				<?=i18n("Subject")?>:<input type="text" name="subject"> 

				<?=i18n("Message")?>:<input type="text" name="message">

				<button type="submit" name="submit"><?=i18n("Send")?></button>

			</form>
		</div>
	</div>
</div>