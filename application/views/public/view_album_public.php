<?php $this->load->view('public/header')?>

<?php $this->load->view('public/navigation')?>

<link href="/css/pages/dashboard.css" rel="stylesheet">
<script src="/js/blocksit.min.js"></script>
<link href="/css/blocksit-style.css" rel="stylesheet" media="screen">
	
	<script>
		$(document).ready(function() {
				
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
				
				if(layout=='gallery'){					
					$('#timeline-container').hide();
					$('#blog-container').hide();
					$('#gallery-container').show('slow');
				}
				else if(layout=='timeline'){					
					$('#gallery-container').hide();					
					$('#blog-container').hide();
					$('#timeline-container').show('slow');					
				}
				else if(layout=='blog'){
					$('#gallery-container').hide();
					$('#timeline-container').hide();
					$('#blog-container').show('slow');
				}
			});
		});
	</script>


<div class="main">

	  <div class="container">

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
				
					<div class="widget-header" style="margin-top:15px;">

						<div class="row-fluid">
							<div class="span12">
								<div class="row-fluid">
									<div class="span12" style="padding:3px 10px 0 10px;">
										<div class="row-fluid">
											<div class="wrap-user-title">
												<a href="<?=base_url()?><?=$user_username?>" target="_blank"><img class="fbstyle-img" style="height:50px;width:50px;"  src="<?=$avatar?>"></a>
												<div class="meta-wrap-title">
													<h3 class="meta-fbstyle-title" style="margin-top:2px;display:inherit;line-height: 15px;top:2px;font-size: 18px;"><?=$stream_title?></h3>
													<div class="meta-date" style="line-height: 20px;margin-left: 73px;"><?=date('M j, Y, g:i a',strtotime($stream_date))?></div>
													<div class="gallery-desc" style="display: inherit;line-height:15px;margin: 0 0 5px 70px;">&quot;<?=stripslashes($stream_description)?>&quot;</div>
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
											 <!-------------------------------------------------------------------------->
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
											 
											 
											 
											 <!-------------------------------------------------------------------------->
										</div>
									</div>
									<div class="span8 fbstyle-mid-content" style="margin:-10px 0 0 0;border: none;">
										<div class="fbstyl-brdrtop" style="margin-bottom: 10px;border: none;display:none">
												<div class="fbstyle-box">
													<div class="row-fluid">
														<div class="span12">
															<div class="span1">
																<img class="fbstyle-img" src="http://i.cdn.turner.com/cnn/.element/img/2.0/sect/connect/avatar.gif">
															</div>
															<div class="span11" style="padding-top: 3px;">
																	<div class="row-fluid">
																		<a href="#" class="fbstyle-user-name"><strong>Jeiseun Slow</strong></a> — <span class="meta-fbstyle-addphts">added a photos. </span><span class="meta-fbstyle-hours"> 21 hours ago</span>
																	<span>
																		<p class="meta-fbstyle-desc">
																		God has a prefect plan for each and everyone. Most of the time we dwell on the past not knowing what lies ahead of us but if we are patient enough, you will then realize that the best is yet to come.
																		</p>
																	</span>
																	</div>
															</div>
														</div>
													</div>
													<div class="row-fluid">
														<img class="img-polaroid fb-content-img" src="http://farm4.staticflickr.com/3734/8964505271_95eb2ded00_b.jpg">
													</div>
													<div class="row-fluid" style="border-bottom: 1px solid #e9e9e9;">
														<div style="padding-left: 3px;">
															<span><a href="#" class="meta-fbstyle-link">Love</a></span>
															<span style="font-size: 12px; font-weight: bold; color: #ccc;">·</span>
															<span><a href="#" class="meta-fbstyle-link">Share</a></span>
														</div>
													</div>
													<div class="row-fluid" style="margin-bottom: 5px;">
														<div style="padding-left: 3px;">
															<span class="meta-fbstyle-text">
																<a href="#" class="meta-fbstyle-link">4 people</a> love this.
															</span>
															and
															<span class="meta-fbstyle-text">
																<a href="#" class="meta-fbstyle-link">6 people</a> share this.
																</span>
														</div>
													</div>
												</div>
										
											</div>
										<!-- GALLERY STYLE -->
										<div id="gallery-container" style="display:none;width:100%">
								
											<?foreach($album_pics->result() AS $pic):?>
											<? $lovecnt =  $this->picslikes->getcountbyattribute('photo_id',$pic->photo_id); ?>
												
												<div class="gallery-grid">
													<div class="imgholder">
														<img src="<?=$pic->filename?>" />
													</div>
													<div class="meta" style="font-size: 11px;line-height: 15px;margin: 5px 0 0 0;border-bottom: 1px solid #e9e9e9;padding-bottom:3px">
														&quot;<?=str_replace('_',' ',$pic->title)?>&quot;
													</div>
													<div class="row-fluid" style="margin-bottom:-10px">
														<div style="padding-left: 3px;display:inline;">
															<span><a href="#" class="meta-fbstyle-link"><?=$lovecnt?> Love</a></span>
															<span style="font-size: 12px; font-weight: bold; color: #ccc;"> &#8226; </span>
														</div>
													</div>
												</div>
												
											<?endforeach;?>

										</div>
										
										<!-- TIMELINE STYLE -->
										<div id="timeline-container" style="width:100%;display:none">
											<?foreach($album_pics->result() AS $pic):?>
											<? $lovecnt =  $this->picslikes->getcountbyattribute('photo_id',$pic->photo_id); ?>
																						
											<div class="fbstyl-brdrtop" style="margin-bottom: 10px;border:none;">
												<div class="fbstyle-box" style="margin-top: 15px;">
													<div class="row-fluid">
														<div class="span12">
															<div class="span1">
																<img class="fbstyle-img" src="<?=$avatar?>" style="height: 42px;width: 42px;">
															</div>
															<div class="span11" style="padding-top: 3px;">
																	<div class="row-fluid">
																		
																		<a href="<?=base_url()?><?=$user_username?>" target="_blank" class="fbstyle-user-name" style="font-size: 12px">
																			<strong>																			
																			<?=$user_fname?> <?=$user_lname?>
																			</strong>
																		</a> 
																		&mdash; <span class="meta-fbstyle-addphts" style="font-size: 11px">added a photo. </span>
																		<span class="meta-fbstyle-hours" style="font-size: 11px">
																			<? $laps = abs((time() - strtotime($pic->date_uploaded)) / (60 * 60 * 24));?>
																			<? 
																				if(intval($laps)>0)
																					echo intval($laps).' days ago';
																				else if($laps>=0.1)
																					echo intval($laps*10).' hours ago';
																				else if($laps>=0.01)
																					echo intval($laps*100).' minutes ago';
																				else
																					echo intval($laps*1000).' seconds ago';
																			?>
																		</span>
																		<span>
																			<p class="meta-fbstyle-desc">
																			&quot;<?=str_replace('_',' ',$pic->title)?>&quot;
																			</p>
																		</span>
																	</div>
															</div>
														</div>
													</div>
													<div class="row-fluid">
														<center><img class="img-polaroid fb-content-img" src="<?=$pic->filename?>" style="max-width:96%;width:auto;height:auto;"></center>
													</div>
													<div class="row-fluid" style="border-bottom: 1px solid #e9e9e9;">
														<div style="padding-left: 3px;">
															<span><a href="#" class="meta-fbstyle-link">Love</a></span>
															<span style="font-size: 12px; font-weight: bold; color: #ccc;"> &#8226; </span>
														</div>
													</div>
													<div class="row-fluid" style="margin-bottom: 5px;">
														<div style="padding-left: 3px;">
															<span class="meta-fbstyle-text">
																<a href="#" class="meta-fbstyle-link"><?=$lovecnt?> people</a> love this.
															</span>
														</div>
													</div>
												</div>
											</div>
											<?endforeach;?>
										</div>
										
										<!-- BLOG STYLE -->
										<div id="blog-container" style="width:100%;display:none">
											<div style="border-left: 1px solid #e9e9e9;margin: 15px 10px; 10px; 10px;">
												<?foreach($album_pics->result() AS $pic):?>	
												<? $lovecnt =  $this->picslikes->getcountbyattribute('photo_id',$pic->photo_id); ?>
													<div class="row-fluid" style="border-bottom: 2px solid #534741;width: 85%;margin:auto; margin-bottom: 30px;padding-bottom: 4px;">
														<div class="span12">
															<div class="row-fluid">
																<div class="span12" style="text-align: center;">
																	<img class="img-polaroid" src="<?=$pic->filename?>">
																</div>
															</div>
															
															<div class="row-fluid" style="margin-top:5px;border-bottom: 1px solid #ccc;padding-bottom: 3px;">
																<div class="span12">
																	
																	<div class="row-fluid">
																		<div class="span12">
																			<div class="row-fluid">
																				<div class="span1" style="margin:0;margin-right: 10px;">
																					<span class="meta-blogstyle-date" style="float:left;font-size: 35px;font-weight: 700;padding: 6px 0 0;width: 100%;color: #959595;"><?=date('j',strtotime($pic->date_uploaded))?></span>
																					
																					<span class="meta-blogstyle-year" style="float:left;font-size: 9px;font-weight: 700;letter-spacing: 1.5px;padding-top: 0;text-transform: uppercase;width: 100%;padding-left: 5px;color: #959595;"><?=date('My',strtotime($pic->date_uploaded))?></span>
																				</div>
																				<div class="span11" style="margin:0">
																				<div class="row-fluid" style="margin-top: 5px;">
																						<div style="padding-left: 3px;line-height: 15px;">
																							<span class="meta-fbstyle-text">
																								&quot;<?=str_replace('_',' ',$pic->title)?>&quot;
																							</span>
																						</div>
																					</div>
																					<div class="row-fluid" style="">																						
																						<div style="padding: 3px 0 0 3px;display: inline-block;">
																							<span class="meta-fbstyle-text">
																								<a href="#" class="meta-fbstyle-link"><?=$lovecnt?> people</a> love this.
																							</span>
																						</div>
																						<div style="padding-left: 3px;display: inline-block;float:right">
																							<span><a href="#" class="meta-fbstyle-link">Love</a></span>
																							<span style="font-size: 12px; font-weight: bold; color: #ccc;"> &#8226;</span>
																							
																						</div>
																					</div>																					
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												<?endforeach;?>
											</div>
										</div>
										
									</div>
								</div>
							</div>
						</div>
						
					</div><!-- widget content -->

				<?else:?>

					<div class="widget-header">

						<i class="icon-camera"></i>

						<h3>Stream Not Found</h3>

					</div> <!-- /widget-header -->

					

					<div class="widget-content" style="min-height:245px">

					
						<center><img  src = "http://www.beta.photostream.com/img/404.png"/></center>

					</div><!-- widget content -->

				<?endif;?>

				

				

			</div><!-- widget stacked -->

		</div><!-- span12 -->

		

      </div> <!-- /row -->



    </div> <!-- /container -->

  

</div> <!-- /main -->

<?php $this->load->view('public/footer')?>