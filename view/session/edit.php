<?php
//file: view/sesion/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$sesion = $view->getVariable("sesion");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Edit Sesion");
?>

<div class="recuadro">
  <div id="formulario">
    <div class="home2">
      <form action="index.php?controller=sesion&amp;action=edit&amp;id=<?=$sesion->getIdSesion()?>" method="POST">
        <br><?=i18n("Observations")?>:<?= isset($errors["observation"])?i18n($errors["observation"]):"" ?><input type="text" name="observation" value="<?=$sesion->getObservation()?>">

        <?=i18n("Date")?>:<?= isset($errors["dateSesion"])?i18n($errors["dateSesion"]):"" ?><input type='text' id="datepicker" name="date" value="<?=$sesion->getDateSesion()?>">
        <?=i18n("Hour")?>:<?= isset($errors["hour"])?i18n($errors["hour"]):"" ?><input type='time' step="1" name="hour" value="<?=$sesion->getHour()?>">
        <button type="submit" name="submit"><?=i18n("Send")?></button>
      </form>
    </div>
  </div>
</div>
