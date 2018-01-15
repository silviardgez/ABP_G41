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
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "<?=i18n("Minutes")?>", { role: "style" } ],
		<?php for($i = 0; $i < count($datos); $i++): ?> 
					<?php
						list($horas, $minutos, $segundos) = explode(':', $datos[$i]['D']);
						$tiempo = ($horas * 60 ) + ($minutos) + ($segundos/60);
					
						$dia = $datos[$i]['F'];
					
					?>
					
					['<?=$dia?>', <?=$tiempo?>, "silver"],
				 
				 <?php endfor;?>

      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "<?=i18n("Session duration in minutes")?>",
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>
<div id="columnchart_values" ></div>

	</div>

	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<button id="btn-styles" type="button" onclick="history.back()" class="btn btn-info btn-lg"><?=i18n("Back")?></button>
		</div>
	</div>
		<br/>
		<br/>


