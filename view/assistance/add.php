<?php
//file: view/assistance/view.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$assistants = $view->getVariable("assistants");
$assistance = $view->getVariable("assistance");

$view->setVariable("title", "Add Assistance");
?>

<div class="recuadro">
	<div class="margin">
		<div class="home2">
			<h1><?=i18n("Assistance")?></h1><br>
				<?php foreach ($assistants as $assistant): ?>
					
					<form action="index.php?controller=assistance&amp;action=add&amp;id_act=<?= $assistance->getActivityid(); ?>" method="POST">
						<input type="hidden" name="id_act" value="<?= $assistance->getActivityid(); ?>">
						<input type="hidden" name="asistente" value="<?= $assistant->getDni(); ?>">
						<a href="index.php?controller=users&amp;action=view&amp;dni=<?= $assistant->getDni(); ?>"><?= $assistant->getDni(); ?> </a>
						<input type="date" id="fecha" name="fecha">
						<input type="time" id="hora" name="hora">
						
						<button id="button2" type="submit" name="submit"><?=i18n("Add")?></button>
					</form>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
</div>