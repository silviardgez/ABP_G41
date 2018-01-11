<?php
//file: view/assistance/view.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$statistics = $view->getVariable("statistics");
$view->setVariable("title", "View Statistics");

require_once (__DIR__."/../../GoogChart.class.php");

?>

<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("Statistics")?></h1>
	<br>
</div>

<div id="edit-view" class="center-block col-xs-7 col-lg-7">
		<br>
				<h1 id="font-title"><?=i18n("Activity Statistics")?></h1>
				<br>
				<table id="table-margin" class="table">
					<thead>
						<tr class="active">
							<th><?=i18n("Statistics")?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($statistics as $statistic): ?>
							<tr>
								<td><?=i18n("Total of athletes in the gym")?> <?= $statistic->getDeportistas(); ?></td>
							</tr>
							<tr>
								<td><?=i18n("Enrolled")?> <?= $statistic->getMatriculados(); ?></td>
							</tr>
							<tr>
								<td><?=i18n("Percentage of enrolled")?> <?= $statistic->getPorcentajeMatriculados(); ?> %</td>
							</tr>
							<tr>
								<td><?=i18n("Assistants")?> <?= $statistic->getAsistentes(); ?></p>
							</tr>
							<tr>
								<td><?=i18n("Percentage of assistants")?> <?= $statistic->getPorcentajeAsistentes(); ?> %</td>
							</tr>
					</tbody>
				</table>

		<?php $datos = $statistic->getArrayAsistentesAño();?>
		<?php endforeach; ?>

    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	  <script type="text/javascript">
		google.charts.load("current", {packages:['corechart']});
		google.charts.setOnLoadCallback(drawChart);
		function drawChart() {
		  var data = google.visualization.arrayToDataTable([
			["Element", "<?=i18n("Times")?>", { role: "style" } ],
			['<?=i18n("January")?>', <?=$datos[0]?>, "silver"],
			['<?=i18n("February")?>', <?=$datos[1]?>, "silver"],
			['<?=i18n("March")?>', <?=$datos[2]?>, "silver"],
			['<?=i18n("April")?>', <?=$datos[3]?>, "silver"],
			['<?=i18n("May")?>', <?=$datos[4]?>, "silver"],
			['<?=i18n("June")?>', <?=$datos[5]?>, "silver"],
			['<?=i18n("July")?>', <?=$datos[6]?>, "silver"],
			['<?=i18n("August")?>', <?=$datos[7]?>, "silver"],
			['<?=i18n("September")?>', <?=$datos[8]?>, "silver"],
			['<?=i18n("October")?>', <?=$datos[9]?>, "silver"],
			['<?=i18n("November")?>', <?=$datos[10]?>, "silver"],
			['<?=i18n("December")?>', <?=$datos[11]?>, "silver"],
		  ]);

		  var view = new google.visualization.DataView(data);
		  view.setColumns([0, 1,
						   { calc: "stringify",
							 sourceColumn: 1,
							 type: "string",
							 role: "annotation" },
						   2]);

		  var options = {
			title: "<?=i18n("Anual assistances")?>",
			width: 1200,
			height: 300,
			legend: { position: "none" },
		  };
		  var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
		  chart.draw(view, options);
	  }
	  </script>
	  <div id="columnchart_values" style="width: 900px; height: 300px;"></div>
  	</div>
	
	<div class="form-group">
		<div class="col-sm-12">
			<button id="btn-styles" type="button" onclick="history.back()" class="btn btn-warning btn-lg"><?=i18n("Back")?></button>
		</div>
	</div>