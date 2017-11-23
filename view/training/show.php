<?php
//file: view/users/show.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
//$view->setLayout("welcome");
$grupalTrainings = $view->getVariable("grupalTrainings");

$view->setVariable("title", "Show Trainings");
?>

<section class="pagecontent full-width">
	<div class="users">
		<div class="home2 title-style">
			<h1><?=i18n("Workouts")?></h1><br>
		</div>

		<div class="bloques">
		<div class="home2 full-width reduce-height">
			<h1 style="margin-bottom: 6px;"><?=i18n("Cardio")?></h1><br>
			<table class="full-width">
				<tr>
					<th><strong><?=i18n("Exercise")?></strong></th>
					<th style="text-align: center"><strong><?=i18n("Repeats")?></strong></th>
					<th style="text-align: center"><strong><?=i18n("Duration")?></strong></th>
					<th style="text-align: center"><strong><?=i18n("Options")?></strong></th>
				</tr>
				<?php foreach ($grupalTrainings[0] as $trainings): ?>
					<tr>
						<td><a href="index.php?controller=exercises&amp;action=view&amp;id=<?= $trainings[2] ?>" style="color: #669"><strong><?php echo $trainings[0] ?></strong></a></td>
						<td style="text-align: center"><?php echo $trainings[1]->getRepeats(); ?></td>
						<?php 
						$duracion = substr($trainings[1]->getTime(),3);
						if($duracion == "00:00") {
							$duracion = "-";
						}
						?>
						<td style="text-align: center"><?php echo $duracion; ?></td>
						<td class="icons"><a href="index.php?controller=training&amp;action=edit&amp;id=<?= $trainings[1]->getTrainingId() ?>"><i class="fa fa-pencil-square-o"></i></a>
							<form
							method="POST"
							action="index.php?controller=training&amp;action=delete"
							id="delete_training_<?= $trainings[1]->getTrainingId(); ?>"
							class="none-styles"
							style="display: inline"
							>

							<input type="hidden" name="id" value="<?= $trainings[1]->getTrainingId() ?>">

							<a 
							onclick="
							if (confirm('<?= i18n("are you sure?")?>')) {
								document.getElementById('delete_training_<?= $trainings[1]->getTrainingId() ?>').submit()
							}"
							><i class="fa fa-trash"></i></a>

							</form></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>	
	</div>

		<div class="bloques">
		<div class="home2 full-width reduce-height">
			<h1 style="margin-bottom: 6px;"><?=i18n("Muscular")?></h1><br>
			<table class="full-width">
				<tr>
					<th><strong><?=i18n("Exercise")?></strong></th>
					<th style="text-align: center"><strong><?=i18n("Repeats")?></strong></th>
					<th style="text-align: center"><strong><?=i18n("Options")?></strong></th>
				</tr>
				<?php foreach ($grupalTrainings[1] as $trainings): ?>
					<tr>
						<td><a href="index.php?controller=exercises&amp;action=view&amp;id=<?= $trainings[2] ?>" style="color: #669"><strong><?php echo $trainings[0] ?></strong></a></td>
						<td style="text-align: center"><?php echo $trainings[1]->getRepeats(); ?></td>	
						<td class="icons"><a href="index.php?controller=training&amp;action=edit&amp;id=<?= $trainings[1]->getTrainingId() ?>"><i class="fa fa-pencil-square-o"></i></a>
							<form
							method="POST"
							action="index.php?controller=training&amp;action=delete"
							id="delete_training_<?= $trainings[1]->getTrainingId(); ?>"
							class="none-styles"
							style="display: inline"
							>

							<input type="hidden" name="id" value="<?= $trainings[1]->getTrainingId() ?>">

							<a 
							onclick="
							if (confirm('<?= i18n("are you sure?")?>')) {
								document.getElementById('delete_training_<?= $trainings[1]->getTrainingId() ?>').submit()
							}"
							><i class="fa fa-trash"></i></a>

						</form></td>					
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
		<div class="bloques">
		<div class="home2 full-width reduce-height">
			<h1 style="margin-bottom: 6px;"><?=i18n("Stretch")?></h1><br>
			<table class="full-width">
				<tr>
					<th><strong><?=i18n("Exercise")?></strong></th>
					<th style="text-align: center"><strong><?=i18n("Repeats")?></strong></th>
					<th style="text-align: center"><strong><?=i18n("Duration")?></strong></th>
					<th style="text-align: center"><strong><?=i18n("Options")?></strong></th>
				</tr>
				<?php foreach ($grupalTrainings[2] as $trainings): ?>
					<tr>
						<td><a href="index.php?controller=exercises&amp;action=view&amp;id=<?= $trainings[2] ?>" style="color: #669"><strong><?php echo $trainings[0] ?></strong></a></td>
						<td style="text-align: center"><?php echo $trainings[1]->getRepeats(); ?></td>
						<?php 
						$duracion = substr($trainings[1]->getTime(),3);
						if($duracion == "00:00") {
							$duracion = "-";
						}
						?>
						<td style="text-align: center"><?php echo $duracion; ?></td>
						<td class="icons"><a href="index.php?controller=training&amp;action=edit&amp;id=<?= $trainings[1]->getTrainingId() ?>"><i class="fa fa-pencil-square-o"></i></a>
							<form
							method="POST"
							action="index.php?controller=training&amp;action=delete"
							id="delete_training_<?= $trainings[1]->getTrainingId(); ?>"
							class="none-styles"
							style="display: inline"
							>

							<input type="hidden" name="id" value="<?= $trainings[1]->getTrainingId() ?>">

							<a 
							onclick="
							if (confirm('<?= i18n("are you sure?")?>')) {
								document.getElementById('delete_training_<?= $trainings[1]->getTrainingId() ?>').submit()
							}"
							><i class="fa fa-trash"></i></a>

						</form></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
	</div>

<div class="row">
	<div class="btn-group">
		<a href="index.php?controller=training&amp;action=add" class="btn-fab circulo" id="add">
			<i class="fa fa-plus"></i>
		</a>
	</div>
</div>
</section>