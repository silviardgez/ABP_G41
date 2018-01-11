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

<div id="edit-view" class="center-block col-xs-6 col-lg-6">
		<br>
		<h1 id="font-title"><?=i18n("Athlete Statistics")?></h1>
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
							<td><?=i18n("He attends")?> <?= $statistic->getAsistenciaActividades(); ?> <?=i18n("activities")?></td>
						</tr>
						<tr>
							<td><?=i18n("He is enroller in")?> <?= $statistic->getMatriculas(); ?> <?=i18n("activities")?></td>
						</tr>
						<tr>
							<td><?=i18n("He has attend")?> <?= $statistic->getAsistenciasTotales(); ?> <?=i18n("times to the gym")?></td>
						</tr>
						<tr>
							<td><?=i18n("He attends to")?> <?= $statistic->getporcentajeAsistencias(); ?> <?=i18n("% of the activities in which you are enrolled")?></p>
						</tr>
						<?php $datos = $statistic->getTiempos();?>
				<?php endforeach; ?>
				</tbody>
			</table>

		
		
		
		
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
			data.addColumn('number', '<?=i18n("Minutes")?>');
			data.addRows([
				 <?php for($i = 0; $i < count($datos); $i++): ?> 
					<?php
						list($horas, $minutos, $segundos) = explode(':', $datos[$i]['D']);
						$tiempo = ($horas * 60 ) + ($minutos) + ($segundos/60);
					?>
					['<?=$datos[$i]['F']?>', <?=$tiempo?>],
				 
				 <?php endfor;?>
			  
			]);

			// Set chart options
			var options = {'title':'<?=i18n("Session duration")?>',
						   'width':600,
						   'height':500};

			// Instantiate and draw our chart, passing in some options.
			var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
			chart.draw(data, options);
		  }
		</script>
		<div id="chart_div"></div>
		
		
		
<br/>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<button id="btn-styles" type="button" onclick="history.back()" class="btn btn-warning btn-lg"><?=i18n("Back")?></button>
		</div>
	</div>



