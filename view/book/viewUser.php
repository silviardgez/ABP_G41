<?php
//file: view/sesion/show.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
//$view->setLayout("welcome");
$books = $view->getVariable("books");
$users = $view->getVariable("user");
$view->setVariable("title", "Bookings");
?>


<div class="container">
	<div class="table-responsive col-md-6">
		<table class="table">
			<thead><tr>
				<th class="tittle" colspan="5" colspan="5"><?=i18n("Bookings confirmed")?></th>
			</tr>
				<tr class="active">
					<th><?=i18n("Name user")?></th>
					<th><?=i18n("Name activity")?></th>
					<th><?=i18n("Date of reservation")?></th>
					<th><?=i18n("Hour of reservation")?></th>
					<th><?=i18n("Status")?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($books as $book):?>
						<tr class = "success">

							<td><?= $book['userName'] ?></td> <!-- Devuelve el nombre del usuario-->
							<td><?= $book['actName'] ?></td> <!-- Devuelve el nombre de la actividad-->
							<td><?= $book['dateBook'] ?></td>
							<td><?= $book['hour'] ?></td>
							<td>
								<?php if ($book['confirmed']==1):
										echo i18n("Confirmed");
								elseif ($book['confirmed']==0):
										echo i18n("Not confirmed");
									endif
									?>

							</td>
						</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
