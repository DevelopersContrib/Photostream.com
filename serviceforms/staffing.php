			<script src="/serviceforms/js/staffing.js"></script>
			<div class="row-fluid">
				<div class="staffingMainCont" id="staffing_step1">
                    <h2 class="ttleCapt">Apply Today for <?=ucwords($domain)?></h2>
                    <div class="formDesc">
                        <small>
                          When you submit your registration, you can quickly join the <?=ucfirst($domain)?>. team and take part in micro tasks and be paid in services fees, equity or performance equities.  
                        </small>
                    </div>
                    <div class="stepsMain">
                        <div class="step text-center">
                            <h4>Step 1: <i class="icon-file-alt"></i> Submit an Application</h4>
                            <p>You will receive an email when we approve your application.</p>
                        </div>
                        <div class="step text-center">
                            <h4>Step 2: <i class="icon-tasks"></i> Start working on Tasks and Requests </h4>
                            <p>Make money by getting equity or pay per performance for tasks rendered and service requests fulfilled.</p>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <form class="" onsubmit="return false;">
                            <div class="emailContainer">
                                <div class="pull-left s3Input">
                                    <input class="s1Input input-block-level" type="text" id="staffing_initialemail" placeholder="Enter e-mail address" />
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-actions f-a-style">
                                <span class="pull-left text-error" id="staffing_warning1"></span>
                                <button type="submit" class="btn blue pull-right" id="staffing_btn_1">Apply Today <i class="icon-circle-arrow-right"></i></button>
                            </div>
                        </form>
                    </div>
                </div> 
				<div class="staffingMainCont" id="staffing_step2" style="display:none">
                    <h2 class="ttleCapt">Apply Today for <?=ucwords($domain)?></h2>
                    <div class="formDesc">
                        <small>
                            When you submit your registration, you can quickly join the <?=ucfirst($domain)?>. team and take part in micro tasks and be paid in services fees, equity or performance equities.  
                        </small>
                    </div>
					<form class="" onsubmit="return false;">
						<div class="row-fluid">						
							<div class="formTwo 1">
								<label for="staffing_firstname" class="control-label">
									First Name <i class="text-error">*</i>
								</label>
								<input class="s1Input input-block-level" type="text" id="staffing_firstname" />
							</div>
							<div class="formTwo">
								<label for="staffing_lastname" class="control-label">
									Last Name <i class="text-error">*</i>
								</label>
								<input class="s1Input input-block-level" type="text" id="staffing_lastname" />
							</div>
							<div class="formTwo 1">	
								<label for="staffing_email" class="control-label">
									Email <i class="text-error">*</i>
								</label>
								<input class="s1Input input-block-level" type="text" id="staffing_email" placeholder="Email" />
							</div>
							<div class="formTwo">	
								<label for="staffingwebsite" class="control-label">
									Website
								</label>
								<input class="s1Input input-block-level" type="text" id="staffing_website" />
							</div>					
							<div class="formTwo 1">		
								<label for="staffing_country" class="control-label">
									Country <i class="text-error">*</i>
								</label>
								<select class="selectS2 input-block-level" name="" id="staffing_country">
									<option value=""></option>									
									<?php for($ci=0;$ci<sizeof($countriesarray);$ci++){ ?>											
									<option value="<?=$countriesarray[$ci]['country_id']?>"><?=$countriesarray[$ci]['name']?></option>
									<?php } ?>
								</select>
							</div>
							<div class="formTwo">	
								<label for="staffing_city" class="control-label">
									City <i class="text-error">*</i>
								</label>
								<input class="s1Input input-block-level" type="text" id="staffing_city" />
							</div>
							<div class="formTwo 1">		
								<label for="staffing_password" class="control-label">
									Password <i class="text-error">*</i>
								</label>
								<input class="s1Input input-block-level" type="password" id="staffing_password" />
							</div>
							<div class="formTwo">	
								<label for="staffing_cpassword" class="control-label">
									Confirm Password <i class="text-error">*</i>
								</label>
								<input class="s1Input input-block-level" type="password" id="staffing_password2" />
							</div>					
						</div>
						<div class="row-fluid"style="margin-top: 10px;">
							<div class="requiredFieldError" id="staffing_warning2"></div>
							<div class="form2Button">
								<button type="submit" class="btn blue" id="staffing_btn_2" style="float: right;">Next <i class="icon-circle-arrow-right"></i></button>
							</div>
						</div>
					</form>
                </div>       
				<div class="staffingMainCont" id="staffing_step3" style="display:none">
                    <h2 class="ttleCapt">Apply Today for <?=ucwords($domain)?></h2>
                    <div class="formDesc">
                        <small>
                            When you submit your registration, you can quickly join the <?=ucfirst($domain)?>. team and take part in micro tasks and be paid in services fees, equity or performance equities.  
                        </small>
                    </div>
					<form class="" onsubmit="return false;">
						<div class="row-fluid">	
							<div class="formTwo" style="width:99%;margin-top: 5px;">
								<label for="staffing_role" class="control-label">
									Team Role <i class="text-error">*</i>
								</label>
								<select class="selectS2 input-block-level" name="" id="staffing_role">
									<option value=""></option>
									<?php for($ci=0;$ci<sizeof($rolesarray);$ci++){ ?>											
									<option value="<?=$rolesarray[$ci]['role_id']?>"><?=$rolesarray[$ci]['role_name']?></option>
									<?php } ?>
								</select>
							</div>
							<!--div class="formTwo" style="width:99%;margin-top: 5px;">
								<label for="staffing_companyurl" class="control-label">
									Upload Resume <i class="text-error">*</i>
								</label>
								<input class="s1Input input-block-level" type="file" id="staffing_resume" />							
							</div-->					
							<div class="formTwo" style="width:99%;margin-top: 5px;">
								<label for="staffing_companyurl" class="control-label">
									Resume Link <i class="text-error">*</i>
								</label>
								<input class="s1Input input-block-level" type="text" id="staffing_resumeurl" />							
							</div>					
							<div class="formTwo" style="width:99%;margin-top: 5px;">	
								<label for="staffing_message" class="control-label">
									Why you should join in our team? <i class="text-error">*</i>
								</label>
								<textarea class="textS2 input-block-level" id="staffing_message" rows="5"></textarea>
							</div>
						</div>
						<div class="row-fluid">
							<div class="requiredFieldError" id="staffing_warning3" style="margin: 0 0 15px;"></div>							
							<div class="form2Button">
								<button type="submit" class="btn blue" style="float: right;" id="staffing_btn_3">Next <i class="icon-circle-arrow-right"></i></button>
								<button type="submit" class="btn blue" id="staffing_back_3"><i class="icon-circle-arrow-left"></i>Back</button>   
							
							</div>
						</div>
					</form>
				</div>
			 	<div class="staffingMainCont" id="staffing_step4" style="display:none">					
					<h2 class="ttleCapt">Apply Today for <?=ucwords($domain)?></h2>
                    <div class="formDesc">
                        <small>
                            When you submit your registration, you can quickly join the <?=ucfirst($domain)?>. team and take part in micro tasks and be paid in services fees, equity or performance equities.  
                        </small>
                    </div>
					<form class="" onsubmit="return false;">
						<div class="row-fluid">	
							<table class="generic_form" style="width: 100%;">
								<tr>
									<td>
										<img src="http://d2qcctj8epnr7y.cloudfront.net/images/icons/facebook.png">
										<input class="input-medium" type="text" name="facebook" id="staffing_facebook" value="" placeholder="link to your facebook profile">
										<span style="font-size: 9px;">(optional)</span>
									</td>
								</tr>
								<tr>
									<td>
										<img src="http://d2qcctj8epnr7y.cloudfront.net/images/icons/linkedin.png">
										<input class="input-medium" type="text" name="linkedin" id="staffing_linkedin" value="" placeholder="link to your linkedin profile">
										<span style="font-size: 9px;">(optional)</span>
									</td>
								</tr>
								<tr>
									<td>
										<img src="http://d2qcctj8epnr7y.cloudfront.net/images/icons/github.png">
										<input class="input-medium" type="text" name="github" id="staffing_github" value="" placeholder="link to your github account">
										<span style="font-size: 9px;">(optional)</span>
									</td>
								</tr>
								<tr>
									<td>
										<img src="http://d2qcctj8epnr7y.cloudfront.net/images/icons/skype.png">
										<input class="input-medium" type="text" name="skype" id="staffing_skype" value="" placeholder="your skype id">
										<span style="font-size: 9px;">(optional)</span>
									</td>
								</tr>
								<tr>
									<td>
										<img src="http://d2qcctj8epnr7y.cloudfront.net/images/icons/yahoo.png">
										<input class="input-medium" type="text" name="yahoo" id="staffing_yahoo" value="" placeholder="your yahoo id">
										<span style="font-size: 9px;">(optional)</span>
									</td>
								</tr>
								<tr>
									<td>
										<img src="http://d2qcctj8epnr7y.cloudfront.net/images/icons/gtalk.png">
										<input class="input-medium" type="text" name="talk" id="staffing_talk" value="" placeholder="your gtalk id">
										<span style="font-size: 9px;">(optional)</span>
									</td>
								</tr>
								<tr>
									<td>
										<img src="http://d2qcctj8epnr7y.cloudfront.net/images/icons/aol.png">
										<input class="input-medium" type="text" name="aol" id="staffing_aol" value="" placeholder="your AOL id">
										<span style="font-size: 9px;">(optional)</span>
									</td>
								</tr>
								<tr>
									<td>
										<img src="http://d2qcctj8epnr7y.cloudfront.net/images/icons/windows.png">
										<input class="input-medium" type="text" name="wlive" id="staffing_wlive" value="" placeholder="your windows live id">
										<span style="font-size: 9px;">(optional)</span>
									</td>
								</tr>
							</table>
				
						</div>
						<div class="row-fluid">	
							<div class="requiredFieldError" id="staffing_warning4" style="margin: 0 0 15px;"></div>	
							<div class="form2Button">
								<button type="submit" class="btn blue" style="float: right;" id="staffing_btn_4">Apply Today <i class="icon-circle-arrow-right"></i></button>
								<button type="submit" class="btn blue" id="staffing_back_4"><i class="icon-circle-arrow-left"></i>Back</button>   
								<input type="hidden" id="staffing_domain" value="<?=$domain?>">
							</div>
						</div>
					</form>
				</div>
				<div class="staffingMainCont" id="staffing_final" style="display:none">
					<h2 class="ttleCapt">Apply Today for <?=ucwords($domain)?></h2>
					<hr />
					<h2 class="text-error text-center">Thank you for your application.</h2>
					<div class="formDesc2 text-center">
						<small>
							You are now minutes away to joining <?=ucwords($domain)?> team. All you need to do right now is click the link in the <span class="text-info">Verification email</span> that we have just sent you. If you still haven\'t received it, please check your spam inbox. Your verification link will redirect you to our <a href="http://www.contrib.com" target="_blank">Marketpalce hub</a> where you can login and check out your application status. You can now take part in actually building out an asset by sending proposals, staffinging with brands, joining teams. 
						</small>
					</div>
				</div>
			</div>	
			
