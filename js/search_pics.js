$(function(){
	
});

activateMenu('stream_menu');

function gotoPage(page){
	$('#search_results').html('<li><div class="progress progress-primary progress-striped active"><div class="bar" style="width: 25%"></div></div></li>');
	var base_url = $('#base_url').val();
	var key = $('#key').val();
	
	$('.active').removeClass();
	$('#pg_'+page).attr('class','active');
	
	
	$.post(base_url+'search/getnextpage',{page:page,key:key},function(page_html){
		$('#search_results').html(page_html);
	});
}