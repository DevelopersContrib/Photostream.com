<?php if (@$user_profile): ?>
<? $this->load->view('backend/header_fb');?>



<?php else: ?>
<div class="wrap_header">
	<!--Sign-in & Sign-up-->
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12 sign-in">
				    <form class="form-inline pull-right" method="post" action="<? echo base_url(); ?>/home/loginuser">
						<input type="text" class="input-medium" name="email" id="email" placeholder="Email">
					    <input type="password" class="input-medium" name="password" id="password" placeholder="Password">
						<button type="submit" class="btn btn-info">Sign in</button>
						<div class="rmmbr_me">
							<label class="checkbox rmmbrMe">
							    <input type="checkbox">
								<span>Remember me</span>
								  
								    <span style="color: #fff;">or </span><a href="<?php echo $login_url ?>" style="color: #1d9ed6;">Login via Facebook</a>
								
								
								  </label>
						</div>
	
					</form>
			</div>
		</div>
	</div>
	
	
	
	<!--Header-->
	<header>
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span5 offset1 header">
					<a href="<? echo base_url();?>index.php/home/index">
					<img src="<? echo base_url();?>img/logo-photostream.png"/>
					</a>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5 offset1 h-title">
					<span>Love the things you share.</span>
				</div>
			</div>
		</div>
	</header>
</div><!--End of Wrap Header-->
<?php endif; ?>