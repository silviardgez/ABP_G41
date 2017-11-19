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


print_r($statistics);

?>

<section class="pagecontent">
	<div class="users">
		<div class="margin">
			<div class="home2">
				<h1><?=i18n("Assistance")?></h1><br>
				<?php foreach ($statistics as $statistic): ?>
					<p>Total deportistas: <?= $statistic->getDeportistas(); ?></p>
					<p>Matriculados: <?= $statistic->getMatriculados(); ?></p>
					<p>Porcentaje matriculados: <?= $statistic->getPorcentajeMatriculados(); ?> %</p>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
