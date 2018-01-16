<?php
// file: view/users/show.php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance ();
$tables = $view->getVariable ( "tables" );
$nombre = $view->getVariable ( "nombre" );
$tables_id = $view->getVariable ( "tables_id" );
$tablesType = $view->getVariable ( "tablesType" );
$tableswithoutid = $view->getVariable ( "tableswithoutid" );

$view->setVariable ( "title", "Show Tables" );
?>


<div>
	<?php if(isset($nombre) && $nombre!=NULL): ?>
		<h1 id="bigger-size" class="stroke"><?=i18n("Tables") . ": " . $nombre?></h1>
		<br>
	<?php else: ?>
		<h1 id="bigger-size" class="stroke"><?=i18n("Standard Tables")?></h1>
	<?php endif;?>
	
	<?php if((!$_SESSION["deportista"] || ($_SESSION["deportista"] && $_SESSION["entrenador"])) && !isset($nombre) && $nombre==NULL):?>
		<div class="btn-group">
			<a href="index.php?controller=table&amp;action=add"
			class="btn-fab circulo btn-training" id="add"> <i class="fa fa-plus"></i>
		</a>
	</div>
<?php endif;?>
</div>
<?php if((!$_SESSION["deportista"] || ($_SESSION["deportista"] && $_SESSION["entrenador"])) && !isset($nombre) && $nombre==NULL):?>
<form class="center-block"
action="index.php?controller=table&amp;action=show" method="POST">
<div id="input-table" class="form-group center-block">
	<label class="text-size stroke col-sm-4">
		<b style="font-size: 18px"><?=i18n("Search by DNI")?>:</b>
	</label>
	<div class="col-sm-4">
		<input class="form-control" type="text" name="user">
	</div>
	<div id="null_margin" class="form-group col-sm-3">
		<button id="btn-styles" type="submit" name="submit"
		class="btn btn-success"><?=i18n("Send")?></button>
		<br>
	</div>
</div>
</form>
<?php elseif($_SESSION["deportista"] && !$_SESSION["entrenador"]): ?>
	<br>
<?php else: ?>
	<div class="form-group">
		<div class="col-sm-12">
			<button id="btn-styles" type="button" onclick="history.back()"
			class="btn btn-primary"><?=i18n("Back")?></button>
		</div>
	</div>
	<br><br><br>
<?php endif; ?>

<div class="container-fluid">
	<div class="row features margin-rows">
		<?php $j=0; ?>
		<?php foreach ($tables as $table) : ?>
			<div class="col-xs-12 col-lg-6">
				<div id="tableExercises" class="exercise-tables-background center-block">
					<div class="container-fluid">
						<div class="row">
							<div class="col-xs-12">
								<h1><?=i18n("Table") . " " . $tables_id[$j]; ?></h1>
								<?php if(isset($nombre) && $nombre!=NULL): ?>
									<h4 style="text-align: center;"><?= $tablesType[$j]?></h4>
								<?php endif; ?>
								<br>
							</div>
							<?php if(!$_SESSION["deportista"] || ($_SESSION["deportista"] && $_SESSION["entrenador"])):?>
								<form method="POST"
								action="index.php?controller=table&amp;action=delete"
								id="delete_table_<?= $tables_id[$j] ?>" class="none-styles"
								style="display: inline">
								<input type="hidden" name="id" value="<?= $tables_id[$j] ?>">
								<div class="icons ubica-right">
									<?php if(!isset($nombre) && $nombre==NULL || $tablesType[$j] == "PERSONALIZADA"): ?>
									<div class="col-xs-2">
										<a
										onclick="
										if (confirm('<?= i18n("are you sure?")?>')) {
											document.getElementById('delete_table_<?= $tables_id[$j] ?>').submit()
										}"><i class="fa fa-trash"></i></a>
									</div>
									<div class="col-xs-2">
										<a
										href="index.php?controller=table&amp;action=edit&amp;id=<?= $tables_id[$j] ?>"><i
										class="fa fa-pencil-square-o"></i></a>
									</div>
									<?php endif; ?>
									<?php if(!isset($nombre) && $nombre==NULL): ?>
									<div class="col-xs-2">
										<a
										href="index.php?controller=table&amp;action=showusers&amp;id=<?= $tables_id[$j] ?>">
										<i class="glyphicon glyphicon-list-alt"></i>
									</a>
								</div>
								<div class="col-xs-2">
									<a
									href="index.php?controller=table&amp;action=adduser&amp;id=<?= $tables_id[$j] ?>"
									class="btn btn-info"> <span class="glyphicon glyphicon-plus"></span><?= i18n(" Assign")?>
								</a>
							</div>
						<?php endif; ?>
						</div>
					</form>
				<?php endif;?>
			</div>
			<?php $j++; ?>

			<?php foreach ($table as $type) : ?>
				<?php if(sizeof($type)>0): ?>
				<?php $tam = min(6, max(3,(12/sizeof($type))))?>
				<div class="row">
					<div
					class="exercise-tables-head col-xs-<?php echo sizeof($type)*$tam;?>" style="max-width: <?php echo min(4,sizeof($type))*12+0.25;?>em">
					<strong><?php echo $type[0][3] ?></strong>
				</div>
			</div>
			<div class="row">
				<?php for ($i=0; $i < sizeof($type); $i++) : ?>
					<div id="exercise-tables-height" class="exercise-tables-content col-xs-<?php echo $tam; ?>">
						<div>
							<a
							href="index.php?controller=exercises&amp;action=view&amp;id=<?= $type[$i][0] ?>"><img
							class="img-responsive" src="<?=$type[$i][1]?>"
							alt="<?=i18n("Image not found")?>" /></a>
						</div>
						<div class="exercise-tables-name">
							<a
							href="index.php?controller=exercises&amp;action=view&amp;id=<?= $type[$i][0] ?>"><?php echo $type[$i][2];?></a>
						</div>
						<div>

							<?php

							$time = substr ( $type [$i] [5], 3 );
							if ($time == "00:00") {
								$time = "";
							} else {
								$time = i18n ( "Duration" ) . " (min): " . $time;
							}
							echo i18n ( "Repeats" ) . ": " . $type [$i] [4] . "<br>" . $time;
							?>
						</div>
					</div>
				<?php endfor; ?>
			</div>
		<?php endif;?>
		<?php endforeach; ?>
	</div>
