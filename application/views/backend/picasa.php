<?php $this->load->view('backend/header')?>
<?php $this->load->view('backend/navigation')?>
<link href="/css/pages/dashboard.css" rel="stylesheet">
<div class="main">
	  <div class="container">

      <div class="row">
      
		<div class="span12">      		
      		
      		<div class="widget stacked ">
					<div class="widget-header">
						<i class="icon-camera"></i>
						<h3>Google Albums</h3>
					</div> <!-- /widget-header -->
				
					<div class="widget-content">
					<form id="add_more_form" action="/stream/upload" method="POST" style="margin:0">
							<a onclick="document.getElementById('add_more_form').submit();" class="btn btn-tertiary">
									&nbsp;<i class="icon-long-arrow-left"></i>&nbsp;Back to Socials
							</a>
							<input type="hidden" name="stream_id" id="stream_id" value="<?=$this->session->userdata('stream_id')?>" />
					</form>
						<div class="menu_for_selected">
									<!-- button type="submit"><i class="icon-cloud-upload"></i>&nbsp; Add </button -->

								<div id="progress_bar_hidden" style="display:none;">
									<span id="progress_name"></span>
									<div class="progress progress-tertiary progress-striped active">
										<div class="bar" style="width: 75%"></div> <!-- /.bar -->				
									</div> <!-- /.progress -->
								</div>
						</div><!-- menu_for_selected-->

								<ul class="gallery-container">
									<? foreach ($albums as $album): ?>
                                                                        <? if($album['id'] == "5895833093332960753"):
                                                                          echo "<h1>Invalid account</h1>";  ?>
                                                                          <? else: ?>
                                                                         <li>
                                                                          
                                                                            <img src="<?=$album['pics'][0]['thumbs'][1]?>" alt="<?=$album['title']?>" />
                                                                           <br />
                                                                            <p><a href="<?=base_url()?>googleplus/pics/<?=$album['id']?>"> <?=$album['title']?></a></p>
                                                                         </li>
                                                                         <? endif; ?>
                                                                          <? endforeach; ?>
								</ul>
						</div><!-- widget content -->
							    </form>    
					
					
					
				
				
				
			</div><!-- widget stacked -->
		</div><!-- span12 -->
		
      </div> <!-- /row -->

    </div> <!-- /container -->
  
</div> <!-- /main -->


<link href="<?=base_url()?>js/plugins/msgGrowl/css/msgGrowl.css" rel="stylesheet">
<link href="<?=base_url()?>js/plugins/lightbox/themes/evolution-dark/jquery.lightbox.css" rel="stylesheet">	
<link href="<?=base_url()?>js/plugins/msgbox/jquery.msgbox.css" rel="stylesheet">

<script src="<?=base_url()?>js/plugins/msgGrowl/js/msgGrowl.js"></script>
<script src="<?=base_url()?>js/plugins/lightbox/jquery.lightbox.min.js"></script>
<script src="<?=base_url()?>js/plugins/msgbox/jquery.msgbox.min.js"></script>

<script type="text/javascript">
	activateMenu("stream_menu");
	
	$(document).ready(function(){
		$('#delete_selected_btn').click(function(){
		
			
			var selected_arr = getAllChecked();
			var stream_id = $('#stream_id').val();
			
			if(selected_arr.length > 0){
					$('#progress_bar_hidden').css('display','block');
					$('#progress_name').text('deleting');
					
				$.post('/stream/deleteSelectedFromAlbum',{image_id_array:selected_arr,stream_id:stream_id},function(data){
					if(data == "OK"){
						$.msgbox("Selected images successfully removed.", {type: "info"});
						$('#progress_bar_hidden').css('display','none');
						$('input:checkbox').removeAttr('checked');
						location.reload();
					}else{
						$.msgbox("An error occurred: "+data, {type: "error"});
					}
				});
			}else{
				$.msgbox("Select at least one image to delete", {type: "error"});
			}
		});
		
		
		$('#assign_cover_btn').click(function(){
				var selected_arr = getAllChecked();
				var stream_id = $('#stream_id').val();
				
				if(selected_arr.length > 0){
					if(selected_arr.length > 1){
						$.msgbox("Make up your mind, select the ONE.", {type: "error"});
					}else{
						$.post('/stream/updateStreamCover',{photo_id:selected_arr[0],stream_id:stream_id},function(data){
							if(data == "OK"){
								$.msgbox("Cover photo updated.", {type: "info"});
							}else{
								$.msgbox("An error occurred: "+data, {type: "error"});
							}
						});
						
					}
				}else{
					$.msgbox("Please select one.", {type: "error"});
				}
		});
		
		$('#assign_avatar_btn').click(function(){
				var selected_arr = getAllChecked();
				var stream_id = $('#stream_id').val();
				
			if(selected_arr.length > 0){
					if(selected_arr.length > 1){
						$.msgbox("Make up your mind, select the ONE.", {type: "error"});
					}else{
						$.post('/stream/updateAvatar',{photo_id:selected_arr[0]},function(data){
							if(data == "OK"){
								$.msgbox("Avatar updated.", {type: "info"});
							}else{
								$.msgbox("An error occurred: "+data, {type: "error"});
							}
						});
					}
				}else{
					$.msgbox("Please select one.", {type: "error"});
				}
		});
	});
	
	function getAllChecked(){
		var for_delete_arr = [];
			$("input:checkbox[name=photo_selected]:checked").each(function(){
				for_delete_arr.push($(this).val());
			});
		return for_delete_arr;
	}
	
</script>

<?php $this->load->view('backend/footer')?>  
