<?php $this->load->view('backend/header')?>
<?php $this->load->view('backend/navigation')?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>
<link href="<?=base_url()?>css/pages/dashboard.css" rel="stylesheet">
<link href="<?=base_url()?>css/photostream.css" rel="stylesheet">
<script src="<?=base_url()?>js/blocksit.min.js"></script>
<script src="<?=base_url()?>js/lovesharecomment.js"></script>
<link href="<?=base_url()?>css/blocksit-style.css" rel="stylesheet" media="screen">
<style>
.albumpics {line-height: 30px; color:white !important;}
.edit {line-height: 30px; color:white !important;}
.delete {line-height: 30px; color:white !important;}
</style>
	
<div class="main">
	  <div class="container">

      <div class="row">
      
		<div class="span12">      		
      		
      		<div class="widget stacked ">
				<!------------------------------------------>
				<div id="fb-root"></div>
					<script>
					window.fbAsyncInit = function() {
					FB.init({appId: '303778466421063', status: true, cookie: true,
					xfbml: true});
					};
					(function() {
					var e = document.createElement('script'); e.async = true;
					e.src = document.location.protocol +
					'//connect.facebook.net/en_US/all.js';
					document.getElementById('fb-root').appendChild(e);
					}());
					</script>
				

				
				<!------------------------------------------>
					
					<div class="widget-header">
						<i class="icon-camera-retro"></i>
      				<h3>Your Streams</h3>
					</div> <!-- /widget-header -->				
										<!-- GALLERY STYLE -->
						<div class="widget-content" style="min-height:300px">
							<div class="row-fluid">
							<?if($user_streams->num_rows() > 0):?>
								<div id="container" style="display:none;width:100%">
									<?foreach($user_streams->result() AS $stream):?>
										<div class="grid" id="<?=$stream->stream_id?>">
												<div class="photohover" id="hover<?=$stream->stream_id?>">
													
														<a href="<?=base_url()?>stream/album/<?=($stream->title=='')?'&nbsp;':url_title($stream->title)?>/<?=$stream->stream_id?>" class="albumpics" style="color:rgb(255, 130, 71);text-decoration:none">
															<i class="icon-picture" style="font-size: 16px;color:rgb(208,244,40);"></i>&nbsp;&nbsp;View Album
														</a>
															<br>
														<a href="#confirm_delete_modal" data-toggle="modal" title="delete" id="<?=$stream->stream_id?>" class="delete" style="font-size: 16px;color:rgb(255, 130, 71);">
															<i class="icon-trash" style="font-size: 16px;color:rgb(255, 130, 71);text-decoration:none"></i>&nbsp;&nbsp;Delete Album
														</a>
															<br>
														<a href="#edit_stream_info" data-toggle="modal" id="<?=$stream->stream_id?>" class="edit" title="edit stream" style="font-size: 16px;color:rgb(71, 248, 127);">
															&nbsp;<i class="icon-edit"  style="font-size: 16px;color:rgb(71, 248, 127);text-decoration:none"></i>&nbsp;Edit Album
														</a>
															<br>
														<a href="#" class="share" style="color:rgb(71, 174, 255);text-decoration:none" id="<?=base_url()?>stream/album/<?=($stream->title=='')?'&nbsp;':url_title($stream->title)?>/<?=$stream->stream_id?>" >
															&nbsp;<i class="icon-share"  style="font-size: 16px;color:rgb(71, 174, 255);"></i>&nbsp;Share Album
														</a>
															
																									
												</div>
												<div class="imgholder">
													<a href="<?=base_url()?>stream/album/<?=($stream->title=='')?'&nbsp;':url_title($stream->title)?>/<?=$stream->stream_id?>" style="text-decoration:none" target="_blank"><img src="<?=(!$stream->cover_pic == NULL)?$this->photopics->getinfobyid('filename',$stream->cover_pic):'http://d2qcctj8epnr7y.cloudfront.net/images/2013/avatar-photostream-logo.png'?>" /></a>
												</div>
												
												<div class="meta">
													<label style="text-align:right;margin: -25px 5px 5px 0;;">
														<a href="#confirm_delete_modal" data-toggle="modal" title="delete" id="<?=$stream->stream_id?>" class="delete">
														<!--<img src="<?//=base_url()?>img/trash.gif" style="background: rgba(0,0,0,.5);padding:3px;">--></a>
														<a href="#edit_stream_info" data-toggle="modal" id="<?=$stream->stream_id?>" class="edit" title="edit stream" style="margin-left:-4px">
														<!--<img src="<?//=base_url()?>img/edit.png" style="background: rgba(0,0,0,.5);padding:3px;">--></a>
													</label>
													<p><?=($stream->title=='')?'&nbsp;':$stream->title?></p>
											</div>										
									</div>
									<? endforeach; ?>
								</div>
						
					
				<?else:?>
					<p>You have no streams yet.</p>
				<?endif;?>
				</div>
				</div><!-- widget content -->
				
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
	$(document).ready(function() {	
		
		$('.albumpics').hover(
			function(){
				$(this).css('background','rgba(0, 0, 0,.5)');
			},
			function(){
				$(this).css('background','none');
			}
		);
		
		$('.delete').hover(
			function(){
				$(this).css('background','rgba(0, 0, 0,.5)');
				$(this).css('text-decoration','none');
			},
			function(){
				$(this).css('background','none');
			}
		);
		
		$('.edit').hover(
			function(){
				$(this).css('background','rgba(0, 0, 0,.5)');
				$(this).css('text-decoration','none');
			},
			function(){
				$(this).css('background','none');
			}
		);
	
		//blocksit define
		$(window).load( function() {
				$('#container').show();
					$('#container').BlocksIt({
						numOfCol: 5,
						offsetX: 8,
						offsetY: 8
					});
					
				resize2();
		
		
			var pinterestphotos = $('#container').children('div');
								
			$.each(pinterestphotos,function(key,value){
				console.log(value);					
				var gridID = $(value).attr('id');
				var gridH = $('#'+gridID).height();
				var gridW  = $('#'+gridID).width();
				
					
				$('#hover'+gridID).css('width',Math.round(gridW)+30);
				$('#hover'+gridID).css('height',(Math.round(gridH)/2)+40);
				$('#hover'+gridID).css('padding-top',(Math.round(gridH)/2)-40);
				$('#hover'+gridID).css('margin-bottom',-1*(Math.round(gridH)-15));
			});						
		});
		
		function resize2() {
				 var winWidth = $(window).width();
				 var conWidth;
				if(winWidth < 240) {
					  conWidth = 149;
					  col = 1
					 }else if(winWidth < 320) {
					  conWidth = 230;
					  col = 1
					 } else if(winWidth < 680) {
					  conWidth = 387;
					  col = 1
					 }else if(winWidth < 880) {
					  conWidth = 690;
					  col = 3
					 } else if(winWidth < 1024) {
					  conWidth = 907;
					  col = 4;
					 } else {
					  conWidth = 1136;
					  col = 5;
					 }
				 
				 if(conWidth != currentWidth) {
				  currentWidth = conWidth;
				  $('#container').width(conWidth);
				  $('#container').BlocksIt({
				   numOfCol: col,
				   offsetX: 8,
				   offsetY: 8
				  });
				 }
				}
				
				//window resize
				var currentWidth = 1100;
				$(window).resize(function(){
					resize2();
				});
		
							
		$(".grid").mouseenter(function(){
			var gridID = $(this).attr('id');
			$('#hover'+gridID).show();
		}).mouseleave(function(){
			var gridID = $(this).attr('id');
			$('#hover'+gridID).hide();
		});
		
	});
