$(document).ready(function(){

});

function saveResetPassword(){
	var email = $('#email').val();
	var password = $('#new_password').val();
	var password2 = $('#confirm_password').val();
	var secretcode = $('#secret_code').val();

		if(password != password2){
			$.msgbox("The password you entered did not match", {type: "error"});
		}else{
			$.post('/login/saveNewPassword',{email:email,password:password,secretcode:secretcode},function(data){
				if(data == "wrong" || data != "OK"){
					$.msgbox("Secret code and email did not match. Make sure you entered the correct email and secret code and try again.", {type: "error"});
				}else{
					$.post('/login/process',{email:email,password:password},function(data){
						if(data == '1'){
							window.location.replace("/dashboard");
						}else{
							$.msgbox("Impossible but true. Your coder committed mistake. HAHA"+email+" "+password, {type: "error"});
						}
					});
				}
			});
		}
		
		//alert(email+ " " +password);
}