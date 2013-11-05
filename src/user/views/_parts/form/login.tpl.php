<?php
	if ($user->isFake()) {
?>
					<div class="catchy">
						<div class="pull-right white" style="text-align: right"><b>_S__REGISTER___</b><br>_S__FORGOT PASSWORD___</div>
						<h2><strong>___WELCOME___</strong></h2>
						<div class="row-fluid form-inline">
							<form method="post" action="">
								<div class="span6"><input type="text" name="username" class="input-block-level" /></div>
								<div class="span3"><input type="password" name="password" class="input-block-level" /></div>
								<div class="span3"><input type="submit" class="btn input-block-level pull-right" value="_S__SUBMIT___" /></div>
							</form>
						</div>
						<div class="row-fluid">
							<div class="span6 white">_S__USER NAME___</div>
							<div class="span3 white">_S__PASSWORD___</div>
							<div class="span3 white"></div>
						</div>
					</div>
<?php
	} else {
?>
					<div class="catchy">
						<h5>Hello, <strong><?= $user->getName() ?></strong>, choose the action:</h5>
						<div class="row-fluid form-inline">
							<h5>
								<a class="btn btn-black" href="<?= PATH_WEB_ADMIN ?>?area=person&action=edit&id=<?= $user->getId() ?>" target="_blank">Settings</a>
								<a class="btn btn-black" href="<?= PATH_WEB_ADMIN ?>" target="_blank">Back office</a>
								<a class="btn btn-black" href="<?= PATH_WEB_USER ?>?signout">Sign out</a>
							</h5>
						</div>
					</div>
<?php
	}
?>
