<?php
//file: view/login/contact.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Contact");
?>
	<div class="container">
		<div class="row features">
			<div class="col-md-4 col-sm-6 item">
				<div class="box">
					<i class="fa fa-envelope-o icon"></i>
					<h3 class="name"><?=i18n("Contact")?></h3>
					<p class="description"><?=i18n("University Pavilion")?></p>
					<p class="description"><?=i18n("Campus A Lonia (Ourense)")?></p>
					<p class="description"><?=i18n("Phone: 988 101 717")?></p>
					<p><a class="description" href="http://ourense.gaiagd.com/">Web: Ourense.gaiagd.com</a></p>
					<p><a class="description" href="https://www.facebook.com/aqa.orense">Facebook: AQUA Ourense</a></p>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 item">
				<div class="box">
					<i class="fa fa-university icon"></i>
					<h3 class="name"><?=i18n("Sport Spaces")?></h3>
					<p class="description"><?=i18n("On the Campus of Ourense, users of the Area of ​​Well-being, Health and Sports may use a series of sports facilities managed by UVigo:")?></p>
					<p class="learn-more"><?=i18n("Polideportivo Pavilion, Cardio-fitness room,")?></p>
					<p class="learn-more"><?=i18n("Table tennis area, Tennis courts,")?></p>
					<p class="learn-more"><?=i18n("Field of artificial grass, Track of Athletics and AQUA.")?></p>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 item">
				<div class="box">
					<i class="fa fa-calendar icon"></i>
					<h3 class="name"><?=i18n("Schedules")?></h3>
					<p class="description"><?=i18n("September to June: Monday to Friday from 08:30 to 23:30. Saturdays and Sundays from 10:00 a.m. to 2:00 p.m. and from 4:00 p.m. to 9:00 p.m.")?></p>
					<p class="description"><?=i18n("July, Easter and Christmas: Monday to Friday from 9:00 a.m. to 9:00 p.m. Saturdays and Sundays from 10:00 a.m. to 2:00 p.m. and from 4:00 p.m. to 9:00 p.m.")?></p>
					<p class="description"><?=i18n("August: Monday through Friday from 09:00 to 20:30. Saturdays and Sundays: Closed.")?></p>
				</div>
			</div>
		</div>
	</div>


<?php $view->moveToFragment("css");?>
<link rel="stylesheet" type="text/css" src="css/style.css">
<?php $view->moveToDefaultFragment(); ?>
