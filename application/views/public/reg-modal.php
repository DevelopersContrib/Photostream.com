<!-- Modal Register 
======================================================= -->
<div id="myRegistration" class="modal hide fade" tabindex="5" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button><br />
		<h3>Registration</h3>
	</div>
	
	<div class="modal-body">
		<div class="span4">
			<form method="post" action="<? echo base_url()?>index.php/home/signuppost">
				<div class="control-group">
					<label class="control-label">E-mail address</label>
					<div class="controls">
						<input type="text" name="email" id="email"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Password</label>
					<div class="controls">
						<input type="password" name="password" id="password"/>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Re-type Password</label>
					<div class="controls">
						<input type="password" name="password2" id="password2"/>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Username</label>
					<div class="controls">
						<input type="text" name="username" id="username"/>
					</div>
				</div>
				
				
				<div class="control-group">
					<label class="control-label">First name</label>
					<div class="controls">
						<input type="text" name="firstname" id="firstname"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Last name</label>
					<div class="controls">
						<input type="text" name="lastname" id="lastname"/>
					</div>
				</div>
				
				<label class="control-label">Country</label>
				<select id="country" name="country">
					<? foreach($country as $row):
					    echo"<option value = ".$row->country_id.">".$row->country_name."</option>";
					    endforeach; ?>
				</select>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-danger">Register</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" aria-aria-hidden="true" class="btn">Close</button>
	</div>
</div>