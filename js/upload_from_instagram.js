$(document).ready(function(){
	
});

function submit_insta_pics(){
		
		var selected_pics = [];
		var url = '';
		var cover = $('input[name=stream_cover]:checked', '#submit_insta_pics').val();
		var stream_id = $('#stream_id').val();
		var stream_name = $('#stream_name').val();
		$("input:checkbox[name=instapic_url]:checked").each(function(){
			url = $(this).val();
			selected_pics.push(url);
		});
		
		//check if an image is selected 
			if(selected_pics.length <= 0){
				alert("no image selected");
			}else{
				if (!($("input[name='stream_cover']:checked").val())) {
				   var random_cover = selected_pics[Math.floor(Math.random()*selected_pics.length)];
				   cover = random_cover;
				}
				
				$.post('/stream/save_instagram_pics',{cover:cover,selected_pics:selected_pics},function(data){
					if(data == "OK"){
						window.location.replace("/stream/album/"+stream_name+"/"+stream_id);
					}else{
						alert("An error occurred: "+data);
					}
				});
				
			}
}