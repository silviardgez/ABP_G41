<?php
//file: view/sesion/show.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
//$view->setLayout("welcome");

$books = $view->getVariable("books");
$names = $view->getVariable("names");
$view->setVariable("title", "Bookings");
$activities = $view->getVariable("activities");
?>


<!-- if usuario = admin or coach-->
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
						<th><?=i18n("Confirmed")?></th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($books as $book):?>
						<?php
						if ($book['confirmed'] == 1):
							?>
							<tr class = "success">

								<td><?= $book['userName'] ?></td> <!-- Devuelve el nombre del usuario-->
								<td><?= $book['actName'] ?></td> <!-- Devuelve el nombre de la actividad-->
								<td><?= $book['dateBook'] ?></td>
								<td><?= $book['hour'] ?></td>
								<td>
									<input disabled type="checkbox" name="confirmed" value="<?= $book['confirmed'] ?>" checked>
										Confirmed
									<a href="index.php?controller=book&action=changeConfirmedStatus&idAct=<?= $book['idAct'] ?>&idAthl=<?= $book['idAthl'] ?>&status=0">Decline</a>

								</td>
							</tr>
					<?php endif; ?>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>

		<div class="table-responsive col-md-6">
			<table class="table">
				<thead><tr>
					<th class="tittle" colspan="5"><?=i18n("Bookings not confirmed")?></th>
				</tr>
					<tr class="active">
						<th><?=i18n("Name user")?></th>
						<th><?=i18n("Name activity")?></th>
						<th><?=i18n("Date of reservation")?></th>
						<th><?=i18n("Hour of reservation")?></th>
						<th><?=i18n("Confirmed")?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($books as $book):?>
						<?php if ($book['confirmed']==0): ?>
							<tr class = "success">
								<td><?= $book['userName'] ?></td> <!-- Devuelve el nombre del usuario-->
								<td><?= $book['actName'] ?></td> <!-- Devuelve el nombre de la actividad-->
								<td><?= $book['dateBook'] ?></td>
								<td><?= $book['hour'] ?></td>
								<td>
									<input disabled type="checkbox" name="confirmed" value="<?= $book['confirmed'] ?>">
									Not confirmed
									<a href="index.php?controller=book&action=changeConfirmedStatus&idAct=<?= $book['idAct'] ?>&idAthl=<?= $book['idAthl'] ?>&status=1">Confirm</a>
								</td>
							</tr>
					<?php endif ?>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
