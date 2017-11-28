<?php
//file: view/sesion/add.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$sesion = $view->getVariable("sesion");
$view->setVariable("title", "Add Sesion");
$errors = $view->getVariable("errors");
?>


<div class="recuadro">
  <div id="formulario">
    <div class="home2">
      <form action="index.php?controller=sesion&amp;action=add" method="POST">

        <br>
        <?=i18n("Observations")?>:<?= isset($errors["observation"])?i18n($errors["observation"]):"" ?><input type="text" name="observation">

        <?=i18n("Date")?>:<?= isset($errors["dateSesion"])?i18n($errors["dateSesion"]):"" ?><input type="text" id="datepicker" name="dateSesion">
        <?=i18n("Hour")?>:<?= isset($errors["hour"])?i18n($errors["hour"]):"" ?><input type='time' step="1" name="hour">
        <button type="submit" name="submit"><?=i18n("Send")?></button>
      </form>
    </div>
  </div>
</div>
