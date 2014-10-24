<?php $this->load->view('public/header')?>
<?php $this->load->view('public/navigation')?>

<div class="subnavbar">&nbsp;</div>
<div class="main">
<div class="container">
	<div class="row">
    <div class="span2">&nbsp;</div>  	
	<div class="span8">
		<div class="widget stacked">
			
				<div class="widget-header"><i class="icon-check"></i><h3>Email Verification</h3></div>
				<div class="widget-content">
					<? echo   "<h2 class='text-center text-success'>" .$message. "</h2>"; ?>
				</div>
		
		</div><!-- widget stacked -->
	</div><!-- span8 -->
	<div class="span2">&nbsp;</div> 

<?if($show_login == true):?>
	<br style="clear:both;" />
	<div class="account-container stacked">
	
	<div class="content clearfix">
		
		<form action = "javascript:loginUser()">
		
			<h1>Sign In</h1>		
			
			<div class="login-fields">
				
				<p>Sign in using your registered account:</p>
				
				
			
				<div class="control-group">
					<div class="field">
						<label for="username">Email:</label>
						<input type="text" id="username" name="username" value="" placeholder="Email" class="login username-field" />
						<div><span for="email" generated="true" class="error username-field" style="display: none;"></span></div>
					</div> <!-- /field -->
				</div>
				
				<div class="control-group">
					<div class="field">
						<label for="password">Password:</label>
						<input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field"/>
						<div><span for="password" generated="true" class="error password-field" style="display: none;"></span></div>
					</div> <!-- /password -->
			  </div>	
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<span class="login-checkbox">
					<input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
					<label class="choice" for="Field">Keep me signed in</label>
				</span>
									
				<button class="button btn btn-warning btn-large">Sign In</button>
				
			</div> <!-- .actions -->
			
			<div class="login-social">
				<p>Sign in using social network:</p>
				
				<div class="twitter">
					<a href="/signup/redirect2" class="btn_1">Login with Twitter</a>				
				</div>
				  
				<div class="fb">
					<a href="<? echo $login_url;?>" class="btn_2">Login with Facebook</a>				
				</div>
				
			</div>
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->
	
<?endif;?>
</div> <!-- row -->
</div><!-- container -->
</div><!-- main -->
<script src="/js/login.js"></script>
<?php $this->load->view('public/footer')?>