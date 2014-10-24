function resetError(){
	$('span.username-field').css('display','none');
	$('span.password-field').css('display','none');
	
}


function loginUser(){
	resetError();
	var email = $('#username').val();
	var password = $('#password').val();
	
	if (email==""){
		$('span.username-field').css('display','block');
		$('span.username-field').html('Email is required');
	}else if (password==""){
		$('span.password-field').css('display','block');
		$('span.password-field').html('Password is required');
	}else {
		$.post("/login/process",
				 {
					 email:email,
					 password:password
				 } ,function(data){
						if (data=="1"){
							window.location.href="/dashboard";
						}else {
							$('span.username-field').css('display','block');
							$('span.username-field').html('Account does not exist or not yet verified');
						}
					});
	}
	
}

/* sends login info to email */
function send_login_details(){
	var forgot_email = $('#forgot_email').val();
	if(validateEmail(forgot_email) == true){
		$.post('/login/sendLoginDetails',{email:forgot_email},function(data){
			if(data == "success"){
				$('#modal_message').html("<strong>Please check your email for your login details.</strong>");
				$('#modal_footer').html('<a href="javascript:;" class="btn" data-dismiss="modal">Reset my password</a>');	
			}else if(data == "not_in_db"){
				$("#error-notif").html("The email you entered is not yet registered. Would you like to <a href='/signup'>register</a> instead?");
			}else{
				$("#error-notif").html("Something &rsquo s really really wrong" + data);
			}
		});
	}else{
		$("#error-notif").html("The email you entered is invalid.");
		$('#forgot_email').focus();
	}
}

/*checks if string is in email format*/
function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
