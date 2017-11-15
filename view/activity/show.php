<?php
//file: view/users/show.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
//$view->setLayout("welcome");
$activities = $view->getVariable("grupalActivities");
$view->setVariable("title", "Show Activities");
?>


<section class="pagecontent">
	<div class="activity">
		<div class="margin">
			<div class="home2">
				<h1><?=i18n("Activities")?></h1><br>
				<?php foreach ($activities as $activity): ?>
				<a href="index.php?controller=activity&amp;action=view&amp;dni=<?= $activity->getActivityName() ?>"><?= htmlentities($activity->getActivityName()) ?></a>
					<div class="icons">
						<form
						method="POST"
						action="index.php?controller=users&amp;action=delete"
						id="delete_activity_<?= $activity->getActivityName(); ?>"
						style="display: inline"
						>

						<input type="hidden" name="id" value="<?= $activity->getActivityName() ?>">

						<a 
						onclick="
						if (confirm('<?= i18n("are you sure?")?>')) {
							document.getElementById('delete_user_<?= $activity->getActivityName() ?>').submit()
						}"
						><i class="fa fa-trash"></i></a>

						</form>
						<a href="index.php?controller=users&amp;action=edit&amp;dni=<?= $activity->getActivityName() ?>"><i class="fa fa-pencil-square-o"></i></a>
					</div>

				<?php endforeach; ?>
			</div>	
		</div>	
	</div>	
<div class="row">
	<div class="btn-group">
		<a href="index.php?controller=users&amp;action=add" class="btn-fab circulo" id="add">
			<i class="fa fa-plus"></i>
		</a>
	</div>
</div>
</section>