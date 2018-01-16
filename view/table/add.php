<?php
// file: view/users/edit.php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance ();

$table = $view->getVariable ( "table" );
$usersPEF = $view->getVariable ( "PEF" );
$trainings = $view->getVariable ( "trainings" );
$totalTrainings = $view->getVariable("totaltrainings");
$errors = $view->getVariable ( "errors" );

$view->setVariable ( "title", "Add Table" );

?>

<div class="container-fluid">
	<h1 class="stroke"><?=i18n("Add Table")?></h1>
	<br>
	<div id="edit-view" class="center-block col-xs-6 col-lg-4">
		<form id="edit-form" class="center-block form-horizontal"
		action="index.php?controller=table&amp;action=add" method="POST">

		<input type="hidden" name="id" value="<?=$table->getTableId()?>"
		readonly>
		<div class="form-group">
			<label class="control-label text-size text-muted col-sm-4">
				<?=i18n("Type")?>:<?= isset($errors["type"])?i18n($errors["type"]):"" ?>
			</label>
			<div class="col-sm-8">
				<select class="form-control" name="type">
					<option value="ESTANDAR"><?=i18n("ESTANDAR")?></option>
					<option value="PERSONALIZADA"><?=i18n("PERSONALIZADA")?></option>
				</select>
			</div>
		</div>
		<div id="ocultable" style="display: none;" class="form-group">
			<label class="control-label text-size text-muted col-sm-4">
				<?=i18n("User")?>:<?= isset($errors["type"])?i18n($errors["type"]):"" ?>
			</label>
			<div class="col-sm-8">
				<select class="col-sm-4 form-control" name="user">
					<option value=""></option>
					<?php foreach ($usersPEF as $dni => $name): ?> 
						<option value="<?=$dni?>"><?=$name?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<br>
		<div class="form-group">
			<div class="col-sm-12">
				<table class="full-width">
					<?php if($trainings !=null): ?>
					<?php foreach($trainings as $training): ?>
						<tr>
							<td><?php echo $training[1] ?></td>
							<td><?php

							$time = substr ( $training [3], 3 );
							if ($time == "00:00") {
								$time = "";
							} else {
								$time = i18n ( "Duration" ) . ": " . $time;
							}
							echo i18n ( "Repeats" ) . ": " . $training [2] . "<br>" . $time;
							?>
						</td>
						<td class="icons">

							<a href="index.php?controller=table&amp;action=deletecurrent&amp;idtable=<?php echo $table->getTableId() ?>&amp;id=<?php echo $training[0]; ?>" class="none-styles"
								onclick="
								var r = confirm('<?= i18n("are you sure?")?>');
								if (r == false) {
									return false;
								}"><i class="fa fa-trash"></i></a>

							
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif;?>
			</form>
			</table>
		</div>
	</div>

	<br>
	<div class="form-group">
		<label class="control-label text-size text-muted col-sm-4">
			<?=i18n("Trainings")?>:<?= isset($errors["Training"])?i18n($errors["Training"]):"" ?>
		</label>
		<form name="addtraining" class="form-horizontal"
		action="index.php?controller=table&amp;action=addtrainingAdd"
		method="POST">
		<div class="col-sm-8">

			<input type="hidden" name="idtable" value="<?=$table->getTableId()?>">

			<select class="col-sm-4 form-control" name="training">
				<?php foreach ($totalTrainings as $exercise => $exerciseName): ?> 
					<option value="<?=$exercise?>"><?=$exerciseName?></option>
				<?php endforeach; ?>
			</select>
			<script type="text/javascript">
				$("select[name=type]").change(function(){
					var valor = $("select[name=type] option:selected").html();
					if(valor=="PERSONALIZADA"){
						$('#ocultable').show();
					} else {
						$('#ocultable').hide();
					}
				});
			</script>
			<br>
			<button style="float:right" id="btn-styles" type="submit" name="addtraining"
			class="btn btn-info"><span style="margin-right:5%"
			class="glyphicon glyphicon-plus"></span><?= i18n("Add")?></button>
		</div>
	</form>
	
</div>

<br>
<div class="row">
	<div class="col-xs-0 col-sm-2"></div>
	<div id="null_margin" class="form-group col-sm-4 col-xs-12">
		<button id="btn-styles" type="submit" name="submit"
		class="btn btn-success btn-lg" onclick="if($('#ocultable option:selected').val()=='' && $('select[name=type] option:selected').html()=='PERSONALIZADA'){ alert('Usuario no puede ser vacío en tablas personalizadas'); return false };"><?=i18n("Send")?></button>
	</div>
	<div id="null_margin" class="form-group col-sm-4 col-xs-12">
		<button type="button" id="btn-styles" onclick="history.back()" class="btn btn-primary btn-lg"><?=i18n("Back");?></button>
	</div>
	<div class="col-xs-0 col-sm-2"></div>
</div>
</div>
</div>

