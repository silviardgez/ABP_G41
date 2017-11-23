<?php
//file: view/users/show.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$tables = $view->getVariable("tables");
$tables_id = $view->getVariable("tables_id");

$view->setVariable("title", "Show Tables");
?>


<section class="pagecontent full-width">
	<?php $j=0; ?>
	<?php foreach ($tables as $table) : ?>
			<div class="home4">
				<h1><?=i18n("Table") . " " . $tables_id[$j]; $j++; ?></h1><br>

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
						<tr><td class="none-styles"></td></tr>
					<?php endforeach; ?>
				</table>
			</div>	
	<?php endforeach; ?>

	<div class="row">
		<div class="btn-group">
			<a href="index.php?controller=training&amp;action=add" class="btn-fab circulo" id="add">
				<i class="fa fa-plus"></i>
			</a>
		</div>
	</div>
</section>