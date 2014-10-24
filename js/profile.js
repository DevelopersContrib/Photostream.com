$(function () {

});

function addfriend(){
	var to_add_userid = $('#to_add_userid').val();
		$.post('/friends/add_friend',
		{to_add_userid:to_add_userid},
		function(data){
			if(data == "OK"){
				$('#friendship').html('<p>Waiting for confirmation</p>');
				
			}else{
				$.msgbox("An error occurred: "+data, {type: "error"});
			}
		});
}

function follow(profileid){
	
	$.post('/profile/followuser',
		{profileid:profileid},
		function(data){
			if(data=='exists'){
				
				
			}else{
				//$.msgbox("An error occurred: "+data, {type: "error"});
				$('#followers').html('Follower ('+data+')');
				$('#b_follow').html('<p class="text-center"> <a href="#" class="btn btn-danger"> <i class="icon-camera"></i> Following</a> </p>');
			}
		});
}
