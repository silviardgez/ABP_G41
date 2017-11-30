<?php
// file: view/users/edit.php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance ();

$table = $view->getVariable ( "table" );
$trainings = $view->getVariable ( "trainings" );
$totalTrainings = $view->getVariable("totaltrainings");
$errors = $view->getVariable ( "errors" );

$view->setVariable ( "title", "Edit Table" );

?>

<div class="container-fluid">
	<h1 class="stroke"><?=i18n("Edit Table") . " " . $table->getTableId()?></h1>
	<br>
	<div id="edit-view" class="center-block col-xs-6 col-lg-4">
		<form id="edit-form" class="center-block form-horizontal"
			action="index.php?controller=table&amp;action=edit" method="POST">


			<input type="hidden" name="id" value="<?=$table->getTableId()?>"
				readonly>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
				<?=i18n("Type")?>:<?= isset($errors["type"])?i18n($errors["type"]):"" ?>
			</label>
				<div class="col-sm-8">
					<select class="form-control" name="type">
						<option value="ESTANDAR"><?=i18n("ESTANDAR")?></option>
						<option value="PERSONALIZADA"><?=i18n("PERSONALIZADA")?></option>
					</select>
				</div>
			</div>
			<br>
			<div class="form-group">
				<div class="col-sm-12">
					<table class="full-width">
					<?php foreach($trainings as $training): ?>
					<tr>
							<td><?php echo $training[1] ?></td>
							<td><?php
						
						$time = substr ( $training [3], 3 );
						if ($time == "00:00") {
							$time = "";
						} else {
							$time = i18n ( "Duration" ) . ": " . $time;
						}
						echo i18n ( "Repeats" ) . ": " . $training [2] . "<br>" . $time;
						?>
							</td>
							<td class="icons">
								<form method="POST"
									action="index.php?controller=table&amp;action=deletecurrent"
									id="delete_trainingintable_<?=$training[0]?>"
									class="none-styles" style="display: inline">
					
									<a
										onclick="
								if (confirm('<?= i18n("are you sure?")?>')) {
									document.getElementById('delete_trainingintable_<?=$training[0]?>').submit()
								}"><i class="fa fa-trash"></i></a>

								</form>
							</td>
						</tr>
				<?php endforeach; ?>
				</table>
				</div>
			</div>

			<br>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
				<?=i18n("Trainings")?>:<?= isset($errors["Training"])?i18n($errors["Training"]):"" ?>
			</label>
				<form name="addtraining" class="form-horizontal"
					action="index.php?controller=table&amp;action=addtraining"
					method="POST">
					<div class="col-sm-8">

							<input type="hidden" name="id" value="<?=$training[0]?>"> <input
								type="hidden" name="idtable" value="<?=$table->getTableId()?>">
								
								
							<select class="col-sm-4 form-control" name="training">
									<?php foreach ($totalTrainings as $exercise => $exerciseName): ?> 
										<option value="<?=$exercise?>"><?=$exerciseName?></option>
									<?php endforeach; ?>
							</select>
							<br>
							<button style="float:right" id="btn-styles" type="submit" name="addtraining"
						class="btn btn-info"><span style="margin-right:5%"
								class="glyphicon glyphicon-plus"></span><?= i18n("Add")?></button>
					</div>
						</form>
	
			</div>

			<br>
			<div class="form-group">
				<div class="col-sm-12">
					<button id="btn-styles" type="submit" name="submit"
						class="btn btn-success btn-lg"><?=i18n("Send")?></button>
				</div>
			</div>
		</form>
	</div>
</div>

