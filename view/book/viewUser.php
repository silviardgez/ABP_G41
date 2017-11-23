<?php
//file: view/sesion/show.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
//$view->setLayout("welcome");
$bookings = $view->getVariable("bookings");
$users = $view->getVariable("user");
$view->setVariable("title", "Bookings");
?>


<section class="pagecontent">
	<div class="users">
		<div class="margin">
			<div class="home2">
        <a href="index.php?controller=book&amp;action=add"><i class="fa fa-plus"></i></a>
				<h1><?=i18n("Bookings")?></h1><br>
				<?php foreach ($bookings as $booking): ?>
        <a href="index.php?controller=book&amp;action=viewUser&amp;id_act=<?= $booking->getIdAct() ?>"><?= htmlentities($booking->getConfirmed()) ?></a>
			<?php endforeach; ?>
		</div>
	</div>

</section>
