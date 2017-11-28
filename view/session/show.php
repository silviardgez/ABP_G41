<?php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance ();

$sessions = $view->getVariable ( "sessions" );
$personalSessions = $view->getVariable ( "personalSessions" );

$view->setVariable ( "title", "Show Sessions" );
?>
<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("Sessions")?></h1>
	<br>
	<div class="btn-group">
		<a href="index.php?controller=training&amp;action=add"
			class="btn-fab circulo btn-training" id="add"> <i class="fa fa-plus"></i>
		</a>
	</div>
</div>


<div class="container-fluid">
<div id="center-view" class="center-block col-xs-6 col-md-7">
	<div class="exercise-tables-background">
		<table id="table-margin" class="table">
			<tr>
				<th><?=i18n("Table")?></th>
				<th id="center-text"><?=i18n("Day")?></th>
				<th id="center-text"><?=i18n("Hour")?></th>
				<th id="center-text"><?=i18n("Observations")?></th>
				<th id="center-text"><?=i18n("Actions")?></th>
			</tr>
					<?php foreach ($sessions as $session): ?>
						<tr>
				<td><a href="index.php?controller=table&amp;action=view"
					style="color: #669"><strong><?= i18n("Table") . " " . $session->getIdClientTable() ?></strong></a></td>
				<td id="center-text"><?php echo $session->getSessionDay(); ?></td>
				<td id="center-text"><?php echo $session->getSessionHour(); ?></td>
				<td id="center-text"><?php echo $session->getObservation(); ?></td>
				<td class="icons"><a
					href="index.php?controller=session&amp;action=edit&amp;id=<?= $session->getSessionId()?>"><i
						class="fa fa-pencil-square-o"></i></a>
					<form method="POST"
						action="index.php?controller=session&amp;action=delete"
						id="delete_session_<?= $session->getSessionId(); ?>"
						class="none-styles" style="display: inline">

						<input type="hidden" name="id"
							value="<?= $session->getSessionId() ?>"> <a
							onclick="
								if (confirm('<?= i18n("are you sure?")?>')) {
									document.getElementById('delete_session_<?= $session->getSessionId() ?>').submit()
								}"><i class="fa fa-trash"></i></a>

					</form></td>
			</tr>
					<?php endforeach; ?>
		</table>
	</div>
</div>
</div>

