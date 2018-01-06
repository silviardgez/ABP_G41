<!DOCTYPE html>
<?php
// file: view/users/show.php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance ();
// $view->setLayout("welcome");
$activitiesName = $view->getVariable ( "activitiesName" );

$grupalActivities = $view->getVariable ( "grupalActivities" );

$view->setVariable ( "title", "Show Activities" );
$rows = 3;
$weekDays = array (
	i18n ( "Monday" ),
	i18n ( "Tuesday" ),
	i18n ( "Wednesday" ),
	i18n ( "Thursday" ),
	i18n ( "Friday" ),
	i18n ( "Saturday" ),
	i18n ( "Sunday" ) 
);
$hours = array (
	'09:00-10:00',
	'10:00-11:00',
	'11:00-12:00',
	'12:00-13:00',
	'13:00-14:00',
	'14:00-15:00',
	'15:00-16:00',
	'16:00-17:00',
	'17:00-18:00',
	'18:00-19:00',
	'19:00-20:00',
	'20:00-21:00',
	'21:00-22:00' 
);

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-md-4">
			<div class="col-xs-12">
				<h1 id="bigger-size" class="stroke"><?= i18n("Activities") ?></h1>
				<br>

				<div id="activities-box" class="container-fluid activities-tables-background">
					<?php foreach ($activitiesName as $activity): ?>

						<div class="row">

							<div class="col-xs-1">
								<input type="checkbox" id="chk_<?= htmlentities($activity) ?>"
								checked="checked"
								onclick="filterActivities('<?= htmlentities($activity) ?>');">
							</div>
							<div class="col-xs-6">
								<?= htmlentities($activity) ?>
							</div>

							<?php if($_SESSION["admin"] || $_SESSION["entrenador"]):?>
								<div class="icons col-xs-1">
									<a
									href="index.php?controller=activity&amp;action=add&amp;name=<?= $activity ?>"><i
									class="fa fa-plus"></i></a>
								</div>
								<div class="icons col-xs-1">
									<form method="POST"
									action="index.php?controller=activity&amp;action=delete"
									id="delete_activity_<?= $activity; ?>" style="display: inline">

									<input type="hidden" name="id" value="<?= $activity ?>"> <a
									onclick="
									if (confirm('<?= i18n("are you sure?") ?>')) {
										document.getElementById('delete_activity_<?= $activity ?>').submit()
									}"><i class="fa fa-trash"></i></a>

								</form>
							</div>
							<div class="icons col-xs-1">

								<a
								href="index.php?controller=activity&amp;action=edit&amp;name=<?= $activity ?>"><i
								class="fa fa-pencil-square-o"></i></a>
							</div>
						<?php endif;?>
					</div>
				<?php endforeach; ?>
			</div>
			<div id="activities-button-box" class="container-fluid">
				<?php if($_SESSION["admin"] || $_SESSION["entrenador"]):?>
					<a href="index.php?controller=activity&amp;action=add"
					class="btn-fab circulo right-ubication" id="add"> <i class="fa fa-plus"></i>
				<?php endif; ?>
				</a>
			</div>
		</div>
	</div>


	<div class="col-md-8 col-xs-12">
		<div id="activitiesBody" class="actTable_container">
			<div id='actTable_col_hours' class="actTable_col">
				<div class="actTable_header">
					<?= i18n("Hours")?>
				</div>
				<?php
				foreach ( $hours as $hour ) :
					?> 
					<div class="actTable_hour vertical_middle_text"><?=  $hour ;?></div>
				<?php endforeach; ?>
			</div>

			<?php
			$pos = 0;
			foreach ( $weekDays as $day ) :
				?>

				<div class="actTable_col">
					<div class="actTable_header">
						<?= $day ;?>
					</div>


					<?php
					$currentHour = 9;
					foreach ( $grupalActivities [$pos] as $activity ) :
						$margin = 0;
						$activityHour = substr ( $activity->getStartTime (), 0, 2 );
						$activityMin = substr ( $activity->getStartTime (), 3, 2 );
						$margin += ($activityHour - $currentHour) * 4;
						if ($activityMin == 15)
							$margin += 1;
						if ($activityMin == 30)
							$margin += 2;
						if ($activityMin == 45)
							$margin += 3;
						$currentHour += ($activity->getDuration () + $margin / 4);
						?>
						<div style="margin-top: <?php echo $margin?>em; height: <?php echo $activity->getDuration()*4;?>em; background-color: <?php echo $activity->getColor();?>" class="actTable_activities vertical_middle_text box_<?=$activity->getActivityName();?>">
							<a id="link-activity"
							href="index.php?controller=activity&amp;action=editcurrent&amp;id=<?= $activity->getActivityId() ?>"><?=  $activity->getActivityName() ?></a>
							<i><small><?= "\n" . substr($activity->getStartTime(),0,5) . "-" . substr($activity->getEndTime(),0,5) ?></small></i>
						</div>					
					<?php endforeach;
					if ($pos != 6)
						$pos ++;
					?>

				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
</div>
