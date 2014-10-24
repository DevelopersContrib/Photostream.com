<?php $this->load->view('backend/header')?>
<?php $this->load->view('backend/navigation')?>
<link href="<?=base_url()?>css/pages/dashboard.css" rel="stylesheet">
<link href="<?=base_url()?>css/photostream.css" rel="stylesheet">
<script src="<?=base_url()?>js/blocksit.min.js"></script>
<script src="<?=base_url()?>js/lovesharecomment.js"></script>
<link href="<?=base_url()?>css/blocksit-style.css" rel="stylesheet" media="screen">
<style>
.albumpics {line-height: 30px; color:white !important;}
</style>
	
<div class="main">
	  <div class="container">

      <div class="row">
      
		<div class="span12">      		
      		
      		<div class="widget stacked ">
				<?if($album_pics->num_rows() > 0):?>
					
					<div class="widget-header">

						<div class="row-fluid">
							<div class="span12">
								<div class="row-fluid">
									<div class="span12" style="padding:3px 10px 0 10px;">
										<div class="row-fluid">
											<div class="wrap-user-title">
												<a href="<?=base_url()?><?=$user_username?>" target="_blank"><img style="float: left;margin: 6px;border-radius: 2px;height:50px;width:50px;"  src="<?=$avatar?>"></a>
												<div style="padding: 3px 0 3px 0;">
													<h3 style="margin: 0;margin-top:2px;display:inherit;line-height: 15px;top:2px;font-size: 18px;"><?=$stream_title?></h3>
													<div style="font-size: 10px;line-height: 20px;margin-left: 73px;"><?=date('M j, Y, g:i a',strtotime($stream_date))?></div>
													<div style="font: 12px/15px 'Open Sans';position: relative;top: 2px;display: inherit;line-height:15px;margin: 0 0 5px 70px;">&quot;<?=stripslashes($stream_description)?>&quot;</div>
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
						
					</div> <!-- /widget-header -->
					
					<!--------------------------------------------------------------------------------->
						
						<script type="text/javascript">
							/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
							var disqus_shortname = 'photostreamcom'; // required: replace example with your forum shortname
							
							/* * * DON'T EDIT BELOW THIS LINE * * */
							(function () {
							var s = document.createElement('script'); s.async = true;
							s.type = 'text/javascript';
							s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
							(document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
							}());
							</script> 
						
						
						
						
						<!--------------------------------------------------------------------------------->
				
					<div class="widget-content">
						<div class="menu_for_selected" style="text-align: right;">
								<form id="add_more_form" action="/stream/upload" method="POST" style="margin:0">
																										
									<a onclick="document.getElementById('add_more_form').submit();" class="btn btn-tertiary">
										&nbsp;<i class="icon-cloud-upload"></i>&nbsp;Add More Photos
									</a>
									
									<a href="<?=base_url()?>stream" class="btn btn-tertiary">
										&nbsp;<i class="icon-list"></i>&nbsp;View Streams
									</a>
																
									<input type="hidden" name="stream_id" id="stream_id" value="<?=$stream_id?>" />
									<!-- button type="submit"><i class="icon-cloud-upload"></i>&nbsp; Add </button -->
									
								</form>
								
								<div id="progress_bar_hidden" style="display:none;">
									<span id="progress_name"></span>
									<div class="progress progress-tertiary progress-striped active">
										<div class="bar" style="width: 75%"></div> <!-- /.bar -->				
									</div> <!-- /.progress -->
								</div>
						</div><!-- menu_for_selected-->
							
									
										<!-- GALLERY STYLE -->
									<div id="container" style="display:none;width:100%">
										<?foreach($album_pics->result() AS $pic):?>
											<div class="grid" id="<?=$pic->photo_id?>">
													<div class="photohover" id="hover<?=$pic->photo_id?>">
														
															<a href="javascript:deletePhoto(<?=$pic->photo_id?>);" class="albumpics" style="color:rgb(255, 130, 71);text-decoration:none">
																<i class="icon-trash" style="font-size: 16px;color:rgb(255, 130, 71);"></i>&nbsp;&nbsp;Delete Photo
															</a>
																<br>
															<a href="javascript:makeCoverPhoto(<?=$pic->photo_id?>);" class="albumpics" style="color:rgb(71, 248, 127);text-decoration:none">
																&nbsp;<i class="icon-upload"  style="font-size: 16px;color:rgb(71, 248, 127);"></i>&nbsp;Make Cover Photo
															</a>
																<br>
															<a href="javascript:makeAvatarPhoto(<?=$pic->photo_id?>);" class="albumpics" style="color:rgb(71, 174, 255);text-decoration:none">
																&nbsp;<i class="icon-user"  style="font-size: 16px;color:rgb(71, 174, 255);"></i>&nbsp;Make Avatar
															</a>											
																										
													</div>
													<div class="imgholder">
														<img src="<?=$pic->filename?>" />
													</div>
													<div class="meta" style="font-size: 11px;line-height: 15px;margin: 5px 0 0 0;border-bottom: 1px solid #e9e9e9;padding-bottom:3px">
														&quot;<?=str_replace('_',' ',$pic->title)?>&quot;
													</div>
													<div class="row-fluid" style="margin-bottom:-10px;font-size:11px">
														<? $sharecnt = 0; ?>
														<? $commentcnt =  $this->piccomments->getcountbyattribute('photo_id',$pic->photo_id); ?>
														<? $lovecnt =  $this->picslikes->getcountbyattribute('photo_id',$pic->photo_id); ?>
														<? $loved =  $this->picslikes->checkexist('photo_id',$pic->photo_id,'userid',$this->session->userdata('userid')); ?>
														
														<div style="padding:3px;display: inline;float: right;">
															<span><a href="javascript:lovePhoto(<?=$pic->photo_id?>,<?=$this->session->userdata('userid')?>);" class="meta-fbstyle-link"><span id="love<?=$pic->photo_id?>"><?=$lovecnt?></span> <img id="img<?=$pic->photo_id?>" src="<?=base_url()?><?=($loved===TRUE)?'img/loves.png':'img/love.png'?>" title="<?=$lovecnt?> people love this."></a></span>
															<span style="font-size: 12px; font-weight: bold; color: #ccc;"> &#8226; </span>
															<span><a href="javascript:;" class="meta-fbstyle-link"><?=$sharecnt?> <img src="<?=base_url()?>img/share.png" title="<?=$sharecnt?> people shared this."></a></span>
															<span style="font-size: 12px; font-weight: bold; color: #ccc;"> &#8226; </span>
															<span><a href="<?=base_url()?>photo/comment/<?=$pic->photo_id?>" target="_blank" class="meta-fbstyle-link"><?=$commentcnt?> <img src="<?=base_url()?>img/comment.png" title="<?=$commentcnt?> people left a comment."></a></span>
														</div>
														
													</div>													
												</div>
										<? endforeach; ?>
									</div>
							
							
						</div><!-- widget content -->
					<?else:?>
						<div class="widget-header">
							<i class="icon-camera"></i>
							<h3>Not found</h3>
						</div> <!-- /widget-header -->
				
						<div class="widget-content">
							<p><?=stripslashes($stream_description)?></p>
							
								<form id="add_more_form2" action="/stream/upload" method="POST">
									<input type="hidden" name="stream_id" id="stream_id" value="<?=$stream_id?>" />
									<a onclick="document.getElementById('add_more_form2').submit();" class="btn btn-tertiary">
										&nbsp;<i class="icon-cloud-upload"></i>&nbsp;Add Photos
									</a>
								</form>
								
								<center><strong>This stream has no content.</strong></center>
						</div>
					<?endif;?>
					
					
				
				
				
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
	
	$(document).ready(function() {	
		
		$('.albumpics').hover(
			function(){
				$(this).css('background','rgba(0, 0, 0,.5)');
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
	
	var base_url = $('#base_url').val();
	
	function deletePhoto(photo_id){
	
		var selected_arr =  [];	selected_arr.push(photo_id);
		var stream_id = $('#stream_id').val();
							
		$.post(base_url+'stream/deleteSelectedFromAlbum',{image_id_array:selected_arr,stream_id:stream_id},function(data){
			if(data == "OK"){						
				$('#'+photo_id).remove();
						
				$('#container').BlocksIt({
					numOfCol: 5,
					offsetX: 8,
					offsetY: 8
				});
						
			}else{
				$.msgbox("An error occurred: "+data, {type: "error"});
			}
		});
			
	}
	
	function makeCoverPhoto(photo_id){
	
		var stream_id = $('#stream_id').val();
					
		$.post(base_url+'stream/updateStreamCover',{photo_id:photo_id,stream_id:stream_id},function(data){
			if(data == "OK"){
				$.msgbox("Cover photo updated.", {type: "info"});
			}else{
				$.msgbox("An error occurred: "+data, {type: "error"});
			}
		});
			
	}
	
	function makeAvatarPhoto(photo_id){
					
		$.post(base_url+'stream/updateAvatar',{photo_id:photo_id},function(data){
			if(data == "OK"){
				$.msgbox("Avatar updated.", {type: "info"});
			}else{
				$.msgbox("An error occurred: "+data, {type: "error"});
			}
		});
			
	}
	
	
	
</script>

<?php $this->load->view('backend/footer')?>    
