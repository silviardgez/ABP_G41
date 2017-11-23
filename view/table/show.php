<?php
//file: view/users/show.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$tables = $view->getVariable("tables");
$tables_id = $view->getVariable("tables_id");

$view->setVariable("title", "Show Tables");
?>


<section class="pagecontent full-width">
	<div class="users">
		<div class="home2 title-style">
			<h1><?=i18n("Tables")?></h1><br>
			<div class="btn-group">
				<a href="index.php?controller=training&amp;action=add" class="btn-fab circulo btn-training" id="add">
					<i class="fa fa-plus"></i>
				</a>
			</div>
		</div>
		<?php $j=0; ?>
		<?php foreach ($tables as $table) : ?>
			<div class="home4 margin-tables">
				<h1><?=i18n("Table") . " " . $tables_id[$j]; ?></h1><br>
				<div class="icons min-margin">
						<form
						method="POST"
						action="index.php?controller=table&amp;action=delete"
						id="delete_table_<?= $tables_id[$j] ?>"
						class="none-styles"
						style="display: inline"
						>

						<input type="hidden" name="id" value="<?= $tables_id[$j] ?>">

						<a onclick="
						if (confirm('<?= i18n("are you sure?")?>')) {
							document.getElementById('delete_table_<?= $tables_id[$j] ?>').submit()
						}"><i class="fa fa-trash"></i></a>

					</form>
					<a href="index.php?controller=table&amp;action=edit&amp;id=<?= $tables_id[$j] ?>"><i class="fa fa-pencil-square-o"></i></a>
					<?php $j++; ?>
			</div>

				<table class="full-width">
					<?php foreach ($table as $type) : ?>
						<tr><th colspan="<?php echo sizeof($type) ?>"><strong><?php echo $type[0][3] ?></strong></th></tr>
						<tr>

							<?php for ($i=0; $i < sizeof($type); $i++) : ?>
								<td><a href="index.php?controller=exercises&amp;action=view&amp;id=<?= $type[$i][0] ?>"><img class="img-height" src="<?=$type[$i][1]?>" alt="<?=i18n("Image not found")?>" /></a></td>
							<?php endfor; ?>

						</tr>

						<tr>
							<?php for ($i=0; $i < sizeof($type); $i++) : ?>
								<td><a href="index.php?controller=exercises&amp;action=view&amp;id=<?= $type[$i][0] ?>"><?php echo $type[$i][2];?></a></td>
							<?php endfor; ?>
						</tr>
						<tr>
							<?php for ($i=0; $i < sizeof($type); $i++) : ?>
								<td><?php $time = substr($type[$i][5], 3);
								if($time == "00:00"){
									$time ="";
								} else {
									$time = i18n("Duration"). " (min): ". $time;
								}
								echo i18n("Repeats"). ": ". $type[$i][4] . "<br>" . $time;?></td>
							<?php endfor; ?>
						</tr>
						<tr><td class="none-styles"></td></tr>
					<?php endforeach; ?>
				</table>
			</div>	
		<?php endforeach; ?>
	</div>
	<div class="end-file"></div>
</section>