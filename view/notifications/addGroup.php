<?php
//file: view/notifications/addGroup.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Add Group Notification");
$id = $view->getVariable("id");
?>

<div class="recuadro">
	<div id="formulario">

		<div class="home2">
			<form action="index.php?controller=notifications&amp;action=add" method="POST">

				<input type="hidden" name="id" value="<?= $id ?>">

				<?= i18n("Subject")?>:<input type="text" name="subject"> 

				<?=i18n("Message")?>:<input type="text" name="message">

				<button type="submit" name="submit"><?=i18n("Send")?></button>

			</form>
		</div>
	</div>
</div>