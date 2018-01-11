<?php
//file: view/assistance/view.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$assistants = $view->getVariable("assistants");
$assistance = $view->getVariable("assistance");
$errors = $view->getVariable ( "errors" );

$view->setVariable("title", "Add Assistance");
?>

<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("Add Assistance")?></h1>
	<br>
</div>

<div id="edit-view" class="center-block col-xs-6 col-lg-6">
<br>
<form action="index.php?controller=assistance&amp;action=add&amp;id_act=<?= $assistance->getActivityid(); ?>" method="POST" class="center-block form-horizontal">
			<table id="table-margin" class="table">
				<thead>
							<tr class="active">
							<th><?=i18n("Athlete")?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($assistants as $assistant): ?>
								<tr>
									<input type="hidden" name="id_act" value="<?= $assistance->getActivityid(); ?>">

									<td>
										<?= $assistant->getDni(); ?>
										<label>
											<a href="index.php?controller=users&amp;action=view&amp;dni=<?= $assistant->getDni(); ?>">
												<i class="fa fa-search col-md-3"></i>
											</a>
										</label>
										<input type="checkbox" name="asistentes[]" value="<?= $assistant->getDni(); ?>">

									</td>


								</tr><?php endforeach; ?>

					</tbody>
			</table>

				<br>
				<div class="form-group">
					<label class="control-label text-size text-muted col-sm-4"><?=i18n("Date")?> <b class="aviso-vacio"><?= isset($errors["dateassistance"])?i18n($errors["dateassistance"]):"" ?></b></label>
					<div class="col-lg-6">
					 <input class="form-control" type="date" id="" name="fecha"><br/><br/>
				 	</div>
				</div>

			 <div class="form-group">
					<label class="control-label text-size text-muted col-sm-4"><?=i18n("Time")?><b class="aviso-vacio"><?= isset($errors["timeassistance"])?i18n($errors["timeassistance"]):"" ?></b></label>
					<div class="col-lg-6">
						<input class="form-control" type="time" id="hora" name="hora" value="<?= $assistance->getTime(); ?>"><br/><br/>
					</div>
			 </div>

				<div class="form-group">
					<div class="col-sm-6">
						<button id="btn-styles" type="button" onclick="history.back()" class="btn btn-warning btn-lg"><?=i18n("Back")?></button>
					</div>
					<div class="col-sm-6">
						<button id="btn-styles" type="submit" name="submit" class="btn btn-success btn-lg"><?=i18n("Add")?></button>
					</div>
				</div>
			</form>

</div>
