<?php
//file: view/sesion/show.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
//$view->setLayout("welcome");

$users = $view->getVariable("users");
$view->setVariable("title", "Bookings");
?>


<section class="pagecontent">
	<div class="users">
		<div class="margin">
			<div class="home2">
				<h1><?=i18n("Users")?></h1><br>
				<?php foreach ($users as $user): ?>

            <?= htmlentities($user->getName()); echo ' '.htmlentities($user->getSurname()) ?>
						<div class="icons">
            <a href="index.php?controller=book&amp;action=viewUser"><i class="fa fa-eye"></i></a>
					</div>

			<?php endforeach; ?>
		</div>
	</div>
</div>

</section>
