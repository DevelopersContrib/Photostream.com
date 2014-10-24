

<div class="body-wrap">
	<div class="container-fluid">
		<div class="span5 offset4">
		<div style="border: 1px solid #d9d9d9; background-color: #f0e8e8; margin:10px 0 10px 0;padding: 10px;border-radius: 10px">
			<h3 class="text-info">Register</h3>
			<form class="form-horizontal" method="post" action="<? echo base_url()?>/home/signuppost">
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
				<div class="control-group">
					<label class="control-label">Country</label>
					<div class="controls">
						<select id="country" name="country">
							<? foreach($country as $row):
							    echo"<option value = ".$row->country_id.">".$row->country_name."</option>";
							    endforeach; ?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-danger btn-medium">Create</button>
					</div>
				</div>
			</form>
		</div>
		</div>
	</div>
</div>
<?php
	$this->load->view('public/footer_end');
?>	