<?php
//file: view/assistance/view.php

//include "libchart/libchart.php";
//$chart = new VerticalBarChart(500, 250);

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$statistics = $view->getVariable("statistics");
$view->setVariable("title", "View Statistics");

require_once ('C:\xampp\htdocs\ABP_G41\GoogChart.class.php');
//require_once ('C:\xampp\htdocs\ABP_G41\jpgraph-4.1.1\src\jpgraph_line.php');

?>

<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("Statistics")?></h1>
	<br>
</div>

<div class="col-md-4"></div>
	<div class="row features margin-rows">
		<div class="col-md-5 col-sm-6 item">
			<div class="exercise-tables-background">
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
		</div>
		<?php $datos = $statistic->getArrayAsistentesAño();?>
		<?php endforeach; ?>

    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', '<?=i18n("Times")?>');
        data.addRows([
          ['<?=i18n("January")?>', <?=$datos[0]?>],
          ['<?=i18n("February")?>', <?=$datos[1]?>],
          ['<?=i18n("March")?>', <?=$datos[2]?>],
          ['<?=i18n("April")?>', <?=$datos[3]?>],
          ['<?=i18n("May")?>', <?=$datos[4]?>],
		  ['<?=i18n("June")?>', <?=$datos[5]?>],
		  ['<?=i18n("July")?>', <?=$datos[6]?>],
		  ['<?=i18n("Agoust")?>', <?=$datos[7]?>],
		  ['<?=i18n("September")?>', <?=$datos[8]?>],
		  ['<?=i18n("October")?>', <?=$datos[9]?>],
		  ['<?=i18n("November")?>', <?=$datos[10]?>],
		  ['<?=i18n("December")?>', <?=$datos[11]?>]
        ]);

        // Set chart options
        var options = {'title':'Asistencias del año',
                       'width':500,
                       'height':500};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
	<div id="chart_div"></div>
  </div>
		
	</div>
	</div>
	
	<div class="form-group">
		<div class="col-lg-offset-6 col-lg-6">
			<button type="button" onclick="history.back()"><?=i18n("OK")?></button>
		</div>
	</div>
<div class="col-md-4"></div>