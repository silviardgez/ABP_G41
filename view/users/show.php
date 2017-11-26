<?php
//file: view/users/show.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
//$view->setLayout("welcome");
$users = $view->getVariable("users");
$view->setVariable("title", "Show Users");
?>
<div class="container">
	<div class="table-responsive col-md-4">
		<table class="table">
			<thead>
				<tr>
					<th></th>
					<th class="tittle"><?=i18n("Coaches")?></th>
					<th></th>
				</tr>
				<tr class="active">
					<th><?=i18n("Name")?></th>
					<th><?=i18n("Surname")?></th>
					<th><?=i18n("Actions")?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($users as $user): ?>
					<?php if ($user->getCoach() == 1): ?>
						<tr class="success">
							<td><a href="index.php?controller=users&amp;action=view&amp;dni=<?= $user->getUsername() ?>"><?= htmlentities($user->getName())?></a></td>
							<td><?= htmlentities($user->getSurname()) ?></td>
							<td><form
							method="POST"
							action="index.php?controller=users&amp;action=delete"
							id="delete_user_<?= $user->getUsername(); ?>"
							style="display: inline"
							>

							<input type="hidden" name="id" value="<?= $user->getUsername() ?>">

							<a
							onclick="
							if (confirm('<?= i18n("are you sure?")?>')) {
								document.getElementById('delete_user_<?= $user->getUsername() ?>').submit()
							}"
							><i class="fa fa-trash col-md-6"></i></a>

						</form>
						<a href="index.php?controller=users&amp;action=edit&amp;dni=<?= $user->getUsername() ?>"><i class="fa fa-pencil-square-o col-md-6"></i></a></td>
						</tr>
					<?php endif ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="table-responsive col-md-4">
		<table class="table">
			<thead>
				<tr>
					<th></th>
					<th class="tittle"><?=i18n("Admins")?></th>
					<th></th>
				</tr>
				<tr class="active">
					<th><?=i18n("Name")?></th>
					<th><?=i18n("Surname")?></th>
					<th><?=i18n("Actions")?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($users as $user): ?>
					<?php if ($user->getAdmin() == 1): ?>
						<tr class="success">
							<td><a href="index.php?controller=users&amp;action=view&amp;dni=<?= $user->getUsername() ?>"><?= htmlentities($user->getName())?></a></td>
							<td><?= htmlentities($user->getSurname()) ?></td>
							<td><form
							method="POST"
							action="index.php?controller=users&amp;action=delete"
							id="delete_user_<?= $user->getUsername(); ?>"
							style="display: inline"
							>

							<input type="hidden" name="id" value="<?= $user->getUsername() ?>">

							<a
							onclick="
							if (confirm('<?= i18n("are you sure?")?>')) {
								document.getElementById('delete_user_<?= $user->getUsername() ?>').submit()
							}"
							><i class="fa fa-trash col-md-6"></i></a>

						</form>
						<a href="index.php?controller=users&amp;action=edit&amp;dni=<?= $user->getUsername() ?>"><i class="fa fa-pencil-square-o col-md-6"></i></a></td>
						</tr>
					<?php endif ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="table-responsive col-md-4">
		<table class="table">
			<thead>
				<tr>
					<th></th>
					<th class="tittle"><?=i18n("Athletes")?></th>
					<th></th>
				</tr>
				<tr class="active">
					<th><?=i18n("Name")?></th>
					<th><?=i18n("Surname")?></th>
					<th><?=i18n("Actions")?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($users as $user): ?>
					<?php if ($user->getDeportist() == 1): ?>
						<tr class="success">
							<td><a href="index.php?controller=users&amp;action=view&amp;dni=<?= $user->getUsername() ?>"><?= htmlentities($user->getName())?></a></td>
							<td><?= htmlentities($user->getSurname()) ?></td>
							<td><form
							method="POST"
							action="index.php?controller=users&amp;action=delete"
							id="delete_user_<?= $user->getUsername(); ?>"
							style="display: inline"
							>

							<input type="hidden" name="id" value="<?= $user->getUsername() ?>">

							<a
							onclick="
							if (confirm('<?= i18n("are you sure?")?>')) {
								document.getElementById('delete_user_<?= $user->getUsername() ?>').submit()
							}"
							><i class="fa fa-trash col-md-6"></i></a>

						</form>
						<a href="index.php?controller=users&amp;action=edit&amp;dni=<?= $user->getUsername() ?>"><i class="fa fa-pencil-square-o col-md-6"></i></a></td>
						</tr>
					<?php endif ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="btn-group">
		<a href="index.php?controller=users&amp;action=add" class="btn-fab circulo" id="add">
			<i class="fa fa-plus"></i>
		</a>
	</div>
</div>
