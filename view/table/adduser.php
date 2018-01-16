<?php
// file: view/users/edit.php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance ();

$table = $view->getVariable ( "table" );
$athletes = $view->getVariable ( "athletes" );
$errors = $view->getVariable ( "errors" );

$tableName = i18n("Table") . " " . $table;

$view->setVariable ( "title", "Assign table to user" );

?>

<div class="container-fluid">
	<h1 class="stroke"><?=i18n("Assign table to user")?></h1>
	<br>
	<div id="edit-view" class="center-block col-xs-6 col-lg-4">
		<form id="edit-form" class="center-block form-horizontal"
			action="index.php?controller=table&amp;action=adduser" method="POST">
			<input type="hidden" name="id" value="<?=$table?>" readonly>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
						<?=i18n("Table")?>:
					</label> 
				<div class="col-sm-8">
					<input class="form-control" name="tableName" type="text" value="<?=$tableName?>" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label text-size text-muted col-sm-4">
						<?=i18n("Athlete")?>:
				</label>
				<div class="col-sm-8">
					<select class="form-control" name="athlete">
					<?php foreach ($athletes as $id => $name): ?> 
							<option value="<?=$id?>"><?= $name?></option>
					<?php endforeach; ?>
					</select>
				</div>
			</div>
			<br>
			<div class="row">
			<div class="col-xs-0 col-sm-2"></div>
			<div id="null_margin" class="form-group col-sm-4 col-xs-12">
				<button id="btn-styles" type="submit" name="submit"
				class="btn btn-success btn-lg"><?=i18n("Send")?></button>
			</div>
			<div id="null_margin" class="form-group col-sm-4 col-xs-12">
				<button type="button" id="btn-styles" onclick="history.back()" class="btn btn-primary btn-lg"><?=i18n("Back");?></button>
			</div>
			<div class="col-xs-0 col-sm-2"></div>
		</div>
		</form>
	</div>
</div>
