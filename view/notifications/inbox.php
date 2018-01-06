<?php
//file: view/exercises/view.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$emails = $view->getVariable("emails");
$view->setVariable("title", "Inbox");
$errors = $view->getVariable ( "errors" );
?>
<div>
	<h1 id="bigger-size" class="stroke"><?=i18n("Inbox")?></h1>
	<br>
</div>

<div id="center-view" class="center-block col-md-6 col-sm-8 item">
	<div class="exercise-tables-background center-block">
		<br>
		<table id="table-margin" class="table">
				<thead>
				<tr>
					<th><?=i18n("Sender")?></th>
					<th><?=i18n("Subject")?></th>
          <th><?=i18n("Actions")?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($emails as $email): ?>
						<tr>
							<td><?= htmlentities($email->getSender())?></td>
							<td><?= htmlentities($email->getSubject()) ?></td>
              <td class="icons">
							<a href="index.php?controller=notifications&amp;action=view&amp;id=<?= $email->getId() ?>">
									<i class="fa fa-search col-md-4"></i></a>
							<form
							method="POST"
							action="index.php?controller=notifications&amp;action=delete"
							id="delete_notification_<?= $email->getId(); ?>"
							style="display: inline"
							>

							<input type="hidden" name="id" value="<?= $email->getId() ?>">

							<a
							onclick="
							if (confirm('<?= i18n("are you sure?")?>')) {
								document.getElementById('delete_notification_<?= $email->getId(); ?>').submit()
							}"
							><i class="fa fa-trash col-md-4"></i></a>

						</form>
						</td>
						</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
</div>
</div>
