<?php
//file: view/assistance/view.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$assistants = $view->getVariable("assistants");
$assistance = $view->getVariable("assistance");

$view->setVariable("title", "Add Assistance");
?>

<section class="pagecontent">
	<div class="users">
		<div class="margin">
			<div class="home2">
				<h1><?=i18n("Assistance")?></h1><br>
					<?php foreach ($assistants as $assistant): ?>
						

						<form action="index.php?controller=assistance&amp;action=add&amp;id_act=<?= $assistance->getActivityid(); ?>" method="POST">
							<input type="hidden" name="id_act" value="<?= $assistance->getActivityid(); ?>">
							<?= $assistant->getDni(); ?><input type="checkbox" name="asistente" value="<?= $assistant->getDni(); ?>">
							<input type="date" id="fecha" name="fecha">
							<input type="time" id="hora" name="hora">
							
							<button type="submit" name="submit"><?=i18n("Add")?></button>
						</form>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>
</section>