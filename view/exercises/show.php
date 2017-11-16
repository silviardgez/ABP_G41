<?php
//file: view/exercises/show.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$exercises = $view->getVariable("exercises");
$view->setVariable("title", "Show Exercises");
?>
<section class="pagecontent">
	<div class="users">
		<div class="margin">
			<div class="home2">
				<h1><?=i18n("Cardio")?></h1><br>
				<?php foreach ($exercises as $exercise): ?>
					<?php if ($exercise->getType() == "CARDIO"): ?>
						
						<a href="index.php?controller=exercises&amp;action=view&amp;id=<?= $exercise->getId() ?>"><?= htmlentities($exercise->getName()) ?></a>
						<div class="icons">
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
								document.getElementById('delete_exercise_<?= $exercise->getName() ?>').submit()
							}"
							><i class="fa fa-trash"></i></a>

						</form>
						<a href="index.php?controller=exercises&amp;action=edit&amp;id=<?= $exercise->getId() ?>"><i class="fa fa-pencil-square-o"></i></a>
					</div>
				<?php endif ?>
			<?php endforeach; ?>
		</div>	
	</div>


	<div class="margin">
		<div class="home2">
			<h1><?=i18n("Muscular")?></h1><br>
			<?php foreach ($exercises as $exercise): ?>
				<?php if ($exercise->getType() == "MUSCULAR"): ?>

					<a href="index.php?controller=exercises&amp;action=view&amp;id=<?= $exercise->getId() ?>"><?= htmlentities($exercise->getName()) ?></a>
					<div class="icons">
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
					<a href="index.php?controller=exercises&amp;action=edit&amp;id=<?= $exercise->getId() ?>"><i class="fa fa-pencil-square-o"></i></a>
				</div>
			<?php endif ?>
		<?php endforeach; ?>
	</div>	
</div>

<div class="margin">
	<div class="home2">
		<h1><?=i18n("Stretch")?></h1><br>
		<?php foreach ($exercises as $exercise): ?>
			<?php if ($exercise->getType() == "ESTIRAMIENTO"): ?>

				<a href="index.php?controller=exercises&amp;action=view&amp;id=<?= $exercise->getId() ?>"><?= htmlentities($exercise->getName()) ?></a>
				<div class="icons">
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
						document.getElementById('delete_exercise_').submit()
					}"
					><i class="fa fa-trash"></i></a>

				</form>
				<a href="index.php?controller=exercises&amp;action=edit&amp;id=<?= $exercise->getId() ?>"><i class="fa fa-pencil-square-o"></i></a>
			</div>
		<?php endif ?>
	<?php endforeach; ?>
</div>	
</div>
</div>
<div class="row">
	<div class="btn-group">
		<a href="index.php?controller=exercises&amp;action=add" class="btn-fab circulo" id="add">
			<i class="fa fa-plus"></i>
		</a>
	</div>
</div>
</section>
