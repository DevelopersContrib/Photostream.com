function resetError(){
	$('span.username-field').css('display','none');
	$('span.password-field').css('display','none');
        $('span.fname-field').css('display','none');
        $('span.lname-field').css('display','none');
	 $('span.uname-field').css('display','none');
        $('span.password2-field').css('display','none');
	
}


function register(){
	resetError();
	var email = $('#email').val();
	var user_ip = $('#ip').val();
	var domain = 'photostream.com';
	var password = $('#password').val();
        var lastname = $('#lastname').val();
        var firstname = $('#firstname').val();
        var password2 = $('#confirm_password').val();
        var country = $('#country').val();
	var fb_id = $('#fb_id').val();
	var uname = $('#uname').val();
	var twitter_id = $('#twitter_id').val();
	var emailfilter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	var ck_name = /^[A-Za-z0-9 ]{3,20}$/;
	var iChars = "_!@#$%^&*()+=-[]\\\';,./{}|\":<>? ";
	var checks = 0;
	if(jQuery('input[type="checkbox"][name="Field"]').is(':checked')){
		checks = 1;
	}
	
    
	if(uname==""){
		$('span.uname-field').css('display','block');
		$('span.uname-field').html('Username is required');
	}else if (email==""){
		$('span.username-field').css('display','block');
		$('span.username-field').html('Email is required');
	}else if (password==""){
		$('span.password-field').css('display','block');
		$('span.password-field').html('Password is required');
        }else if(lastname==""){
            $('span.lname-field').css('display','block');
	    $('span.lname-field').html('last name is required');
        }else if(firstname==""){
            $('span.fname-field').css('display','block');
	    $('span.fname-field').html('first name is required');
        }else if(password2 != password||password2 == ""){
            $('span.password2-field').css('display','block');
	    $('span.password2-field').html('password does not match');
	}else if(uname.length < 3 || uname.length > 12){
		$('span.uname-field').css('display','block');
		$('span.uname-field').html('Username must be 3 to 12 characters.');
	}else if(checks != 1){
		$.msgGrowl ({
			type: 'error',
			title: 'Registration Error', // Optional
			 text: 'Please check terms and condition'
		});
	}else if(!emailfilter.test(email)){
		$('span.username-field').css('display','block');
		$('span.username-field').html('invalid email address');
	}else {
	
		
		$.post("/signup/signuppost",
				 {
					 email:email,
					 password:password,
                                         lastname:lastname,
                                         firstname:firstname,
                                         country:country,
					 fb_id:fb_id,
					 uname:uname,
					 twitter_id:twitter_id
					 
				 } ,function(data){
						if (data=="1"){
							$.msgGrowl ({
							type: 'success',
							title: 'Registration Success', // Optional
							 text: 'Please verify email to continue'
						});
						
						
						$.post("http://www.api.contrib.com/forms/saveleads",
								{   domain:domain,
									email:email,
									user_ip:user_ip
								},function(data){
									//window.location.href="/login";
								});
						
							$('.hideform').hide();
							$('#verifybox').show();
							
						}
						if(data=="2") {
							$('span.username-field').css('display','block');
							$('span.username-field').html('email exist');
						}
						if(data=="3"){
							$('span.uname-field').css('display','block');
							$('span.uname-field').html('username exist');
						}
					});
	}
	
}
