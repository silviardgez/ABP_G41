<?php
//file: view/users/show.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
//$view->setLayout("welcome");
$users = $view->getVariable("users");
$view->setVariable("title", "Show Users");
?>


<section class="pagecontent">
	<div class="users">
		<div class="margin">
			<div class="home2">
				<h1><?=i18n("Admins")?></h1><br>
				<?php foreach ($users as $user): ?>
					<?php if ($user->getAdmin() == 1): ?>
						
						<a href="index.php?controller=users&amp;action=view&amp;dni=<?= $user->getUsername() ?>"><?= htmlentities($user->getName()); echo ' '.htmlentities($user->getSurname()) ?></a>
						<div class="icons">
							<form
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
							><i class="fa fa-trash"></i></a>

						</form>
						<a href="index.php?controller=users&amp;action=edit&amp;dni=<?= $user->getUsername() ?>"><i class="fa fa-pencil-square-o"></i></a>
					</div>
					

				<?php endif ?>
			<?php endforeach; ?>
		</div>	
	</div>

	<div class="margin">
		<div class="home2">
			<h1><?=i18n("Coaches")?></h1><br>
			<?php foreach ($users as $user): ?>
				<?php if ($user->getCoach() == 1): ?>
					
					<a href="index.php?controller=users&amp;action=view&amp;dni=<?= $user->getUsername() ?>"><?= htmlentities($user->getName()); echo ' '.htmlentities($user->getSurname()) ?></a>
					<div class="icons">
						<form
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
						><i class="fa fa-trash"></i></a>

					</form>
					<a href="index.php?controller=users&amp;action=edit&amp;dni=<?= $user->getUsername() ?>"><i class="fa fa-pencil-square-o"></i></a>
				</div>
			<?php endif ?>
		<?php endforeach; ?>
	</div>	
</div>

<div class="margin">
	<div class="home2">
		<h1><?=i18n("Deportists")?></h1><br>
		<?php foreach ($users as $user): ?>
			<?php if ($user->getDeportist() == 1): ?>

				<a href="index.php?controller=users&amp;action=view&amp;dni=<?= $user->getUsername() ?>"><?= htmlentities($user->getName()); echo ' '.htmlentities($user->getSurname()) ?></a>
				<div class="icons">
					<form
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
					><i class="fa fa-trash"></i></a>

				</form>
				<a href="index.php?controller=users&amp;action=edit&amp;dni=<?= $user->getUsername() ?>"><i class="fa fa-pencil-square-o"></i></a>
			</div>
		<?php endif ?>
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
