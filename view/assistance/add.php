<?php
//file: view/assistance/view.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$assistants = $view->getVariable("assistants");
$assistance = $view->getVariable("assistance");

$view->setVariable("title", "Add Assistance");
?>

<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("Assistance")?></h1>
	<br>
</div>

<div class="col-md-4"></div>
	<div class="row features margin-rows">
		<div class="col-md-5 col-sm-6 item">
			<div class="exercise-tables-background">
		<h1 id="font-title"><?=i18n("Add assistance")?></h1>
		<br>
			<table id="table-margin" class="table">
				<thead>
							<tr class="active">
							<th><?=i18n("Athlete")?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($assistants as $assistant): ?>
							<form action="index.php?controller=assistance&amp;action=add&amp;id_act=<?= $assistance->getActivityid(); ?>" method="POST">
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
				
				<br/>
				<b><?=i18n("Date")?></b> <input type="date" id="" name="fecha"><br/><br/>
				<b><?=i18n("Time")?></b> <input type="time" id="hora" name="hora" value="<?= $assistance->getTime(); ?>"><br/><br/>
				<button id="button2" type="submit" name="submit"><?=i18n("Add")?></button>			
							</form>
				
		</div>
	</div>
	</div>
	<div class="form-group">
		<div class="col-lg-offset-6 col-lg-6">
			<button type="button" onclick="history.back()"><?=i18n("OK")?></button>
		</div>
	</div>
<div class="col-md-4"></div>