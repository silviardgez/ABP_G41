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

<div class="users">
	<div class="margin">
		<div class="home2">
			<h1><?=i18n("Statistics")?></h1><br>
			<?php foreach ($statistics as $statistic): ?>
				Asiste a: <?= $statistic->getAsistenciaActividades(); ?> actividades<br/>
				Está matriculado en: <?= $statistic->getMatriculas(); ?> actividades<br/>
				Ha asistido: <?= $statistic->getAsistenciasTotales(); ?> veces al gimnasio<br/>
				Está matriculado en el: <?= $statistic->getPorcentajeMatriculas(); ?> % de las actividades<br/>
				Asiste al: <?= $statistic->getporcentajeAsistencias(); ?> % de las actividades en las que está matriculado<br/>
			<?php endforeach; ?>
		</div>
	</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
</div>
