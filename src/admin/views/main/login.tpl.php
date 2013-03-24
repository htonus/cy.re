<?php
/*
 * $Id$
 */

?>
<br/>
<br/>
<br/>
<br/>
<br/>
<div class="container">
	<div class="row">
		<div class="offset3 span6">
			
			<form name="formLogin" action="/?area=main&action=login" method="post" class="form-horizontal" style="border: 1px solid #DDD">

				<h3 style="margin-left: 20px">User authorization</h3>
				
				<div class="control-group">
					<label class="control-label" for="input_username">Username</label>
					<div class="controls">
						<input type="text" id="input_username" name="username" value="<?=$form->getValue('username')?>"/>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="input_password">Password</label>
					<div class="controls">
						<input type="password" id="input_password" name="password" value=""/>
					</div>
				</div>
				
				<div class="control-group">
					<div class="controls">
						<label class="checkbox" for="input_autologin">
							<input type="checkbox" id="input_autologin" name="autologin" value="1"/>
							remember me
						</label>
					</div>
				</div>
				
				<div class="control-group">
					<div class="controls">
						<input type="submit" name="submit" value="Sign in" class="btn btn-primary span2"/>
					</div>
				</div>
				
			</form>
		</div>
	</div>
</div>


	