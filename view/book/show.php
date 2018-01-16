<?php
//file: view/sesion/show.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
//$view->setLayout("welcome");

$books = $view->getVariable("books");
$names = $view->getVariable("names");
$confirmed = $view->getVariable("confirmed");

$view->setVariable("title", "Bookings");
$activities = $view->getVariable("activities");
$cont = 0;
?>

<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("Bookings")?></h1>
	<br>
</div>

<div id="center-view" class="center-block col-xs-12 col-lg-8 col-sm-10 item">
	<div class="exercise-tables-background center-block">
		<?php if($confirmed == 0): ?>
			<h1 id="font-title"><?=i18n("Bookings not confirmed")?></h1>
		<?php else: ?>
			<h1 id="font-title"><?=i18n("Bookings confirmed")?></h1>
		<?php endif;?>
		<br>
		<table id="table-margin" class="table">
			<thead>
				<tr>
					<th><?=i18n("Name user")?></th>
					<th><?=i18n("Activity name")?></th>
					<th><?=i18n("Activity day")?></th>
					<th><?=i18n("Activity hour")?></th>
					<th><?=i18n("Date of reservation")?></th>
					<th style="min-width: 8em"><?=i18n("Hour of reservation")?></th>
					<th style="min-width: 8em"><?=i18n("Status")?></th>
					<?php if($confirmed == 0): ?>
						<th><?=i18n("Actions")?></th>
					<?php endif; ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($books as $book):?>
					<?php if ($book['confirmed'] == $confirmed):
					$cont = 1?>
						<tr>
							<td><?= $book['userName'] ?></td> <!-- Devuelve el nombre del usuario-->
							<td><?= $book['actName'] ?></td>
							<td><?= i18n($book['actDay']) ?></td>
							<td><?= substr($book['actHour'], 0, 5) ?></td> 
							<td><?= $book['dateBook'] ?></td>
							<td><?= $book['hour'] ?></td>
							<?php if($confirmed == 1): ?>
								<td><?=i18n("Confirmed")?></td>
							<?php else: ?>
								<td><?=i18n("Not confirmed")?></td>
								<td class="icons">
									<a href="index.php?controller=book&action=changeConfirmedStatus&idAct=<?= $book['idAct'] ?>&idAthl=<?= $book['idAthl'] ?>&status=1">
										<i class="fa fa-check-square-o col-md-3" onclick="return confirm('<?=i18n("are you sure?")?>')"></i></a>
										<form method="POST" action="index.php?controller=book&amp;action=delete" id="delete_book_<?=$book['idAct']?>-<?=$book['idAthl']?>" style="display: inline">
											<input type="hidden" name="ids" value="<?=$book['idAct']?>-<?=$book['idAthl']?>">
											<a onclick="if (confirm('<?= i18n("are you sure?")?>')) {document.getElementById('delete_book_<?=$book['idAct']?>-<?=$book['idAthl']?>').submit()}"><i class="fa fa-trash col-md-6"></i></a>
										</form>
									</td>
								<?php endif;?>
							</tr>
						<?php endif; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php if($cont!=1 && $confirmed==0): ?>
				<br/>
				<h4 class="aviso-vacio"><b><?= i18n("No reservations without confirmed"); ?></b></h4>
			<?php elseif($cont!=1 && $confirmed==1): ?>
				<br/>
				<h4 class="aviso-vacio"><b><?= i18n("No reservations confirmed"); ?></b></h4>
			<?php endif; ?>
		</div>

	</div>

	<div id="center-view" class="center-block">
		<?php if($confirmed == 1): ?>
			<a role="button" id="btn-styles" href="index.php?controller=book&amp;action=show" class="btn btn-success btn-lg"><?=i18n("Go to unconfirmed reservations");?></a>
		<?php else: ?>
			<a role="button" id="btn-styles" href="index.php?controller=book&amp;action=show&amp;confirmed=1" class="btn btn-success btn-lg"><?=i18n("Go to confirmed reservations");?></a>
		<?php endif; ?>
	</div>
	<br/>