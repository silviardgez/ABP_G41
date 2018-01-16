<?php
// file: view/users/show.php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance ();
// $view->setLayout("welcome");
$users = $view->getVariable ( "users" );
$tableId = $view->getVariable("tableId");

$grupalActivities = $view->getVariable ( "grupalActivities" );

$view->setVariable ( "title", "Show Users in table" );

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<h1 id="bigger-size" class="stroke"><?= i18n("Users assigned to table") . " " . $tableId ?></h1>
			<br>

			<div style="max-width: 40%" class="container-fluid exercise-tables-background">
				<?php foreach ($users as $dni => $name): ?>

					<div class="row">

						<div class="col-xs-10">
							<a style="text-decoration:none; font-size:15px; font-weight: bolder;" href="index.php?controller=users&amp;action=view&amp;dni=<?= $dni?>"><?php echo $dni . " : " . $name; ?></a>
						</div>
						
						<?php if($_SESSION["admin"] || $_SESSION["entrenador"]):?>
							<div class="icons col-xs-1">
								<form method="POST"
								action="index.php?controller=table&amp;action=deleteuser"
								id="delete_user_<?= $dni; ?>" style="display: inline">
								<input type="hidden" name="idtable" value="<?= $tableId ?>">
								<input type="hidden" name="id" value="<?= $dni ?>"> <a
								onclick="
								if (confirm('<?= i18n("are you sure?") ?>')) {
									document.getElementById('delete_user_<?= $dni ?>').submit()
								}"><i class="fa fa-trash"></i></a>

							</form>
						</div>
					<?php endif;?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<button id="btn-styles" type="button" onclick="history.back()"
			class="btn btn-primary btn-lg"><?=i18n("Back")?></button>
		</div>
	</div>
</div>
</div>