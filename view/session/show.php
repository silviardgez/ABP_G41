<?php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance ();

$sessions = $view->getVariable ( "sessions" );

$view->setVariable ( "title", "Show Sessions" );
?>
<div>
	<?php if(!isset($_REQUEST["entrena"]) && $_SESSION["deportista"]):?>
	<h1 id="bigger-size" class="stroke"><?=i18n("Sessions of the user: ") . $_SESSION["currentuser"]; ?></h1>
	<?php if($_SESSION["entrenador"] && $_SESSION["deportista"]): ?>
	<a id="link-view" href="index.php?controller=session&amp;action=show&amp;entrena=true"><?= i18n("Go to: Coach View")?></a>
	<?php endif;?>
	<?php elseif($_SESSION["entrenador"]):?>
	<h1 id="bigger-size" class="stroke"><?=i18n("Sessions")?></h1>
	<?php if($_SESSION["deportista"]):?>
	<a id="link-view" href="index.php?controller=session&amp;action=show"><?= i18n("Go to: Client View")?></a>
	<?php endif;?>
	<?php endif;?>
	<br>
	<?php if(!isset($_REQUEST["entrena"]) && $_SESSION["deportista"]):?>
	<div id="center-view">
		<a href="index.php?controller=session&amp;action=crono" id="btn-session" class="center-block btn btn-success btn-lg" role="button"><b><?= i18n("Start a new session");?>
		</b></a>
	</div>
	<br/>
	<?php endif;?>
</div>

<div class="container-fluid">
<div id="center-view" class="center-block col-xs-11 col-sd-9 col-md-7">
	<div class="width-session exercise-tables-background">
		<table id="table-margin" class="width-session-table table">
			<tr>
				<th id="center-text"><?=i18n("Table")?></th>
				<?php if(isset($_REQUEST["entrena"]) || ($_SESSION["entrenador"] && !$_SESSION["deportista"])):?>
				<th id="center-text"><?=i18n("User")?></th>
				<?php endif;?>
				<th id="center-text"><?=i18n("Day")?></th>
				<th id="center-text"><?=i18n("Start time")?></th>
				<th id="center-text"><?=i18n("End time")?></th>
				<th id="center-text"><?=i18n("Duration")?></th>
				<th id="center-text"><?=i18n("Observations")?></th>
				<?php if(!isset($_REQUEST["entrena"]) && $_SESSION["deportista"]):?>
				<th id="center-text"><?=i18n("Actions")?></th>
				<?php endif;?>
			</tr>
				<?php foreach ($sessions as $session): ?>
						<tr>
				<td id="center-text"><a href="index.php?controller=table&amp;action=view"
					style="color: #669"><strong><?= i18n("Table") . " " . $session->getIdTable() ?></strong></a></td>
				<?php if(isset($_REQUEST["entrena"]) || ($_SESSION["entrenador"] && !$_SESSION["deportista"])):?>
				<td id="center-text"><?php echo $session->getDNIUser(); ?></td>
				<?php endif; ?>
				<td id="center-text"><?php echo $session->getSessionDay(); ?></td>
				<td id="center-text"><?php echo substr($session->getSessionHourIni(),0,5); ?></td>
				<td id="center-text"><?php echo substr($session->getSessionHourFin(),0,5); ?></td>
				<td id="center-text"><?php echo $session->getDuration(); ?></td>
				<td id="center-text"><?php echo $session->getObservations(); ?></td>
				<?php if(!isset($_REQUEST["entrena"]) && $_SESSION["deportista"]):?>
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
				<?php endif;?>
			</tr>
				<?php endforeach; ?>
		</table>
	</div>
</div>
</div>

