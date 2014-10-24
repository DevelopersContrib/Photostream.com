<?php $this->load->view('backend/header')?>
<?php $this->load->view('backend/navigation')?>

<link href="<?=base_url()?>css/pages/dashboard.css" rel="stylesheet">
<link href="<?=base_url()?>css/photostream.css" rel="stylesheet">
<script src="<?=base_url()?>js/blocksit.min.js"></script>
<script src="<?=base_url()?>js/lovesharecomment.js"></script>
	
<script type="text/javascript">

	activateMenu("stream_menu");

	$(document).ready(function() {
		
		var base_url = $('#base_url').val();
		
		//blocksit define
		$(window).load( function() {
			$('#gallery-container').show();
			$('#gallery-container').BlocksIt({
				numOfCol: 3,
				offsetX: 8,
				offsetY: 8
			});
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
	});
		
</script>


<div class="main">
	  <div class="container">

      <div class="row">
      
		<div class="span12">      		
      		
      		<div class="widget stacked ">
      			
      			
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
																	<div class="span1" style="margin: 0;">
																		<i class="icon-heart"></i>
																	</div>
																	<div class="span11" style="margin:0;">
																		<p class="side-work">
																			Followed by 122 people
																		</p>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>							
											</div>
											<div class="wrap-side-nav">
												<div class="side-header">
													<h4 class="side-title">RECENT ACTIVITY</h4>
												</div>
												<div style="clear: both;"></div>
												<div class="side-user-info">
													<div class="row-fluid">
														<div class="span12" style="margin:auto;">
															<div class="span12 side-brdrbtm">
																<div class="row-fluid">
																	<div class="span2" style="margin: 0;">
																		<div class="row-fluid">
																			<img src="http://i.cdn.turner.com/cnn/.element/img/2.0/sect/connect/avatar.gif">
																		</div>
																	</div>
																	<div class="span10" style="margin:0;">
																		<div class="row-fluid">
																			<p class="side-activity">Jeiseun followed iPhone 5.</p>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="row-fluid">
														<div class="span12" style="margin:auto;">
															<div class="span12 side-brdrbtm">
																<div class="row-fluid">
																	<div class="span2" style="margin: 0;">
																		<img src="http://i.cdn.turner.com/cnn/.element/img/2.0/sect/connect/avatar.gif">
																	</div>
																	<div class="span10" style="margin:0;">
																		<p class="side-activity">Jeiseun shared the photo iPhone 5.</p>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="row-fluid">
														<div class="span12" style="margin:auto;">
															<div class="span12">
																<div class="row-fluid">
																	<div class="span2" style="margin: 0;">
																		<img src="http://i.cdn.turner.com/cnn/.element/img/2.0/sect/connect/avatar.gif">
																	</div>
																	<div class="span10" style="margin:0;">
																		<p class="side-activity">Jeiseun loved the photos iPhone 5.</p>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="span8 fbstyle-mid-content" style="margin:-10px 0 0 0;border: none;">
											
										<input type="hidden" id="stream_id" value="<?=$this->uri->segment(3);?>">	
										
										<div id="loading-container" style="width:100%"></div>
										
										<!-- GALLERY STYLE -->
										<div id="gallery-container" style="display:none;width:100%">
								
											<?foreach($album_pics->result() AS $pic):?>
											
												<? $sharecnt = 0; //$commentcnt = 0; ?>
												<? $commentcnt =  $this->piccomments->getcountbyattribute('photo_id',$pic->photo_id); ?>
												<? $lovecnt =  $this->picslikes->getcountbyattribute('photo_id',$pic->photo_id); ?>
												<? $loved =  $this->picslikes->checkexist('photo_id',$pic->photo_id,'userid',$this->session->userdata('userid')); ?>
												
												<div class="gallery-grid">
													<div class="imgholder">
														<img src="<?=$pic->filename?>" />
													</div>
													<div class="meta" style="font-size: 12px;line-height: 15px;margin: 5px 0 0 0;border-bottom: 1px solid #e9e9e9;padding-bottom:3px">
														&quot;<?=str_replace('_',' ',$pic->title)?>&quot;
													</div>
													<div class="row-fluid" style="margin-bottom:-15px;font-size:11px;">
														<div style="padding:0 0 3px 3px;display: inline;float: right;">
															<span><a href="javascript:lovePhoto(<?=$pic->photo_id?>,<?=$this->session->userdata('userid')?>);" class="meta-fbstyle-link"><span id="love<?=$pic->photo_id?>"><?=$lovecnt?></span> <img id="img<?=$pic->photo_id?>" src="<?=base_url()?><?=($loved===TRUE)?'img/loves.png':'img/love.png'?>" title="<?=$lovecnt?> people love this."></a></span>
															<span style="font-size: 12px; font-weight: bold; color: #ccc;"> &#8226; </span>
															<span><a href="javascript:;" class="meta-fbstyle-link"><?=$sharecnt?> <img src="<?=base_url()?>img/share.png" title="<?=$sharecnt?> people shared this."></a></span>
															<span style="font-size: 12px; font-weight: bold; color: #ccc;"> &#8226; </span>
															<span><a href="<?=base_url()?>photo/comment/<?=$pic->photo_id?>" target="_blank" class="meta-fbstyle-link"><?=$commentcnt?> <img src="<?=base_url()?>img/comment.png" title="<?=$commentcnt?> people left a comment."></a></span>
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
						<div class="widget-header">
							<i class="icon-camera"></i>
							<h3>Stream not available</h3>
					
						</div> <!-- /widget-header -->
					
						<div class="widget-content">
							<p>This stream has no content</p>
						</div><!-- widget content -->
				<?endif;?>
				
				
			</div><!-- widget stacked -->
		</div><!-- span12 -->
		
      </div> <!-- /row -->

    </div> <!-- /container -->
  
</div> <!-- /main -->
<?php $this->load->view('backend/footer')?>    
