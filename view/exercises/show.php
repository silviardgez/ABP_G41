<?php
//file: view/exercises/show.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$exercises = $view->getVariable("exercises");
$view->setVariable("title", "Show Exercises");
?>

<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("Exercises")?></h1>
	<br>
	<div class="btn-group">
		<a href="index.php?controller=exercises&amp;action=add"
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
			<thead>
				<tr>
					<th style="min-width: 18em"><?=i18n("Name")?></th>
					<th><?=i18n("Actions")?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($exercises as $exercice): ?>
					<?php if ($exercice->getType() == "CARDIO"): ?>
						<tr>
							<td><?= htmlentities($exercice->getName())?></td>
							<td class="icons">
							<a href="index.php?controller=exercises&amp;action=view&amp;id=<?= $exercice->getId() ?>">
								<i class="fa fa-search"></i></a>
							<form
							method="POST"
							action="index.php?controller=exercises&amp;action=delete"
							id="delete_exercise_<?= $exercice->getName(); ?>"
							style="display: inline"
							>

							<input type="hidden" name="id" value="<?= $exercice->getId() ?>">

							<a
							onclick="
							if (confirm('<?= i18n("are you sure?")?>')) {
								document.getElementById('delete_exercise_<?= $exercice->getName() ?>').submit()
							}"
							><i class="fa fa-trash"></i></a>

						</form>
						<a href="index.php?controller=exercises&amp;action=edit&amp;id=<?= $exercice->getId() ?>"><i class="fa fa-pencil-square-o"></i></a>
						</tr>
					<?php endif ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<div class="col-md-4 col-sm-6 item">
	<div class="exercise-tables-background">
		<h1 id="font-title"><?=i18n("Muscular")?></h1>
			<br>
			<table id="table-margin" class="table">
			<thead>
				<tr>
					<th style="min-width: 18em"><?=i18n("Name")?></th>
					<th><?=i18n("Actions")?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($exercises as $exercise): ?>
					<?php if ($exercise->getType() == "MUSCULAR"): ?>
						<tr>
							<td><?= htmlentities($exercise->getName()) ?></td>
							<td class="icons">
							<a href="index.php?controller=exercises&amp;action=view&amp;id=<?= $exercise->getId() ?>">
									<i class="fa fa-search"></i></a>
							<form
							method="POST"
							action="index.php?controller=exercises&amp;action=delete"
							id="delete_exercise_<?= $exercise->getName(); ?>"
							style="display: inline"
							>

							<input type="hidden" name="id" value="<?= $exercise->getId() ?>">

							<a
							onclick="
							if (confirm('<?= i18n("are you sure?")?>')) {
								document.getElementById('delete_exercise_<?= $exercise->getName(); ?>').submit()
							}"
							><i class="fa fa-trash"></i></a>

						</form>
						<a href="index.php?controller=exercises&amp;action=edit&amp;id=<?= $exercise->getId() ?>"><i class="fa fa-pencil-square-o"></i></a></td>
						</tr>
					<?php endif ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<div class="col-md-4 col-sm-6 item">
	<div class="exercise-tables-background">
	<h1 id="font-title"><?=i18n("Stretch")?></h1>
		<br>
		<table id="table-margin" class="table">
			<thead>
				<tr>
					<th style="min-width: 18em"><?=i18n("Name")?></th>
					<th><?=i18n("Actions")?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($exercises as $exercise): ?>
					<?php if ($exercise->getType() == "ESTIRAMIENTO"): ?>
						<tr>
							<td><?= htmlentities($exercise->getName()) ?></td>
							<td class="icons">
							<a href="index.php?controller=exercises&amp;action=view&amp;id=<?= $exercise->getId() ?>">
									<i class="fa fa-search"></i></a>
							<form
								method="POST"
								action="index.php?controller=exercises&amp;action=delete"
								id="delete_exercise_<?= $exercise->getName(); ?>"
								style="display: inline"
								>

								<input type="hidden" name="id" value="<?= $exercise->getId() ?>">

								<a
								onclick="
								if (confirm('<?= i18n("are you sure?")?>')) {
									document.getElementById('delete_exercise_<?= $exercise->getName(); ?>').submit()
								}"
								><i class="fa fa-trash"></i></a>

							</form>
						<a href="index.php?controller=exercises&amp;action=edit&amp;id=<?= $exercise->getId() ?>"><i class="fa fa-pencil-square-o"></i></a></td>
						</tr>
					<?php endif ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
</div>
</div>
