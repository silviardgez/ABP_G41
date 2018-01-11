<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

//$view->setLayout("welcome");
$deportists = $view->getVariable("deportists");
$view->setVariable("title", "Show deportists");
?>

<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("Statistics")?></h1>
	<br>
</div>

<div id="edit-view" class="center-block col-xs-6 col-lg-6">
		<br>
		<h1 id="font-title"><?=i18n("Athletes")?></h1>
		<br>
			<table id="table-margin" class="table">
				<thead>
					<tr>
						<th><?=i18n("View user")?></th>
						<th><?=i18n("Name")?></th>
						<th><?=i18n("Month")?></th>
						<th><?=i18n("Table")?></th>
						<th><?=i18n("Watch")?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($deportists as $deportist): ?>
					
						<form action="index.php?controller=athletesstatistics&amp;action=view&amp;dni=<?= $deportist->getDni(); ?>" method="POST">
							<input type="hidden" name="dni" value="<?= $deportist->getDni(); ?>">
							
							<tr>
								<td><?= $deportist->getDni(); ?><a href="index.php?controller=users&amp;action=view&amp;dni=<?= $deportist->getDni(); ?>"><i class="icons fa fa-search col-md-3"></i> </a></td>
					
								<td><?= $deportist->getDeportistname();?> <?= $deportist->getDeportistsurname();?></td>
								<td>
									<select name="mes">
										<option value="1" selected="selected">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
									</select>
								</td>
								<td>
									<select name="tabla">
										<?php $cont = 1;  ?>
										<?php foreach ($deportist->getTablas() as $tablas): ?>
											<?php foreach ($tablas as $tabla): ?>
												<?php if($cont == 1) : ?>
													<option value="<?= $tabla ?>" selected="selected"><?= $tabla ?></option>
												<?php else : ?>
													<option value="<?= $tabla ?>"><?= $tabla ?></option>
												<?php endif; ?>
												<?php $cont++;  ?>
											<?php endforeach; ?>
										<?php endforeach; ?>
									</select>
								</td>
								<td class="col-md-1"><button id="btn-styles" type="submit" name="submit" class="btn btn-success btn-lg"><i class="fa fa-search col-md-3"></i></button>	</td>
							</tr>
						</form>
					<?php endforeach; ?>
				</tbody>
			</table>
		<br/>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<button id="btn-styles" type="button" onclick="history.back()" class="btn btn-warning btn-lg"><?=i18n("Back")?></button>
		</div>
	</div>

