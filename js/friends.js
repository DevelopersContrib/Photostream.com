$(function () {
	var all_friends_count = $('#all_friends_count').val();
	var added_friends_count = $('#added_friends_count').val();
 	var waiting_friends_count = $('#waiting_friends_count').val();
	
	 all_friends_count = parseInt(all_friends_count,10);
	 added_friends_count = parseInt(added_friends_count,10);
 	 waiting_friends_count = parseInt(waiting_friends_count,10);
	
	$('#display_all_friends_count').text(all_friends_count);
	$('#display_added_friends_count').text(added_friends_count);
	$('#display_waiting_friends_count').text(waiting_friends_count);
	
});

function ConfirmAddFriend(accept_id){
	$.post('/friends/acceptFriend',
	{accept_id:accept_id},function(data){
		if(data == "OK"){
			all_friends_count++;
			waiting_friends_count--;
			$('#display_all_friends_count').text(all_friends_count);
			$('#display_waiting_friends_count').text(waiting_friends_count);
			$('#friend_'+accept_id).remove();
				if(waiting_friends_count == 0){
					$('#waiting_friends_container').html('<strong><p>No pending invites.</p></strong>');
				}
		}else{
			$.msgbox("Failed: "+data, {type: "error"});
		}
	});
}

function CancelRequest(cancel_request_id){
	$.post('/friends/cancelRequest',
	{cancel_request_id:cancel_request_id},function(data){
		if(data == "OK"){
			added_friends_count--;
			$('#display_added_friends_count').text(added_friends_count);
			$('#added_'+cancel_request_id).remove();
			if(added_friends_count == 0){
				$('#added_friends_container').html('<strong><p>Invited Friends list is empty.</p></strong>');
			}
		}else{
			$.msgbox("Failed: "+data, {type: "error"});
		}
	});
}

function unfriend(friendship_id){
	$.post('friends/unfriend',{friendship_id:friendship_id},function(data){
		if(data == "OK"){
			$('#already_friend_'+friendship_id).remove();
		}else{
			$.msgbox("An error occurred: "+data, {type: "error"});
		}
	});
}