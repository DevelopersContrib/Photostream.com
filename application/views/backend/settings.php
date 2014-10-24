<?php $this->load->view('backend/header')?>
<?php $this->load->view('backend/navigation')?>
<link href="/css/pages/dashboard.css" rel="stylesheet" />

<link href="/js/plugins/msgGrowl/css/msgGrowl.css" rel="stylesheet" />
<link href="/js/plugins/lightbox/themes/evolution-dark/jquery.lightbox.css" rel="stylesheet" />	
<link href="/js/plugins/msgbox/jquery.msgbox.css" rel="stylesheet" />
<link rel="stylesheet" href="<?=base_url();?>css/photostream-add-style.css" />

<script src="/js/plugins/msgGrowl/js/msgGrowl.js"></script>
<script src="/js/plugins/lightbox/jquery.lightbox.min.js"></script>
<script src="/js/plugins/msgbox/jquery.msgbox.min.js"></script>
<script type="text/javascript" src="/js/account.js"></script>

<script type="text/javascript" src="/js/settings.js"></script>
<style type="text/css">
    /*         STYLE 2 BLUE ARROW
    ----------------------------------------------------------------------------------------------*/
    #blue-2-left li.active:after {
        border-bottom: 6px solid rgba(0, 0, 0, 0);
        border-left: 6px solid #169EF4;
        border-top: 6px solid rgba(0, 0, 0, 0);
        content: "";
        display: inline-block;
        position: absolute;
        right: -5px;
        top: 12px;
    }
    #blue-2-left li.active{
        position:relative;
        margin-bottom: 1px;
    }
    #blue-2-left li.active a, #blue-2-left li.active i,#blue-2-left li.active:hover a{
        background: none repeat scroll 0 0 #169EF4;
        color: #FFFFFF;
        border-left: 2px solid #0C91E5;
    }
    #blue-2-left li.active i,#blue-2-left li.active:hover i {
        background: none repeat scroll 0 0 #0C91E5 !important;
    }
    #blue-2-left li i{
        background: none repeat scroll 0 0 #E0EAF0;
        color: #B9CBD5;
        display: inline-block;
        font-size: 15px;
        margin: 0 8px 0 0;
        padding: 12px 10px 10px 8px;
        text-align: center;
        width: 27px;
    }
    #blue-2-left li:hover i{
        background: none repeat scroll 0 0 #C4D5DF !important;
        color: #fff;
    }
    #blue-2-left li:hover a{
        background: none repeat scroll 0 0 #E0EAF0;
    }
    #blue-2-left li a{
        background: none repeat scroll 0 0 #F0F6FA;
        border-left: 2px solid #C4D5DF;
        color: #557386;
        display: block;
        font-size: 13px;
        border-radius: 0;
        padding-bottom:0;
        padding-top: 0;
        padding-left: 0;
    }
    #blue-2-left li a,#blue-2-left li a:focus,#blue-2-left li a:active,#blue-2-left li a:hover{
        outline:none;
    }
    #blue-2-left li:hover a{
        background: none repeat scroll #e0eaf0;
    }
    .tabs-blue2 > .nav-tabs{
        border-right: none;
        border-bottom: none;
    }
    .tabs-blue2  > .nav-tabs > li > a,.tabs-blue2  > .nav-tabs > li > a:hover,.tabs-blue2  > .nav-tabs > li > a:focus{
        margin-right:0;
        border: none;
    }
</style>

