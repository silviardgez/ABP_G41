<?php
//file: view/users/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$table = $view->getVariable("table");
$trainings = $view->getVariable("trainings");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Edit Training");

?>

<div class="recuadro">
	<div id="formulario">
		<div class="home3">
			<form action="index.php?controller=table&amp;action=add" method="POST">
				<br><?=i18n("Type")?>:
				<select name="type">
					<option value="ESTANDAR"><?=i18n("ESTANDAR")?></option>
					<option value="PERSONALIZADA"><?=i18n("PERSONALIZADA")?></option>
				</select>
				<br>
				<button type="submit" name="submit"><?=i18n("Send")?></button>
			</form>
		</div>
	</div>
</div>
