<?php
//file: view/sesion/show.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
//$view->setLayout("welcome");
$sesions = $view->getVariable("sesions");
$user = $view->getVariable("user");
$view->setVariable("title", "Show Sesions");
?>


<section class="pagecontent">
	<div class="users">
		<div class="margin">
			<div class="home2">
				<a href="index.php?controller=sesion&amp;action=add"><i class="fa fa-plus"></i></a>
				<h1><?=i18n("Sessions")?></h1><br>
				<?php foreach ($sesions as $sesion): ?>

            <a href="index.php?controller=sesion&amp;action=view&amp;id_sesion=<?= $sesion->getIdSesion() ?>"><?= htmlentities($sesion->getIdSesion()); echo ' '.htmlentities($sesion->getObservation()) ?></a>
						<div class="icons">
							<form
							method="POST"
							action="index.php?controller=sesion&amp;action=delete"
							id="delete_sesion_<?= $sesion->getIdSesion(); ?>"
							style="display: inline"
							>

							<input type="hidden" name="id" value="<?= $sesion->getIdSesion() ?>">

							<a
							onclick="
							if (confirm('<?= i18n("are you sure?")?>')) {
								document.getElementById('delete_sesion_<?= $sesion->getIdSesion() ?>').submit()
							}"
							><i class="fa fa-trash"></i></a>

						</form>
						<a href="index.php?controller=sesion&amp;action=edit&amp;id=<?= $sesion->getIdSesion() ?>"><i class="fa fa-pencil-square-o"></i></a>
					</div>


			<?php endforeach; ?>
		</div>
	</div>

</section>
