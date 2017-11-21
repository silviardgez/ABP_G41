<?php
//file: view/exercises/view.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$exercise = $view->getVariable("exercise");
$view->setVariable("title", "View exercise");
?>
<div class="recuadro">
	<div id="formulario">

		<div class="home2">
			<form>  
				<br><?=i18n("Name")?>:<?= isset($errors["name"])?i18n($errors["name"]):"" ?><input type="text" name="nombre" value="<?=$exercise->getName()?>" readonly="readonly">  

				<?=i18n("Type")?>:<?= isset($errors["type"])?i18n($errors["type"]):"" ?><input type="text" name="tipo" value="<?=$exercise->getType()?>" readonly="readonly">

				<?php if($exercise->getImage() != NULL && $exercise->getImage() != ""){ ?>
				<img src="<?=$exercise->getImage()?>" alt="<?=i18n("Image not found")?>" />
				<?php } ?>

				<?php if($exercise->getVideo() != NULL && $exercise->getVideo() != ""){ ?>
				<iframe width="560" height="315" src="<?=$exercise->getVideo()?>" controls autoplay frameborder="0" allowfullscreen></iframe>
				<?php }?>
				
				<button type="button" onclick="history.back()"><?=i18n("OK")?></button>
				
			</form>
		</div>
	</div>
</div>