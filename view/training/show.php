<?php
// file: view/users/show.php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance ();
// $view->setLayout("welcome");
$grupalTrainings = $view->getVariable ( "grupalTrainings" );

$view->setVariable ( "title", "Show Trainings" );
?>

<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("Workouts")?></h1>
	<br>
	<div class="btn-group">
		<a href="index.php?controller=training&amp;action=add"
			class="btn-fab circulo btn-training" id="add"> <i class="fa fa-plus"></i>
		</a>
	</div>
</div>


<div class="container-fluid">
	<div class="row features margin-rows">
		<div class="col-md-4 col-sm-6 item">
			<div class="exercise-tables-background">
			<h1 id="font-title"><?=i18n("Cardio")?></h1>
			<br>
				<table id="table-margin" class="table">
					<tr>
						<th><?=i18n("Exercise")?></th>
						<th id="center-text"><?=i18n("Reps")?></th>
						<th id="center-text"><?=i18n("Duration")?></th>
						<th id="center-text"><?=i18n("Options")?></th>
					</tr>
					<?php foreach ($grupalTrainings[0] as $trainings): ?>
						<tr>
						<td id="center-text"><a
							href="index.php?controller=exercises&amp;action=view&amp;id=<?= $trainings[2] ?>"
							style="color: #669"><strong><?php echo $trainings[0] ?></strong></a></td>
						<td id="center-text"><?php echo $trainings[1]->getRepeats(); ?></td>
							<?php
						$duracion = substr ( $trainings [1]->getTime (), 3 );
						if ($duracion == "00:00") {
							$duracion = "-";
						}
						?>
							<td id="center-text"><?php echo $duracion; ?></td>
						<td class="icons"><a
							href="index.php?controller=training&amp;action=edit&amp;id=<?= $trainings[1]->getTrainingId() ?>"><i
								class="fa fa-pencil-square-o"></i></a>
							<form method="POST"
								action="index.php?controller=training&amp;action=delete"
								id="delete_training_<?= $trainings[1]->getTrainingId(); ?>"
								class="none-styles" style="display: inline">

								<input type="hidden" name="id"
									value="<?= $trainings[1]->getTrainingId() ?>"> <a
									onclick="
								if (confirm('<?= i18n("are you sure?")?>')) {
									document.getElementById('delete_training_<?= $trainings[1]->getTrainingId() ?>').submit()
								}"><i class="fa fa-trash"></i></a>

							</form>
						</td>
					</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>

		<div class="col-md-4 col-sm-6 item">
			<div class="exercise-tables-background">
				<h1 id="font-title"><?=i18n("Muscular")?></h1>
				<br>
				<table id="table-margin" class="table">
					<tr>
						<th><?=i18n("Exercise")?></th>
						<th id="center-text"><?=i18n("Reps")?></th>
						<th id="center-text"><?=i18n("Options")?></th>
					</tr>
					<?php foreach ($grupalTrainings[1] as $trainings): ?>
						<tr>
						<td id="center-text"><a
							href="index.php?controller=exercises&amp;action=view&amp;id=<?= $trainings[2] ?>"
							style="color: #669"><strong><?php echo $trainings[0] ?></strong></a></td>
						<td id="center-text"><?php echo $trainings[1]->getRepeats(); ?></td>
						<td class="icons"><a
							href="index.php?controller=training&amp;action=edit&amp;id=<?= $trainings[1]->getTrainingId() ?>"><i
								class="fa fa-pencil-square-o"></i></a>
							<form method="POST"
								action="index.php?controller=training&amp;action=delete"
								id="delete_training_<?= $trainings[1]->getTrainingId(); ?>"
								class="none-styles" style="display: inline">

								<input type="hidden" name="id"
									value="<?= $trainings[1]->getTrainingId() ?>"> <a
									onclick="
								if (confirm('<?= i18n("are you sure?")?>')) {
									document.getElementById('delete_training_<?= $trainings[1]->getTrainingId() ?>').submit()
								}"><i class="fa fa-trash"></i></a>

							</form></td>
					</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>

		<div class="col-md-4 col-sm-6 item">
			<div class="exercise-tables-background">
				<h1 id="font-title"><?=i18n("Stretch")?></h1>
				<br>
				<table id="table-margin" class="table">
					<tr>
						<th><?=i18n("Exercise")?></th>
						<th id="center-text"><?=i18n("Reps")?></th>
						<th id="center-text"><?=i18n("Duration")?></th>
						<th id="center-text"><?=i18n("Options")?></th>
					</tr>
					<?php foreach ($grupalTrainings[2] as $trainings): ?>
						<tr>
						<td id="center-text"><a
							href="index.php?controller=exercises&amp;action=view&amp;id=<?= $trainings[2] ?>"
							style="color: #669"><strong><?php echo $trainings[0] ?></strong></a></td>
						<td id="center-text"><?php echo $trainings[1]->getRepeats(); ?></td>
							<?php
						$duracion = substr ( $trainings [1]->getTime (), 3 );
						if ($duracion == "00:00") {
							$duracion = "-";
						}
						?>
							<td id="center-text"><?php echo $duracion; ?></td>
						<td class="icons"><a
							href="index.php?controller=training&amp;action=edit&amp;id=<?= $trainings[1]->getTrainingId() ?>"><i
								class="fa fa-pencil-square-o"></i></a>
							<form method="POST"
								action="index.php?controller=training&amp;action=delete"
								id="delete_training_<?= $trainings[1]->getTrainingId(); ?>"
								class="none-styles" style="display: inline">

								<input type="hidden" name="id"
									value="<?= $trainings[1]->getTrainingId() ?>"> <a
									onclick="
								if (confirm('<?= i18n("are you sure?")?>')) {
									document.getElementById('delete_training_<?= $trainings[1]->getTrainingId() ?>').submit()
								}"><i class="fa fa-trash"></i></a>

							</form></td>
					</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>
</div>
