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
			<form action="index.php?controller=table&amp;action=edit" method="POST">
				<br><?=i18n("Table")?>:<?= isset($errors["table"])?i18n($errors["table"]):"" ?>
				<input type="text" name="id" value="<?=$table->getTableId()?>" readonly> 
				<br><?=i18n("Type")?>:<?= isset($errors["type"])?i18n($errors["type"]):"" ?>
				<select name="type">
					<option value="ESTANDAR"><?=i18n("ESTANDAR")?></option>
					<option value="PERSONALIZADA"><?=i18n("PERSONALIZADA")?></option>
				</select>
				<table class="full-width">
					<?php foreach($trainings as $training): ?>
					<tr>
						<td><?php echo $training[1] ?></td>
						<td><?php $time = substr($training[3], 3);
								if($time == "00:00"){
									$time ="";
								} else {
									$time = i18n("Duration"). ": " .$time;
								}
								echo i18n("Repeats"). ": ". $training[2] . "<br>" . $time;?>
							</td>
						<td class="icons">
								<form
								method="POST"
								action="index.php?controller=table&amp;action=deletecurrent"
								id="delete_trainingintable_<?=$training[0]?>"
								class="none-styles"
								style="display: inline"
								>

								<input type="hidden" name="id" value="<?=$training[0]?>">
								<input type="hidden" name="idtable" value="<?=$table->getTableId()?>">

								<a 
								onclick="
								if (confirm('<?= i18n("are you sure?")?>')) {
									document.getElementById('delete_trainingintable_<?=$training[0]?>').submit()
								}"
								><i class="fa fa-trash"></i></a>

							</form></td>
					</tr>
				<?php endforeach; ?>
				</table>
				<br>
				<button type="submit" name="submit"><?=i18n("Send")?></button>
			</form>
		</div>
	</div>
</div>