</script>

<script type="text/javascript">
	activateMenu("stream_menu");
	var stream_selected = "";
	
	$(document).ready(function(){
		
		$('.delete').click(function(){
			var stream_id = $(this).attr("id");
			stream_selected = stream_id;
			$.post('/stream/deleteStreamInfo',{stream_id:stream_id},function(html_data){
				$('#stream_info').html(html_data);
			});
		});
		
		$('.edit').click(function(){
			var stream_id = $(this).attr("id");
			stream_selected = stream_id;
				$.post('/stream/editStreamInfo',{stream_id:stream_id},function(html_data){
					$('#stream_info_to_edit').html(html_data);
				});
				
		});
		
	});
	
	$('.share').click(function(e){
	
			var links = $(this).attr("id");
			var image = $('.imageholder').attr("src");
	
			e.preventDefault();
			FB.ui(
			{
			method: 'feed',
			name: image,
			link: links,
			picture: image,
			caption: 'www.beta.photostream.com',
			description: 'PhotoStream.com is your repository for all of your photos on the major social networks. Create streams and enjoy it publicly or privately with friends. ',
			message: 'PhotoStream.com is your repository for all of your photos on the major social networks. Create streams and enjoy it publicly or privately with friends. '
			},
			
			function(response) {
			if (response && response.post_id) {
			  alert('Post was published.');
			}
		  }
			
			
			);
			});
	
	function deleteStream(){
		$('.modal-footer').html('<div class="progress progress-primary progress-striped active"><div class="bar" style="width: 25%"></div></div>');
		$.post('/stream/deleteStream',{stream_id:stream_selected},function(data){
			if(data == "OK"){
				$('#stream_info').html('<p>Stream successfully deleted.</p>');
				$('#question').html('');
				$('#delete_footer').html('<div class="modal-footer"><a href="javascript:;" class="btn btn-primary" data-dismiss="modal">Ok</a></div>');
				
				$('#'+stream_selected).remove();
				$('#container').BlocksIt({
					numOfCol: 5,
					offsetX: 8,
					offsetY: 8
				});
			}else{
				$('#delete_footer').html("An error occurred: "+data);
			}
		});
	}
	
	function UpdateStreamInfo(){
		$('#edit_footer').html('<p>Saving changes..</p><div class="progress progress-primary progress-striped active"><div class="bar" style="width: 60%"></div></div>');
		var new_title = $('#new_title').val();
		var new_description = $('#new_description').val();
		var new_is_public = '0';
			if($('#new_is_public').is(':checked')){
				new_is_public = '1';
			}
		
		$.post('/stream/updateStream',{stream_id:stream_selected,title:new_title,description:new_description,is_public:new_is_public},function(data){
			if(data == "OK"){
				$('#edit_footer').html('');
				$('#stream_info_to_edit').html("Stream Update successful.");
				location.reload();
			}else{
				$('.modal-footer').html("An error occurred: "+data);
			}
		});
		
	}
