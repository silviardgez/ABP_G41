<?php
// file: view/users/show.php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance ();
$tables = $view->getVariable ( "tables" );
$tables_id = $view->getVariable ( "tables_id" );
$tableswithoutid = $view->getVariable ( "tableswithoutid" );

$view->setVariable ( "title", "Show Tables" );
?>


<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("Tables")?></h1>
	<br>
	<?php if(!$_SESSION["deportista"]):?>
	<div class="btn-group">
		<a href="index.php?controller=table&amp;action=add"
			class="btn-fab circulo btn-training" id="add"> <i class="fa fa-plus"></i>
		</a>
	</div>
	<?php endif;?>
</div>

<div class="container-fluid">
	<div class="row features margin-rows">
		<?php $j=0; ?>
		<?php foreach ($tables as $table) : ?>
			<div class="col-xs-12 col-lg-6">
			<div id="tableExercises" class="exercise-tables-background">
				<div class="container-fluid">
					<?php if(!$_SESSION["deportista"]):?>
					<div class="row">
						<form method="POST"
							action="index.php?controller=table&amp;action=delete"
							id="delete_table_<?= $tables_id[$j] ?>" class="none-styles"
							style="display: inline">
							<input type="hidden" name="id" value="<?= $tables_id[$j] ?>">
							<div class="col-xs-12">
								<h1><?=i18n("Table") . " " . $tables_id[$j]; ?></h1>
								<br>
							</div>
							<div class="icons ubica-right">
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
							</div>
						</form>
					</div>
					<?php endif;?>
				<?php $j++; ?>

				<?php foreach ($table as $type) : ?>
				<?php $tam = min(6, max(3,(12/sizeof($type))))?>
					<div class="row">
						<div
							class="exercise-tables-head col-xs-<?php echo sizeof($type)*$tam;?>">
							<strong><?php echo $type[0][3] ?></strong>
						</div>
					</div>
					<div class="row">
						<?php for ($i=0; $i < sizeof($type); $i++) : ?>
							<div class="exercise-tables-content col-xs-<?php echo $tam; ?>">
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
				<?php endforeach; ?>
			</div>
			</div>
		</div>

	<?php endforeach; ?>
	

	<?php for ($j=0; $j<sizeof($tableswithoutid); $j++) : ?>
	<div class="col-xs-12 col-lg-6">
			<div id="tableExercises" class="exercise-tables-background">
				<div class="container-fluid">
					<?php if(!$_SESSION["deportista"]):?>
					<div class="row">
						<form method="POST"
							action="index.php?controller=table&amp;action=delete"
							id="delete_table_<?= $tableswithoutid[$j] ?>" class="none-styles"
							style="display: inline">
							<input type="hidden" name="id"
								value="<?= $tableswithoutid[$j] ?>">
							<div class="col-xs-12">
								<h1><?=i18n("Table") . " " . $tableswithoutid[$j]; ?></h1>
								<br>
							</div>
							<div class="icons ubica-right">
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
							</div>
						</form>
					</div>
					<?php endif;?>
					</div>
			</div>
		</div>

	<?php endfor; ?>
	</div>
</div>

