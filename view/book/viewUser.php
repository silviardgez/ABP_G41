<?php
//file: view/sesion/show.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
//$view->setLayout("welcome");
$books = $view->getVariable("books");
$users = $view->getVariable("user");
$view->setVariable("title", "Bookings");
?>

<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("Bookings")?></h1>
	<br>
</div>

<div id="center-view" class="center-block col-md-6 col-sm-8 item">
	<div class="exercise-tables-background center-block">
		<br>
		<table id="table-margin" class="table">
				<thead>
					<tr>
						<th><?=i18n("Activity")?></th>
						<th><?=i18n("Date of reservation")?></th>
						<th><?=i18n("Hour of reservation")?></th>
						<th><?=i18n("Status")?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($books as $book):?>
							<tr>
								<td><?= $book['actName'] ?></td> <!-- Devuelve el nombre de la actividad-->
								<td><?= $book['dateBook'] ?></td>
								<td><?= $book['hour'] ?></td>
								<td>
									<?php if ($book['confirmed']==1):
											echo i18n("Confirmed");
									elseif ($book['confirmed']==0):
											echo i18n("Not confirmed");
										endif?>

								</td>
							</tr>
					<?php endforeach; ?>
				</tbody>
		</table>
	</div>
</div>
