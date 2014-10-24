<?php $this->load->view('backend/header')?>
<?php $this->load->view('backend/navigation')?>

<link href="<?=base_url()?>css/pages/dashboard.css" rel="stylesheet">
<link href="<?=base_url()?>css/photostream.css" rel="stylesheet">
<script src="<?=base_url()?>js/blocksit.min.js"></script>
<script src="<?=base_url()?>js/lovesharecomment.js"></script>
<link href="<?=base_url()?>css/blocksit-style.css" rel="stylesheet" media="screen">
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
	
<script type="text/javascript">

	activateMenu("stream_menu");

	$(document).ready(function() {
		
		var base_url = $('#base_url').val();
		
		//blocksit define
	$(window).load( function() {
					$('#gallery-container').show();
					$('#gallery-container').BlocksIt({
						numOfCol: 5,
						offsetX: 8,
						offsetY: 8
					});
					
					resize2();
				});
				
				function resize2() {
				 var winWidth = $(window).width();
				 var conWidth;
				if(winWidth < 240) {
				  conWidth = 155;
				  col = 1
				 } else if(winWidth < 320) {
				  conWidth = 230;
				  col = 1
				 } else if(winWidth < 680) {
				  conWidth = 387;
				  col = 1
				 }else if(winWidth < 880) {
				  conWidth = 483;
				  col = 2
				 } else if(winWidth < 1024) {
				  conWidth = 625;
				  col = 3;
				 } else {
				  conWidth = 785;
				  col = 4;
				 }
				 
				 if(conWidth != currentWidth) {
				  currentWidth = conWidth;
				  $('#gallery-container').width(conWidth);
				  $('#gallery-container').BlocksIt({
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
				
		$('#layoutoption').change(function(){
			var layout = $(this).val();
			var stream_id = $('#stream_id').val();
			$('#loading-container').html('<center><br><br><br><img src="'+base_url+'img/loading.gif"></center>');
			
			if(layout=='gallery'){	
				$('#loading-container').html('');
				$('#timeline-container').hide();
				$('#blog-container').hide();
				$('#gallery-container').show('slow');
			}
			else if(layout=='timeline'){					
				$('#gallery-container').hide();					
				$('#blog-container').hide();
				
				$.post(base_url+'photo/timeline',{stream_id:stream_id},function(res){
					$('#loading-container').html('');
					$('#timeline-container').html(res);	
					$('#timeline-container').show('slow');
				});
						
			}
			else if(layout=='blog'){
				$('#gallery-container').hide();
				$('#timeline-container').hide();
				
				$.post(base_url+'photo/blogstyle',{stream_id:stream_id},function(res){
					$('#loading-container').html('');
					$('#blog-container').html(res);	
					$('#blog-container').show('slow');
				});
				
				
			}
		});	
		
	
	$('.share').click(function(e){
	
			var links = $(this).attr("name");
			var id = $(this).attr('id').replace('share_','');
			var image;
			//var image_id = $('.imagesthumb').attr('id').replace('imagesthumb_','');
			var title = $('#titlepic_'+id).val();
			var social = $('#social_'+id).val();
			var userid = $('#user_id').val();
			
			if(social == "Facebook" || social == "facebook"){
				 image = $('.imageholder').attr("src");
			
			}else{
				image = $('#imagesthumb_'+id).attr("src");
			
			}
			
	
			e.preventDefault();
			FB.ui(
			{
			method: 'feed',
			name: title,
			link: links,
			picture: image,
			caption: 'www.beta.photostream.com',
			description: 'PhotoStream.com is your repository for all of your photos on the major social networks. Create streams and enjoy it publicly or privately with friends. ',
			message: 'PhotoStream.com is your repository for all of your photos on the major social networks. Create streams and enjoy it publicly or privately with friends. '
			},
			
			function(response) {
			if (response && response.post_id) {
				$.post('/photo/sharephoto',{id:id,userid:userid},function(res){
				
					$('#shares'+id).text(res);
				
				
				});
			
			  alert('Post was published.');
			}
		  }

			);
			 //alert(social);
			});
	
	
	});
		
</script>


<div class="main">
	  <div class="container">
	  
	  <!-- AddThis Button BEGIN -->
	<div class="addthis_toolbox addthis_floating_style addthis_32x32_style" style="left:50px;top:50px;">
	<a class="addthis_button_preferred_1"></a>
	<a class="addthis_button_preferred_2"></a>
	<a class="addthis_button_preferred_3"></a>
	<a class="addthis_button_preferred_4"></a>
	<a class="addthis_button_compact"></a>
	</div>
	<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4e12c919609fc3f8"></script>
	<!-- AddThis Button END -->

      <div class="row">
      
		<div class="span12">      		
      		
      		<div class="widget stacked " style="margin-top:20px">
      			
      			
				<?if($album_pics->num_rows() > 0):?>
						
					<div style="float: right;top: 15px;position: absolute;right: 10px;font-size: 12px;z-index: 1000;"> 
						<select id="layoutoption" style="width: auto;height: 25px;padding: 0px 0 0 5px;font-size: 12px;">
							<option value="gallery">Gallery View</option>
							<option value="timeline">Timeline View</option>
							<option value="blog">Blog View</option>
						</select>
					</div>
						
					<div class="widget-header" >

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
					
					
					
					<div class="widget-content">
						
						<div class="row-fluid">
							<div class="span12">
								<div class="row_fluid">
									<div class="span4 fbstyle-side-content" style="margin: -5px 0 0 0;;border: none;">
										<div class="row-fluid">
											<div style="margin: 10px;min-height: 25px;">
												<div class="side-user-info" style="border-width: 1px 1px 1px 1px;min-height: 25px;">
													<div class="row-fluid" style="height: 25px;">
														<div class="span12" style="margin: auto">
															<div class="span12">
																<div class="row-fluid">
																	<p class="side-work text-center">
																		<i class="icon-camera" style="margin-right:5px;"></i> Followers <span class="muted"><?=$follower_count?></span> | Following <span class="muted"><?=$followed_count?></span>
																	</p>
																</div>
															</div>
														</div>
													</div>
												</div>							
											</div>
											<? if($recent_follows->num_rows() != 0): ?>
											<div class="wrap-side-nav">
												<div class="side-header">
													<h4 class="side-title">RECENT ACTIVITY</h4>
												</div>
												<div style="clear: both;"></div>
												<div class="side-user-info">
													<? foreach($recent_follows->result() as $recent ): ?>
													<div class="row-fluid">
														<div class="span12" style="margin:auto;">
															<div class="span12 side-brdrbtm">
																<div class="row-fluid">
																	<div class="span2" style="margin: 0;">
																		<div class="row-fluid">
																			<a href="<?=base_url()?><?=$this->photousers->getinfobyid('username',$recent->followed_id)?>"><img src="<?=$this->photopics->getinfobyid('filename',$this->photousers->getinfobyid('avatar_id',$recent->followed_id))?>"></a>
																		</div>
																	</div>
																	<div class="span10" style="margin:0;">
																		<div class="row-fluid">
																			<p class="side-activity"><a href="<?=base_url()?><?=$this->photousers->getinfobyid('username',$recent->user_id)?>"><?=$this->photousers->getinfobyid('firstname',$recent->user_id)." ".$this->photousers->getinfobyid('lastname',$recent->user_id)?></a> followed <a href="<?=base_url()?><?=$this->photousers->getinfobyid('username',$recent->followed_id)?>"><?=$this->photousers->getinfobyid('firstname',$recent->followed_id)." ".$this->photousers->getinfobyid('lastname',$recent->followed_id)?>.</a></p>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<? endforeach; ?>
												</div>
											</div>
											<? endif; ?>
										</div>
									</div>
									<div class="span8 fbstyle-mid-content" style="margin:-10px 0 0 0;border: none;">
											
										<input type="hidden" id="stream_id" value="<?=$this->uri->segment(4);?>">	
										
										<div id="loading-container" style="width:100%"></div>
										
										<!-- GALLERY STYLE -->
										<div id="gallery-container" style="display:none;">
								
											<?foreach($album_pics->result() AS $pic):?>
											
												<? $sharecnt = $this->picshares->getcountbyattribute('photo_id',$pic->photo_id); //$commentcnt = 0; ?>
												<? $commentcnt =  $this->piccomments->getcountbyattribute('photo_id',$pic->photo_id); ?>
												<? $lovecnt =  $this->picslikes->getcountbyattribute('photo_id',$pic->photo_id); ?>
												<? $loved =  $this->picslikes->checkexist('photo_id',$pic->photo_id,'userid',$this->session->userdata('userid')); ?>
												
												<div class="gallery-grid">
													<?
														 $messages = explode(" ",str_replace('_',' ',$pic->title));
													
													?>
													<input type="hidden" id="social_<?=$pic->photo_id?>" value="<?=$messages[0]?>" />
													<input type="hidden" id="titlepic_<?=$pic->photo_id?>" value="<?=str_replace('_',' ',$pic->title)?>"/>
													<input type="hidden" id="user_id" value="<?=$this->session->userdata('userid')?>" />
													<div class="imgholder">
														<img class="imagesthumb" id="imagesthumb_<?=$pic->photo_id?>" src="<?=$pic->filename?>" />
													</div>
													<div class="meta" style="font-size: 12px;line-height: 15px;margin: 5px 0 0 0;border-bottom: 1px solid #e9e9e9;padding-bottom:3px">
														&quot;<?=str_replace('_',' ',$pic->title)?>&quot;
													</div>
													<div class="row-fluid" style="margin-bottom:-15px;font-size:11px;">
														<div style="padding:0 0 3px 3px;display: inline;float: right;">
															<span><a href="javascript:lovePhoto(<?=$pic->photo_id?>,<?=$this->session->userdata('userid')?>);" class="meta-fbstyle-link"><span id="love<?=$pic->photo_id?>"><?=$lovecnt?></span> <img id="img<?=$pic->photo_id?>" src="<?=base_url()?><?=($loved===TRUE)?'img/loves.png':'img/love.png'?>" title="<?=$lovecnt?> people love this."></a></span>
															<span style="font-size: 12px; font-weight: bold; color: #ccc;"> &#8226; </span>
															<span><a href="#" class="share" id="share_<?=$pic->photo_id?>" name="<?=base_url()?>photo/comment/<?=url_title($pic->title)?>/<?=$pic->photo_id?>"><span id="shares<?=$pic->photo_id?>"><?=$sharecnt?></span> <img src="<?=base_url()?>img/share.png" title="<?=$sharecnt?> people shared this."></a></span>
															<span style="font-size: 12px; font-weight: bold; color: #ccc;"> &#8226; </span>
															<span><a href="<?=base_url()?>photo/comment/<?=url_title($pic->title)?>/<?=$pic->photo_id?>" target="_blank" class="meta-fbstyle-link"><?=$commentcnt?> <img src="<?=base_url()?>img/comment.png" title="<?=$commentcnt?> people left a comment."></a></span>
														</div>
														
														
													</div>
												</div>
												
											<?endforeach;?>

										</div>
										
										<!-- TIMELINE STYLE -->
										<div id="timeline-container" style="width:100%;display:none">
										
										</div>
										
										<!-- BLOG STYLE -->
										<div id="blog-container" style="width:100%;display:none">
										
										</div>
										
										
									</div>
								</div>
							</div>
						</div>
								
					</div><!-- widget content -->
				<?else:?>
						<div class="widget-header" >

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
					
							<div class="widget-content" style="min-height:245px">

					
						<center><img  src = "http://www.beta.photostream.com/img/no-content.png"/></center>

					</div><!-- widget content -->
				<?endif;?>
				
				
			</div><!-- widget stacked -->
		</div><!-- span12 -->
		
      </div> <!-- /row -->

    </div> <!-- /container -->
  
</div> <!-- /main -->
<?php $this->load->view('backend/footer')?>    
