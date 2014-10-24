<?php $this->load->view('public/header')?>
<?php $this->load->view('public/navigation')?>	
	


<script src="/js/demo/signin.js"></script>
<div class="account-container register stacked">
	
	<div class="content clearfix">
		
		<form action = "javascript:register()" class="hideform">
		<? if($user_profile==0) {?>
			<h1>Create Your Account</h1>			
			<? } elseif($user_profile==2){?>
			<h3>Create Your Account Through Twitter</h3>
			<?}else{?>
			<h3>Create Your Account Through Facebook</h3>
			<? } ?>
			<div class="login-social">
			  <? if($user_profile==0){ ?>
				<p>Sign in using social network:</p>
				
				<div class="twitter">
					<a href="<? echo base_url()?>signup/redirect2" class="btn_1">Login with Twitter</a>				
				</div>
				
				<div class="fb">
					<a href="<? echo $login_url;?>" class="btn_2">Login with Facebook</a>				
				</div>
				<? } ?>
			</div>
			
			<div class="login-fields">
				
				<p>Create your free account:</p>
				<?
				//echo $user_profile;
				if($user_profile==2)
				{
				  $x = $tweet_profile->name;
				    //print_r(explode(" ",$x));
				    $name = explode(" ",$x); }
				    else{
				      $x = 0;
				      $name = 0;}?>
				    
				<div class="control-group">
				<div class="field">
				      <input type="hidden" name="fb_id" id="fb_id" value="<? /*echo $user_profile['name'];*/if($user_profile==0){
					  echo ""; }
					  else{
					  echo $user_profile['id'];}?>">
				      <input type="hidden" name="twitter_id" id="twitter_id" value="<? /*echo $user_profile['name'];*/if($user_profile==2){
					    echo $tweet_profile->id; }
					  else{
					   echo "";
					  }?>">
					<label for="firstname">First Name:</label>
					<input type="text" id="firstname" name="firstname" value="<? //echo $name[0];
					if($user_profile==0){
					  echo ""; }
					  elseif($user_profile==2){
					    echo $name[0];
					  }
					  else{
					  echo $user_profile['first_name']; }?>" placeholder="First Name" class="login" onkeyup="valid(this)" onblur="valid(this)" />
					<div><span for="firstname" generated="true" class="error fname-field" style="display: none;"></span></div>
				</div> <!-- /field -->
				</div>
				
				<div class="control-group">
				<div class="field">
					<label for="lastname">Last Name:</label>	
					<input type="text" id="lastname" name="lastname" value="<? //echo $name[1];
					if($user_profile==0){
					  echo ""; }
					  elseif($user_profile==2){
					    echo $name[1];
					  }
					  else{
					  echo $user_profile['last_name']; }?>" placeholder="Last Name" class="login"  onkeyup="valid(this)" onblur="valid(this)"/>
					<div><span for="lastname" generated="true" class="error lname-field" style="display: none;"></span></div>
				</div> <!-- /field -->
				</div>
				
				<div class="control-group">
				<div class="field">
					<label for="uname">Username: </label>	
					<input type="text" id="uname" name="uname" placeholder="username" class="login" onkeyup="valid(this)" onblur="valid(this)"/>
					<div><span for="uname" generated="true" class="error uname-field" style="display: none;"></span></div>
				</div> <!-- /field -->
				</div>
				
				 <div class="control-group">
				<div class="field">
				    <select id="country" name="country" placeholder="Country">
							 <option value="">Country</option>
							<? foreach($country as $row):
							    echo"<option value = ".$row->country_id.">".$row->country_name."</option>";
							    endforeach; ?>
				    </select>
				</div>
				</div>
				
				<div class="control-group">
				<div class="field">
				   <? //echo print_r($user_profile, TRUE);
				    //echo $user_profile['name'];?>
					<label for="email">Email Address:</label>
					<input type="text" id="email" name="email" value="" placeholder="Email" class="login"/>
					<div><span for="email" generated="true" class="error username-field" style="display: none;"></span></div>
				</div> <!-- /field -->
				</div>
				
				<div class="control-group">
				<div class="field">
					<label for="password">Password:</label>
					<input type="password" id="password" name="password" value="" placeholder="Password" class="login" onkeyup="valid(this)" onblur="valid(this)"/>
					<div><span for="password" generated="true" class="error password-field" style="display: none;"></span></div>
				</div> <!-- /field -->
				</div>
				
				<div class="control-group">
				<div class="field">
					<label for="confirm_password">Confirm Password:</label>
					<input type="password" id="confirm_password" name="confirm_password" value="" placeholder="Confirm Password" class="login" onkeyup="valid(this)" onblur="valid(this)"/>
					<div><span for="confirm_password" generated="true" class="error password2-field" style="display: none;"></span></div>
				</div> <!-- /field -->
				</div>
				
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<span class="login-checkbox">
					<input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
					<label class="choice" for="Field">I have read and agree with the Terms of Use.</label>
					<div><span for="terms_of_use" generated="true" class="error terms_of_use" style="display: none;"></span></div>
				</span>
									
				<button class="button btn btn-primary btn-large">Register</button>
				
			</div> <!-- .actions -->

		</form>
		
		<div id="verifybox" style="display:none">
			<h3>Successful Registration!</h3>
			Please check your email to verify your account.
			<br>
			<a href="/login" class="button btn btn-primary btn-large">Login here</a>
		</div>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->


<!-- Text Under Box -->
<div class="login-extra">
	Already have an account? <a href="/login">Login</a>
</div> <!-- /login-extra -->

<?php $this->load->view('public/footer')?>
<script src="/js/msgGrowl.js"></script>
<script src="/js/signup.js"></script>
