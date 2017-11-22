<?php
//file: view/users/show.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$tables = $view->getVariable("tables");

$view->setVariable("title", "Show Tables");
?>

<?php 
$cardioPhotos = array();
$cardioNames = array();
$muscularPhotos = array();
$muscularNames = array();
$estPhotos = array();
$estNames = array();
foreach ($tables as $key => $values){
	foreach ($values as $array){ 
		if($array[4] == "CARDIO" && $array[2]->getTableId() == '0') {
			array_push($cardioPhotos, $array[1]);
			array_push($cardioNames, $array[0]);
		}
		if($array[4] == "MUSCULAR") {
			array_push($muscularPhotos, $array[1]);
			array_push($muscularNames, $array[0]);
		}
		if($array[4] == "ENTRENAMIENTO" && $array[2]->getTableId()==0) {
			array_push($estPhotos, $array[1]);
			array_push($estNames, $array[0]);
		}
	}
}?> 

<section class="pagecontent full-width">
	<div class="home2">
		<h1><?=i18n("Table")?></h1><br>

		<table class="full-width">
			<tr>
				<?php foreach ($cardioPhotos as $photo) : ?>						
					<td><a href="index.php?controller=exercises&amp;action=view&amp;id=<?= $array[3] ?>" style="color: #669"><img src="<?=$photo?>" alt="<?=i18n("Image not found")?>" /></a></td>
				<?php endforeach; ?>
			</tr>
			<tr>
				<?php foreach ($cardioNames as $name) : ?>
					<td><?php echo $name;?></td>
				<?php endforeach; ?>
			</tr>

			<tr>
				<?php foreach ($muscularPhotos as $photo) : ?>	
					<td><a href="index.php?controller=exercises&amp;action=view&amp;id=<?= $array[3] ?>" style="color: #669"><img src="<?=$photo?>" alt="<?=i18n("Image not found")?>" /></a></td>
				<?php endforeach; ?>
			</tr>
			<tr>
				<?php foreach ($muscularNames as $name) : ?>
					<td><?php echo $name;?></td>
				<?php endforeach; ?>
			</tr>

			<tr>
				<?php foreach ($estPhotos as $photo) : ?>
					<td><a href="index.php?controller=exercises&amp;action=view&amp;id=<?= $array[3] ?>" style="color: #669"><img src="<?=$photo?>" alt="<?=i18n("Image not found")?>" /></a></td>
				<?php endforeach; ?>
			</tr>
			<tr>
				<?php foreach ($estNames as $name) : ?>
					<td><?php echo $name;?></td>
				<?php endforeach;?>
			</tr>
		</table>
	</div>	

	<div class="row">
		<div class="btn-group">
			<a href="index.php?controller=training&amp;action=add" class="btn-fab circulo" id="add">
				<i class="fa fa-plus"></i>
			</a>
		</div>
	</div>
</section>