<div class="main">
    <div class="container">
        
        <div class="row">
            <div class="span12">
                <div class="widget stacked ">
                    <div class="widget-header">
                        <i class="icon-cog"></i>
                        <h3>My Account</h3>
                    </div> <!-- /widget-header -->
                    <div class="widget-content">
                        <div class="row-fluid">
                            <div class="tabbable tabs-left tabs-blue2">
                                <ul id="blue-2-left" class="nav nav-tabs">
                                    <li style="width: 176px;margin-bottom: 2px;position: relative;">
                                        <div id="preview_image">
                                            <img src="<?=$avatar_url?>" alt="" />
                                        </div>
                                        <div style="position:absolute;z-index:10;top:0;right:0;">
                                            <a id="showSelectFromStream" data-toggle="modal" href="#StreamDialog" style="background: none repeat scroll 0% 0% rgb(0, 0, 0); padding: 3px 6px; border: medium none; color: rgb(255, 255, 255);">Edit</a>
                                            <input type="hidden" id="selected_photo_url" name="selected_photo_url" value="" />
                                            <input type="hidden" id="usernames" value = "<?=$username?>">
                                        </div>
                                        <div id="preview_profile" style="position:absolute;z-index:10;top:0;left:0;">
                                            
                                        </div>
                                    </li>
                                    <li class="active">
                                        <a data-toggle="tab" href="#personal">
                                            <i class="icon-user"></i>
                                            Personal Info
                                        </a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#change-pass">
                                            <i class="icon-lock"></i>
                                            Change Password
                                        </a>
                                    </li>
									<li class="">
                                        <a data-toggle="tab" href="#delete-acct">
                                            <i class="icon-cogs"></i>
                                            Delete Account
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="personal" class="tab-pane active">
										<h3>Personal Info</h3>
                                        <form id="settings_form" class="form-horizontal" action="javascript:saveSettings();" >
                                            <fieldset>
                                                
                                                <div class="control-group">											
                                                    <label class="control-label" for="username">Username</label>
                                                    <div class="controls">
                                                        <input type="text" class="input-medium disabled" id="username" value="<?=$username?>" style="width: 30%;" disabled />
                                                        <small>(your username cannot be changed)</small>
                                                    </div> <!-- /controls -->				
                                                </div> <!-- /control-group -->
                                                
                                                
                                                <div class="control-group">											
                                                    <label class="control-label" for="email">Email Address</label>
                                                    <div class="controls">
                                                        <input type="text" class="input-large" id="email" value="<?=$email?>" style="width: 30%;" disabled />
                                                        <small>(your email is for logging in and cannot be changed)</small>
                                                    </div> <!-- /controls -->				
                                                </div> <!-- /control-group -->
                                                
                                                <div class="control-group">											
                                                    <label class="control-label" for="firstname">First Name</label>
                                                    <div class="controls">
                                                        <input type="text" class="input-medium" id="firstname" value="<?=$firstname?>" onkeyup="valid(this)" onblur="valid(this)" style="width: 30%;">
                                                    </div> <!-- /controls -->				
                                                </div> <!-- /control-group -->
                                                
                                                
                                                <div class="control-group">											
                                                    <label class="control-label" for="lastname">Last Name</label>
                                                    <div class="controls">
                                                        <input type="text" class="input-medium" id="lastname" value="<?=$lastname?>" onkeyup="valid(this)" onblur="valid(this)" style="width: 30%;">
                                                    </div> <!-- /controls -->				
                                                </div> <!-- /control-group -->
                                                
                                                
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-primary">Save Changes</button> 
                                                    
                                                </div> <!-- /form-actions -->
                                            </fieldset>
                                        </form>
                                    </div>
                                   
								   <div id="change-pass" class="tab-pane">
										<h3>Change Password</h3>
									   <form id="settings_form" class="form-horizontal" action="javascript:saveSettingsPassword();" >
                                            <fieldset>	
                                                
                                                <div class="control-group">											
                                                    <label class="control-label" for="password">Old Password</label>
                                                    <div class="controls">
                                                        <input type="password" class="input-medium" id="old_password" />
                                                    </div> <!-- /controls -->				
                                                </div> <!-- /control-group -->
                                                
                                                <div class="control-group">											
                                                    <label class="control-label" for="password">New Password</label>
                                                    <div class="controls">
                                                        <input type="password" class="input-medium" id="password1" />
                                                    </div> <!-- /controls -->				
                                                </div> <!-- /control-group -->
                                                
                                                
                                                <div class="control-group">											
                                                    <label class="control-label" for="password2">Confirm New Password</label>
                                                    <div class="controls">
                                                        <input type="password" class="input-medium" id="password2" />
                                                    </div> <!-- /controls -->				
                                                </div> <!-- /control-group -->
                                                
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-primary">Save New Password</button> 
                                                    
                                                </div> <!-- /form-actions -->
                                            </fieldset>
                                        </form>
                                    </div>
									
									<div id="delete-acct" class="tab-pane">										
										
										<h3>Delete My Account</h3>
										<br>
										
										<form id="deleteAcctForm" action="/account/deleteAccount" method="POST" style="width:50%">
											<label>
												Hi <b><?=$firstname?> <?=$lastname?></b>, 										
												we are sorry that you'd like to delete your account. If you are having other concerns, you can <a href="/info/contact_us">contact us</a>.
												<br><br>
											</label>
											<label>Before you leave, please tell us why:</label>
											<textarea name="delete_reason" id="delete_reason" style="width: 100%; height: 73px;"></textarea>

											<label>To confirm, please enter your password: </label>
											<input type="password" name="delete_password" id="delete_password" style="width: 100%;">
											<br>
											<label style="color: orange;font-weight: bold;cursor: inherit;padding-top:15px" id="deletewarning"></label>

											<button class="btn btn-danger btn-large" type="button" id="deleteAcctButton"><i class="icon-trash"></i>&nbsp;Permanently delete my account</button>
										</form>
										<div class="alert alert-block" style="width:50%">
										  <h4 class="alert-heading" style="display: inline;">Warning!</h4>
										  By deleting your account, your submissions and connections will be permanently removed. These data can not be retrieved in the future.
										</div>

										<script type="text/javascript">
											$(document).ready(function(){
												$('#deleteAcctButton').click(function(){
													
													var delete_reason = $('#delete_reason').val();
													var delete_password = $('#delete_password').val();
													 
													 $('#deletewarning').html('');
													 
													if(delete_password == ""){
														$('#delete_password').focus();
														$('#deletewarning').html("Please enter your password");
													}else{
														$.post('/account/checkPassword',{password:delete_password},function(data){
															if(data.success){
																$('#deleteAcctForm').submit();
															}else{
																$('#delete_password').focus();
																$('#deletewarning').html("The password you entered is incorrect.");
																
															}
														});
													}
													
												});
											});
										</script>
									</div>
								</div>
                            </div>
                        </div>
                    </div><!-- widget-content -->
                </div><!-- widget stacked -->
            </div><!-- span12 -->
            
            
            
        </div><!-- row -->
    </div> <!-- /container -->
    
</div> <!-- /main -->

<div id="StreamDialog" class="modal fade hide" >
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3>Select from Streams</h3>
    </div>
    <div class="modal-body" id="myStreams">
        <p class="generalNotif">Fetching data</p>
        <div class="progress progress-primary progress-striped active">
            <div class="bar" style="width: 25%"></div> <!-- /.bar -->				
        </div> <!-- /.progress -->
    </div>
    
    <div class="modal-footer">
        <a href="javascript:;" class="btn" data-dismiss="modal">Close</a>
    </div>
    
</div>
<?php $this->load->view('backend/footer')?>  