</div>
</div>

<?php endforeach; ?>


<?php for ($j=0; $j<sizeof($tableswithoutid); $j++) : ?>
	<div class="col-xs-12 col-lg-6">
		<div id="tableExercises" class="exercise-tables-background center-block">
			<div class="container-fluid">
					<div class="row">
						<div class="col-xs-12">
								<h1><?=i18n("Table") . " " . $tables_id[$j]; ?></h1>
								<?php if(isset($nombre) && $nombre!=NULL): ?>
									<h4 style="text-align: center;"><?= $tablesType[$j]?></h4>
								<?php endif; ?>
								<br>
							</div>
						<?php if(!$_SESSION["deportista"] || ($_SESSION["deportista"] && $_SESSION["entrenador"])):?>
						<form method="POST"
						action="index.php?controller=table&amp;action=delete"
						id="delete_table_<?= $tableswithoutid[$j] ?>" class="none-styles"
						style="display: inline">
						<input type="hidden" name="id"
						value="<?= $tableswithoutid[$j] ?>">
						<div class="icons ubica-right">
							<?php if(!isset($nombre) && $nombre==NULL || $tablesType[$j] == "PERSONALIZADA"): ?>
							<div class="col-xs-2">
								<a
								onclick="
								if (confirm('<?= i18n("are you sure?")?>')) {
									document.getElementById('delete_table_<?= $tableswithoutid[$j] ?>').submit()
								}"><i class="fa fa-trash"></i></a>
							</div>
							<div class="col-xs-2">
								<a
								href="index.php?controller=table&amp;action=edit&amp;id=<?= $tableswithoutid[$j] ?>"><i
								class="fa fa-pencil-square-o"></i></a>
							</div>
						<?php endif; ?>
						<?php if(!isset($nombre) && $nombre==NULL): ?>
							<div class="col-xs-2">
								<a
								href="index.php?controller=table&amp;action=showusers&amp;id=<?= $tableswithoutid[$j] ?>">
								<i class="glyphicon glyphicon-list-alt"></i>
							</a>
						</div>
						<div class="col-xs-2">
							<a
							href="index.php?controller=table&amp;action=adduser&amp;id=<?= $tableswithoutid[$j] ?>"
							class="btn btn-info"> <span class="glyphicon glyphicon-plus"></span><?= i18n(" Assign")?>
						</a>
					</div>
				<?php endif; ?>
				</div>
			</form>
			<?php endif;?>
		</div>
	
</div>
</div>
</div>

<?php endfor; ?>
</div>
</div>

