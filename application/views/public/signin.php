<?php $this->load->view('public/header')?>
<?php $this->load->view('public/navigation-signin')?>	
<link href="/css/pages/plans.css" rel="stylesheet"> 
<link href="/css/animate.min.css" rel="stylesheet">
<div class="account-container stacked animated flipInY">
    
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
                    <a href="<? echo base_url()?>signup/redirect2" class="btn_1">Login with Twitter</a>					
                </div>
                <?php if (@$user_profile):
    //redirect("dashboard/fb_redirect");
    echo "Welcome ".$user_profile['name'];
//echo print_r($user_profile, TRUE); ?>
                <a href="<? echo $logout_url;?>" class="btn_2">Logout Facebook</a>	
                <?php else: ?>
                <div class="fb">
                    <a href="<? echo $login_url;?>" class="btn_2">Login with Facebook</a>				
                </div>
                <?php endif; ?>
            </div>
            
        </form>
        
    </div> <!-- /content -->
    
</div> <!-- /account-container -->
<style>
    .fadeInUp{
        -webkit-animation-delay: 1.3s;
        -moz-animation-delay: 1.3s;
        -ms-animation-delay: 1.3s;
        -o-animation-delay: 1.3s;
        animation-delay: 1.3s;
    }
</style>

<!-- Text Under Box -->
<div class="login-extra fadeInUp animated">
    Don't have an account? <a href="/signup">Sign Up</a><br/>
    <a href="#fogot_password_dialog" data-toggle="modal"> Forgot Password?</a>
</div> <!-- /login-extra -->


<div class="modal fade hide" id="fogot_password_dialog">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3>Forgot password</h3>
    </div>
    <div class="modal-body" id="modal_message">
        <p>Enter your registered email and we will send you instructions to reset your password</p>
        <div id="error-notif"></div><br />
        <form class="form-horizontal">
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="name">Email</label>
                    <div class="controls">
                        <input type="text" class="input-large" name="forgot_email" id="forgot_email">
                    </div>
                </div>
            </fieldset>
        </form>
    </form>
</div>

<div class="modal-footer" id="modal_buttons">
    <a href="javascript:;" class="btn" data-dismiss="modal">Cancel</a>
    <a href="javascript:send_login_details();" class="btn btn-primary">Send my login details</a>
</div>
</div>

<script src="/js/login.js"></script>
<?php $this->load->view('public/footer')?>	