</script>

<div class="modal fade hide" id="confirm_delete_modal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h3>Confirm Delete</h3>
  </div>
  <div class="modal-body">
    <p id="question">Are you sure you want to delete this stream?</p>
	<div id="stream_info">
		<p>Fetching info</p>
		<div class="progress progress-primary progress-striped active"><div class="bar" style="width: 25%"></div></div>
	</div><!-- stream_info -->
  </div>
 
  <div class="modal-footer" id="delete_footer">
    <a href="javascript:;" class="btn" data-dismiss="modal">Cancel</a>
    <a href="javascript:deleteStream();" class="btn btn-primary">Delete</a>
  </div>
</div>

<div class="modal fade hide" id="edit_stream_info">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h3>Edit Stream Info</h3>
	</div>
	
	<div class="modal-body">
		<div id="stream_info_to_edit">
			<p>Fetching info</p>
			<form class="form-horizontal" >
				<fieldset>
					<div class="progress progress-primary progress-striped active"><div class="bar" style="width: 25%"></div></div>
				</fieldset>
			</form>
		</div><!-- stream_info -->
	</div>
 
  <div class="modal-footer" id="edit_footer">
    <a href="javascript:;" class="btn" data-dismiss="modal">Cancel</a>
    <a href="javascript:UpdateStreamInfo();" class="btn btn-primary">Update</a>
  </div>
	
</div><!-- modal for edit stream-->


<?php $this->load->view('backend/footer')?>  
