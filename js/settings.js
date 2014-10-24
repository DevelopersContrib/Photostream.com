$(document).ready(function(){

});

function saveSettings(){
	var firstname = $('#firstname').val();
	var lastname = $('#lastname').val();
	
	if($.trim(firstname) == "" || $.trim(lastname) == ""){
		$.msgbox("First Name and Last Name can not be empty ", {type: "error"});
	}else{
		$.post('/account/saveChanges',{firstname:firstname,lastname:lastname},function(data){
			if(data == "OK"){
				$.msgbox("Changes saved.", {type: "info"});
			}else{
				$.msgbox("An error occurred: "+data, {type: "error"});
			}
		});
		
	}
}

function saveSettingsPassword(){
	var old_password = $('#old_password').val();
	var password1 = $('#password1').val();
	var password2 = $('#password2').val();
	
	if($.trim(old_password) == ""){
		$.msgbox("For security purposes, the system requires you to provide your old password. ", {type: "error"});
	}else if($.trim(password1) == ""  || $.trim(password2) == ""){
		$.msgbox("Passwords can not be empty", {type: "error"});
	}else if(password1 != password2 ){
		$.msgbox("The passwords you provide did not match ", {type: "error"});
	}else{
		$.post('/account/saveChangePassword',{old_password:old_password,new_password:password1},function(data){
			if(data == "OK"){
				$.msgbox("Password changed successfully. ", {type: "info"});
			}else{
				$.msgbox("Password change was not successful due to following reason: "+data, {type: "error"});
			}
		});
	}
}