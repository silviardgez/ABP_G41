<?php
//file: view/assistance/view.php

//include "libchart/libchart.php";
//$chart = new VerticalBarChart(500, 250);

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$statistics = $view->getVariable("statistics");
$view->setVariable("title", "View Statistics");

/*$dataSet = new XYDataSet();
$dataSet->addPoint(new Point("Jan 2005", 273));
$dataSet->addPoint(new Point("Feb 2005", 321));
$dataSet->addPoint(new Point("March 2005", 442));
$dataSet->addPoint(new Point("April 2005", 711));

$chart->setDataSet($dataSet);

$chart->setTitle("Monthly usage for www.example.com");
$chart->render("libchart/demo/generated/demo1.png");*/
?>

<div class="col-md-12">
	<div class="col-md-4"></div>
	<div class="list-group col-md-4">
	  <p class="list-group-item active tittle col-md-12">
	    <?=i18n("Statistics")?>
	  </p>
		<?php foreach ($statistics as $statistic): ?>
	  <p class="list-group-item col-md-12"><?=i18n("Total of athletes in the gym")?> <?= $statistic->getDeportistas(); ?></p>
	  <p class="list-group-item col-md-12"><?=i18n("Enrolled")?> <?= $statistic->getMatriculados(); ?></p>
	  <p class="list-group-item col-md-12"><?=i18n("Percentage of enrolled")?> <?= $statistic->getPorcentajeMatriculados(); ?> %</p>
	  <p class="list-group-item col-md-12"><?=i18n("Assistants")?> <?= $statistic->getAsistentes(); ?></p>
		<p class="list-group-item col-md-12"><?=i18n("Percentage of assistants")?> <?= $statistic->getPorcentajeAsistentes(); ?> %</p>
		<?php endforeach; ?>
	</div>
	<div class="col-md-4"></div>
</div>
