function resetError(){
    $('span.username-field').css('display','none');
    $('span.password-field').css('display','none');
    
}

function validate(){
    resetError();
    
    var email = $('#email').val();
    var password = $('#password').val();
    var emailfilter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    
    if(email == ""){
        $('span.username-field').css('display','block');
        $('span.username-field').html('Email is required');
    }else if (password == ""){
        $('span.password-field').css('display','block');
	$('span.password-field').html('Password is required');
    }else if(!emailfilter.test(email)){
		$('span.username-field').css('display','block');
		$('span.username-field').html('invalid email address');
   }else {
		$.post("/googleplus/authentication",
				 {
					 email:email,
					 password:password
				 } ,function(data){
						if (data=="1"){
							window.location.href="/googleplus/authentication";
						}else {
							$('span.username-field').css('display','block');
							$('span.username-field').html('Account does not exist or not yet verified');
						}
					});
	}
    
}