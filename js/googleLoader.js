activateMenu("stream_menu");

function showstreamsagain(){
	var base_url = $('#base_url').val();
	
	$('#loadingBar').html('<p class="generalNotif">Fetching data</p><div class="progress progress-primary progress-striped active"><div class="bar" style="width: 25%"></div></div>');
	
			$('#myStreams').html(html_data);
}