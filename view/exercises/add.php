<?php
//file: view/exercises/add.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$exercise = $view->getVariable("exercise");
$view->setVariable("title", "Add Exercise");
$errors = $view->getVariable("errors");
?>

<div class="recuadro">
	<div id="formulario">

		<div class="home2">
			<form action="index.php?controller=exercises&amp;action=add" method="POST">
				<br><?=i18n("Name")?>:<?= isset($errors["name"])?i18n($errors["name"]):"" ?><input type="text" name="name">  

				<?=i18n("Type")?>:
				<select name="type">
					<option value="CARDIO"><?=i18n("Cardio")?></option>
					<option value="MUSCULAR"><?=i18n("Muscular")?></option>
					<option value="ESTIRAMIENTO"><?=i18n("Stretch")?></option>
				</select>

				<?=i18n("Image")?>:<input type="file" name="image"> 

				<?=i18n("Video")?>:<input type="file" name="video">

				<button type="submit" name="submit"><?=i18n("Send")?></button>

			</form>
		</div>
	</div>
</div>