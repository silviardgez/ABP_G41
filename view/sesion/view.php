<?php
//file: view/sesion/view.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$sesion = $view->getVariable("sesion");
$view->setVariable("title", "View Sesion");
?>

<div class="recuadro">
  <div id="formulario">
    <div class="home2">
      <form>
        <br><?=i18n("Observations")?>:<input type="text" name="observation" value="<?=$sesion->getObservation()?>" readonly="readonly">

        <?=i18n("Date")?>:<?= isset($errors["dateSesion"])?i18n($errors["dateSesion"]):"" ?><input type='date' class='tcal' id="datepicker"" name="dateSesion" value="<?=$sesion->getDateSesion()?>" readonly="readonly">
        <?=i18n("Hour")?>:<?= isset($errors["hour"])?i18n($errors["hour"]):"" ?><input type='time' step="1" name="hour" value="<?=$sesion->getHour()?>" readonly="readonly">
      </form>

      <button type="button" onclick="window.location.replace('index.php?controller=sesion&amp;action=show')"><?=i18n("Show all")?></button>

    </div>
  </div>
</div>
