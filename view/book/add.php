<?php
//file: view/sesion/add.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$booking = $view->getVariable("booking");
$view->setVariable("title", "Add booking");
$errors = $view->getVariable("errors");
?>


<div class="recuadro">
  <div id="formulario">
    <div class="home2">
      <form action="index.php?controller=book&amp;action=add" method="POST">
        <br>
        <?=i18n("Id activity")?>:<?= isset($errors["id_act"])?i18n($errors["id_act"]):"" ?><input type="text" name="id_act">
        <?=i18n("Id athlete")?>:<?= isset($errors["id_athl"])?i18n($errors["id_athl"]):"" ?><input type="text" name="id_athl">
        <?=i18n("Date")?>:<?= isset($errors["date"])?i18n($errors["date"]):"" ?><input type="text" id="datepicker" name="date">
        <?=i18n("Hour")?>:<?= isset($errors["hour"])?i18n($errors["hour"]):"" ?><input type='time' step="1" name="hour">
        <?=i18n("Confirmed")?>:<?= isset($errors["confirmed"])?i18n($errors["confirmed"]):"" ?><input type="text" name="confirmed">
        <button type="submit" name="submit"><?=i18n("Send")?></button>
      </form>
    </div>
  </div>
</div>
