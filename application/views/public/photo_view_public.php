<?php $this->load->view('public/header')?>

<?php $this->load->view('public/navigation')?>

<link href="<?=base_url()?>css/pages/dashboard.css" rel="stylesheet">
<script src="<?=base_url()?>js/lovesharecomment.js"></script>
<script type="text/javascript">
	activateMenu("stream_menu");
	
	$(function(){
		$(document).on("click", "#addcomment", function(){ 
			var photoID = $('#photoID').val();
			var userID = $('#userID').val();
			var comment = $('#comment').val();
			var base_url = $('#base_url').val();
			
			if(comment.replace(/ /g, '')=='') 
				alert('empty');
			else{
				$.post(base_url+'photo/addphotocomment',{photoID:photoID,userID:userID,comment:comment},function(res){
					//alert(res);
					if(res=='ok')
						location.reload();
					else 
						alert('something went wrong!');
				});
			}
		}); 
	});
</script>
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
<style>
.meta-fbstyle-link{text-decoration: none !important;}
</style>
<div class="main">
	<div class="container">
	<!-- AddThis Button BEGIN -->
	
	<!-- AddThis Button END -->

		<div class="row">
      
			<div class="span12">      		
      		
				<div class="widget stacked ">
					<? if($success===TRUE){?>
					<div class="widget-header" >

							<div class="row-fluid">
								<div class="span12">
									<div class="row-fluid">
										<div class="span12" style="padding:3px 10px 0 10px;">
											<div class="row-fluid">
												<div class="wrap-user-title">
													<a href="<?=base_url()?><?=$user_username?>" target="_blank"><img style="float: left;margin: 6px;border-radius: 2px;height:50px;width:50px;"  src="<?=$avatar?>"></a>
													<div style="padding: 3px 0 3px 0;">
														<h3 style="margin: 0;margin-top:2px;display:inherit;line-height: 15px;top:2px;font-size: 18px;"><a href="<?=base_url()?>stream/album/<?=$stream_id?>" style="text-decoration:none;"><?=$stream_title?></a>
														<!-----------------------------addded--------------------------->
														<div class="pull-right"><div style="line-height:20px" class="span2"> <span class="meta-blogstyle-date" style="float:left;font-size: 35px;font-weight: 700;padding: 6px 0 0;width: 100%;color: #959595;"><? echo $viewcount?></span> <span class="meta-blogstyle-year" style="float:left;font-size: 9px;font-weight: 700;letter-spacing: 1.5px;padding-top: 0;text-transform: uppercase;width: 100%;color: #959595;">views</span> </div></div>
														<!-------------------------------------------------------->
														</h3>
														<div style="font-size: 10px;line-height: 20px;margin-left: 73px;"><?=date('M j, Y  g:i a',strtotime($stream_date))?></div>
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
							
							<div class="row-fluid" style="margin-bottom: 20px;">
								<div class="span12">
									<div class="row-fluid">
										<div class="span8">
											<div class="row-fluid">
												<img class="img-polaroid" src="<?=$pic_filename?>" style="width: 98.6%;">
											</div>
											<?
												$pics = $this->photopics->getbyattributelimit('stream_id',$stream_id,3);
												//var_dump($pics);
											?>
											
										</div>
										<div class="span4">
											<div class="row-fluid">
											<div class="span12" style="padding: 3px;">
												<div class="row-fluid">
													<div class="span2">
														<span class="meta-blogstyle-date" style="float:left;font-size: 35px;font-weight: 700;padding: 6px 0 0;width: 100%;color: #959595;"><?=date('j',strtotime($pic_date_uploaded))?></span>
														
														<span class="meta-blogstyle-year" style="float:left;font-size: 9px;font-weight: 700;letter-spacing: 1.5px;padding-top: 0;text-transform: uppercase;width: 100%;color: #959595;"><?=date('MY',strtotime($pic_date_uploaded))?></span>
													</div>
													<div class="span10" style="padding-left: 6px;">														
														<div class="row-fluid" style="margin-bottom: 5px;">
															<div style="padding-left: 3px;">
																&quot; <?=$pic_title?> &quot;
															</div>
														</div>
														<div class="row-fluid">
															<div style="padding:0 0 3px 10px;display: inline;font-size: 11px;">
																<span><a href="#" class="meta-fbstyle-link"><span id="love<?=$pic_id?>"><?=$lovecnt?></span> <img id="img<?=$pic_id?>" src="<?=base_url()?>img/love.png" title="<?=$lovecnt?> people love this."></a></span>
																<span style="font-size: 12px; font-weight: bold; color: #ccc;">  </span>
																<!--<span><a href="javascript:;" class="meta-fbstyle-link"><?//=$sharecnt?> <img src="<?//=base_url()?>img/share.png" title="<?//=$sharecnt?> people shared this."></a></span>-->
																<span style="font-size: 12px; font-weight: bold; color: #ccc;"> </span>
																<span><a href="javascript:;" class="meta-fbstyle-link"><?=$commentcnt?> <img src="<?=base_url()?>img/comment.png" title="<?=$commentcnt?> people left a comment."></a></span>
																
															</div>
														</div>
													</div>
												</div>
												<div class="row-fluid" style="margin-top: 20px;">
													
													<? if($comments->num_rows() > 0){ ?>
														<? foreach($comments->result() AS $data){ ?>
															<div class="row-fluid" style="background-color: #EDEFF4; border-radius: 2px; margin: 5px 0 5px 0;">
																<div class="span12" style="padding: 4px;">
																	<div class="span1">
																		<img src="<?=$this->photopics->getinfo('filename','photo_id', $this->photousers->getinfo('avatar_id','userid',$data->userid));?>">
																	</div>
																	<div class="span11">
																		<span>
																			<a href="<?=base_url()?><?=$this->photousers->getinfo('username','userid',$data->userid)?>" style="color: #3B5998;"><strong><?=ucwords($this->photousers->getinfo('firstname','userid',$data->userid)." ".$this->photousers->getinfo('lastname','userid',$data->userid))?></strong></a>
																			<p style="text-align: left; color: #000; font-size: 12px;"><?=$data->comment?></p>
																		</span>
																		<div class="row-fluid">
																			<span><p style="font-size: 11px;color: #868a97;"><?=date('M j, Y  g:i a',strtotime($data->date_posted))?></p></span>
																		</div>
																	</div>
																</div>
															</div>
														<? } ?>
													<? } ?>
													
													<div class="row-fluid">
													
													
														<div class="span12">
															<!------------------------------------->
															<div class="span11">
																<div class="controls">
																	<a href="<?=base_url()?>login"><button id="addcomment" class="btn btn-primary btn-small">Login or register to comment</button></a>
																</div>
															</div>
															<!------------------------------------->
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
					<? }else{ ?>
					
						<div class="widget-content" style="width:100%"><center><img src="<?=base_url()?>img/404.png"></center></div>
					
					<? } ?>
				</div>
			</div>
		</div>
	</div>
</div>
					

<?php $this->load->view('public/footer')?>  