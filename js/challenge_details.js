activateMenu('challenge_menu');

$(function(){
	var base_url = $('#base_url').val();
	
	$('#submitbtn').click(function(){
		$('#submitbtn').remove();
		$("#challengesubmitform").css('display','block');
	});
	
	
	$('#showSelectFromStream').click(function(){
		$.post(base_url+'challenges/showSelectFromStream',function(html_data){
			$('#myStreams').html(html_data);
		});
	});
	
	
});

function showStreamContent(stream_id){
	var base_url = $('#base_url').val();
	
	$('#myStreams').html('<p class="generalNotif">Fetching data</p><div class="progress progress-primary progress-striped active"><div class="bar" style="width: 25%"></div></div>');
	$.post(base_url+'challenges/showStreamContents',{stream_id:stream_id},function(stream_contents){
		$('#myStreams').html(stream_contents);
	});
}

function showstreamsagain(){
	var base_url = $('#base_url').val();
	
	$('#myStreams').html('<p class="generalNotif">Fetching data</p><div class="progress progress-primary progress-striped active"><div class="bar" style="width: 25%"></div></div>');
	$.post(base_url+'challenges/showSelectFromStream',function(html_data){
			$('#myStreams').html(html_data);
	});
}



function selectThisImage(photo_id){
	var base_url = $('#base_url').val();
	
	
	$.post(base_url+'challenges/getFilename',{photo_id:photo_id},function(url){
		var photo_url = url;
	
		$('#selected_photo_url').val(photo_url);
		$('#preview_image').html('<img style="width:200px;height:200px;" src="'+photo_url+'" alt="'+photo_url+'"/>');
	});
	
}

