<?
include('../includes/config.php');
?>
<script>
$(function(){
	$('#loadingforms').hide();
});
</script>			
			
			<div class="row-fluid">
				<div class="offerMainCont" id="offer_step1">
                    <h2 class="ttleCapt">Submit An Offer for <?=ucwords($domain)?></h2>
                    <div class="formDesc">
                        <small>
                            Enter a correct email, your email and offer inquiry will be deemed private but you will receive a response from the domain owner as soon as we receive your inquiry.    
                        </small>
                    </div>
                    <div class="stepsMain">
                        <div class="step text-center">
                            <h4>Step 1: <i class="icon-file-alt"></i> Submit Your Offer</h4>
                            <p>Interested in our domain? Send an offer now.</p>
                        </div>
                        <div class="step text-center">
                            <h4>Step 2: <i class="icon-tasks"></i> We'll Contact You Shortly</h4>
                            <p>You will receive an email addressing your offer.</p>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <form class="" onsubmit="return false;">
                            <div class="emailContainer">
                                <div class="pull-left s3Input">
                                    <input class="s1Input input-block-level" type="text" id="offer_initialemail" placeholder="Enter e-mail address" />
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-actions f-a-style">
                                <span class="pull-left text-error" id="offer_warning1"></span>
                                <button type="submit" class="btn blue pull-right" id="offer_btn_1">Next <i class="icon-circle-arrow-right"></i></button>								
                            </div>
                        </form>
                    </div>
                </div> 
				<div class="offerMainCont" id="offer_step2" style="display:none">
                    <h2 class="ttleCapt">Submit An Offer for <?=ucwords($domain)?></h2>
                    <div class="formDesc">
                        <small>
                            Enter a correct email, your email and offer inquiry will be deemed private but you will receive a response from the domain owner as soon as we receive your inquiry.    
                        </small>
                    </div>
					<form class="" onsubmit="return false;">
						<div class="row-fluid">						
							<div class="formTwo 1">
								<label for="offer_firstname" class="control-label">
									First Name <i class="text-error">*</i>
								</label>
								<input class="s1Input input-block-level" type="text" id="offer_firstname" />
							</div>
							<div class="formTwo">
								<label for="offer_lastname" class="control-label">
									Last Name <i class="text-error">*</i>
								</label>
								<input class="s1Input input-block-level" type="text" id="offer_lastname" />
							</div>
							<div class="formTwo 1">	
								<label for="offer_email" class="control-label">
									Email <i class="text-error">*</i>
								</label>
								<input class="s1Input input-block-level" type="text" id="offer_email" placeholder="Email" />
							</div>
							<div class="formTwo">	
								<label for="offer_company" class="control-label">
									Contact Number <i class="text-error">*</i>
								</label>
								<input class="s1Input input-block-level" type="text" id="offer_contact" />
							</div>					
							<div class="formTwo 1">		
								<label for="offer_country" class="control-label">
									Country <i class="text-error">*</i>
								</label>
								<select class="selectS2 input-block-level" name="" id="offer_country">
									<option value=""></option>									
									<?php for($ci=0;$ci<sizeof($countriesarray);$ci++){ ?>											
									<option value="<?=$countriesarray[$ci]['country_id']?>"><?=$countriesarray[$ci]['name']?></option>
									<?php } ?>
								</select>
							</div>
							<div class="formTwo">	
								<label for="offer_city" class="control-label">
									City <i class="text-error">*</i>
								</label>
								<input class="s1Input input-block-level" type="text" id="offer_city" />
							</div>
							<div class="formTwo 1">		
								<label for="offer_password" class="control-label">
									Password <i class="text-error">*</i>
								</label>
								<input class="s1Input input-block-level" type="password" id="offer_password" />
							</div>
							<div class="formTwo">	
								<label for="offer_cpassword" class="control-label">
									Confirm Password <i class="text-error">*</i>
								</label>
								<input class="s1Input input-block-level" type="password" id="offer_password2" />
							</div>	
						</div>
						<div class="row-fluid">
							<div class="requiredFieldError" id="offer_warning2"></div>
							<div class="form2Button">
								<button type="submit" class="btn blue" id="offer_btn_2" style="float: right;">Next <i class="icon-circle-arrow-right"></i></button>
							</div>
						</div>
					</form>
                </div>   
				<div class="offerMainCont" id="offer_step3" style="display:none">
                    <h2 class="ttleCapt">Submit An Offer for <?=ucwords($domain)?></h2>
                    <div class="formDesc">
                        <small>
                            Enter a correct email, your email and offer inquiry will be deemed private but you will receive a response from the domain owner as soon as we receive your inquiry.    
                        </small>
                    </div>
					<form class="" onsubmit="return false;">
						<div class="row-fluid">						
							<div class="formTwo" style="width:99%">
								<label for="offer_firstname" class="control-label">
									Sponsor/Bid Price($) <i class="text-error">*</i>
								</label>
								<span class="price-label">$</span>
								<input class="s1Input input-block-level" type="text" id="offer_price" style="width:75%"/>
								<span class="price-label">.00</span>
							</div>				
							<div class="formTwo" style="width:99%">	
								<label for="partner_message" class="control-label">
									Message <i class="text-error">*</i>
								</label>
								<textarea class="textS2 input-block-level" id="offer_message" rows="4"></textarea>
							</div>
							
						</div>
						<div class="row-fluid">
							<div class="requiredFieldError" id="offer_warning3" style="margin: 0 0 15px;"></div>
							<div class="form2Button">
								<button type="submit" class="btn blue" id="offer_btn_3" style="float: right;">Submit My Offer <i class="icon-circle-arrow-right"></i></button>
								<button type="submit" class="btn blue" id="offer_back_3"><i class="icon-circle-arrow-left"></i>Back</button>
								<input type="hidden" id="offer_domain" value="<?=$domain?>">
							</div>
						</div>
					</form>
                </div>
			 	<div class="offerMainCont" id="offer_final" style="display:none">
					<h2 class="ttleCapt">Submit An Offer for <?=ucwords($domain)?></h2>
					<hr />
					<h1 class="text-error text-center">Thank you for contacting us.</h1>
					<div class="formDesc2 text-center">
						<small>
							You are now minutes away to joining <?=ucwords($domain)?> team. All you need to do right now is click the link in the <span class="text-info">Verification email</span> that we have just sent you. If you still haven\'t received it, please check your spam inbox. Your verification link will redirect you to our <a href="http://www.contrib.com" target="_blank">Marketpalce hub</a> where you can login and check out your application status. You can now take part in actually building out an asset by sending proposals, partnering with brands, joining teams. 
						</small>
					</div>
				</div>
			</div>	
			
<script src="/serviceforms/js/service_offer.js"></script>
