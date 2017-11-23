<?php
//file: view/users/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$exercises = $view->getVariable("exercises");
$training = $view->getVariable("training");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Add Training");

?>

<div class="recuadro">
	<div id="formulario">
		<div class="home2">
			<form action="index.php?controller=training&amp;action=add" method="POST">
				<br><?=i18n("Exercise")?>:
				<select name="exerciseId">
					<?php foreach ($exercises as $exercise => $exerciseName): ?> 
					 	<option value="<?=$exercise?>"><?=$exerciseName?></option>
					<?php endforeach; ?>
				</select>
				<br><?=i18n("Repeats")?>:
				<input type="number" name="repeats">
				<br><?=i18n("Time")?>:
				<input name="time" type="time" step="1">
				<br>
				<button type="submit" name="submit"><?=i18n("Send")?></button>
			</form>
		</div>
	</div>
</div>
