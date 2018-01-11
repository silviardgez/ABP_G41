<?php
// file: view/users/showPef.php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance ();
// $view->setLayout("welcome");
$users = $view->getVariable ( "users" );
$view->setVariable ( "title", "Show PEF Users" );
?>

<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("PEF Users")?></h1>
	<br>
</div>


<div id="center-view" class="center-block col-md-6 col-sm-8 item">
	<div class="exercise-tables-background center-block">
		<h1 id="font-title"><?=i18n("Athletes"); echo " PEF"?></h1>
		<br>
		<table id="table-margin" class="table">
			<thead>
				<tr>
					<th><?=i18n("Surname")?></th>
					<th><?=i18n("Name")?></th>
					<th><?=i18n("Actions")?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($users as $user): ?>
					<?php if ($user->getDeportistPef() == 1): ?>
						<tr>
							<td><?= htmlentities($user->getSurname()) ?></td>
							<td><?= htmlentities($user->getName())?></td>
							<td class="icons">
								<a href="index.php?controller=users&amp;action=view&amp;dni=<?= $user->getUsername() ?>">
									<i class="fa fa-search col-md-3"></i></a>
									<form method="POST"
									action="index.php?controller=users&amp;action=delete"
									id="delete_user_<?= $user->getUsername(); ?>"
									style="display: inline">

									<input type="hidden" name="id"
									value="<?= $user->getUsername() ?>"> <a
									onclick="
									if (confirm('<?= i18n("are you sure?")?>')) {
										document.getElementById('delete_user_<?= $user->getUsername() ?>').submit()
									}"><i class="fa fa-trash col-md-3"></i></a>

								</form> <a
								href="index.php?controller=users&amp;action=edit&amp;dni=<?= $user->getUsername() ?>"><i
								class="fa fa-pencil-square-o col-md-3"></i></a></td>
							</tr>
						<?php endif ?>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>


	<div class="btn-group">
		<a href="index.php?controller=users&amp;action=add"
		class="btn-fab circulo btn-training" id="add"> <i class="fa fa-plus"></i>
	</a>
</div>

