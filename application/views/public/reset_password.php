<?php $this->load->view('public/header')?>
<?php $this->load->view('public/navigation-signin')?>	
<link href="/css/pages/plans.css" rel="stylesheet"> 
<div class="account-container stacked">
	
	<div class="content clearfix">
		
		<form action = "javascript:saveResetPassword();">
		
			<h1>Reset Password</h1>		
			
			<div class="login-fields">
				
				<p>Sign in using your registered account:</p>
				
				
			
				<div class="control-group">
					<div class="field">
						<label for="username">Email:</label>
						<input type="text" id="email" name="email" value="" placeholder="Email" class="login username-field" />
						<div><span for="email" generated="true" class="error username-field" style="display: none;"></span></div>
					</div> <!-- /field -->
				</div>
				
				<div class="control-group">
					<div class="field">
						<label for="password">Secret Code:</label>
						<input type="password" id="secret_code" name="secret_code" value="" placeholder="Secret Code" class="login password-field"/>
						<div><span for="password" generated="true" class="error password-field" style="display: none;"></span></div>
					</div> <!-- /password -->
			    </div>
				
				<div class="control-group">
					<div class="field">
						<label for="password">New Password</label>
						<input type="password" id="new_password" name="new_password" value="" placeholder="New Password" class="login password-field"/>
						<div><span for="password" generated="true" class="error password-field" style="display: none;"></span></div>
					</div> <!-- /password -->
			    </div>
				
				<div class="control-group">
					<div class="field">
						<label for="password">Confirm New Password</label>
						<input type="password" id="confirm_password" name="confirm_password" value="" placeholder="Confirm Password" class="login password-field"/>
						<div><span for="password" generated="true" class="error password-field" style="display: none;"></span></div>
					</div> <!-- /password -->
			    </div>	
				
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
							
				<button class="button btn btn-warning btn-large">Reset my password</button>
				
			</div> <!-- .actions -->
		
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->


<!-- Text Under Box -->
<div class="login-extra">
	&nbsp;
</div> <!-- /login-extra -->

<!-- that fancy alerts library -->
<link href="<?=base_url()?>js/plugins/msgGrowl/css/msgGrowl.css" rel="stylesheet">
<link href="<?=base_url()?>js/plugins/lightbox/themes/evolution-dark/jquery.lightbox.css" rel="stylesheet">	
<link href="<?=base_url()?>js/plugins/msgbox/jquery.msgbox.css" rel="stylesheet">

<script src="<?=base_url()?>js/plugins/msgGrowl/js/msgGrowl.js"></script>
<script src="<?=base_url()?>js/plugins/lightbox/jquery.lightbox.min.js"></script>
<script src="<?=base_url()?>js/plugins/msgbox/jquery.msgbox.min.js"></script>
<!-- fancy alerts -->

<script src="/js/reset_password.js"></script>
<?php $this->load->view('public/footer')?>	

