<?php $this->load->view('backend/header')?>
<?php $this->load->view('backend/navigation')?>
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
			var slug = $('#slug').val();
			var owner_id = $('#owner_id').val();
			
			if(comment.replace(/ /g, '')=='') 
				alert('empty');
			else{
				$.post(base_url+'photo/addphotocomment',{photoID:photoID,userID:userID,comment:comment,slug:slug,owner_id:owner_id},function(res){
				
					$("#comment_control").html("posting comment..");
					//alert(res);
					if(res=='ok')
						$.post(base_url+'photo/viewcomments',{photoID:photoID},function(data){
							
							$('#comments').html(data);
							$("#comment_control").html("<button class='btn btn-primary btn-small' id='addcomment'>Submit</button>");
							
						
						})
					else 
						alert('something went wrong!');
				});
			}
		}); 
	});
</script>

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
<style>
.meta-fbstyle-link{text-decoration: none !important;}
.drop-menu-2{
	left: -149px !important;
	min-width:auto !important;
}
#comments{
	overflow-y:auto;
	max-height:500px;
}
.wrap-comments{
        background-color: #fff;
        border: 1px solid #CCCCCC;
        height: 300px;
}
</style>
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
														<h3 style="margin: 0;margin-top:2px;display:inherit;line-height: 15px;top:2px;font-size: 18px;"><a href="<?=base_url()?>stream/album/<?=url_title($stream_title)?>/<?=$stream_id?>" style="text-decoration:none;"><?=$stream_title?></a>
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
					<?
						 $messages = explode(" ",str_replace('_',' ',$pic_title));
					?>
							<input type="hidden" id="social_<?=$pic_id?>" value="<?=$messages[0]?>" />
							<input type="hidden" id="titlepic_<?=$pic_id?>" value="<?=str_replace('_',' ',$pic_title)?>"/>
							<input type="hidden" id="user_id" value="<?=$this->session->userdata('userid')?>" />
							
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
											<? if($pics->num_rows() > 0): ?>
											<div class="row-fluid" style="margin-top:20px;">
												<link rel="stylesheet" href="<?=base_url();?>css/photostream-add-style.css" />
												<p class="ttle-p-solo">See also <b><? echo $this->photostream->getinfobyid('title',$stream_id) ?></b> other images :</p>
												<ul id="prev-img-ul" class="inline">
													<? foreach($pics->result() as $pic_preview): ?>
													<li>
														<a href="<?=base_url()?>photo/comment/<?=url_title($pic_preview->title)?>/<?=$pic_preview->photo_id?>">
															<img class="img-polaroid" src="<?=$pic_preview->filename?>" />
														</a>
													</li>
													<? endforeach; ?>
												</ul>
											</div>
											<? endif; ?>
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
																<span><a href="javascript:lovePhoto(<?=$pic_id?>,<?=$this->session->userdata('userid')?>);" class="meta-fbstyle-link"><span id="love<?=$pic_id?>"><?=$lovecnt?></span> <img id="img<?=$pic_id?>" src="<?=base_url()?><?=($loved===TRUE)?'img/loves.png':'img/love.png'?>" title="<?=$lovecnt?> people love this."></a></span>
																<span style="font-size: 12px; font-weight: bold; color: #ccc;"> &#8226; </span>
																<span><a href="#" class="share" id="share_<?=$pic_id?>" name="<?=base_url()?>photo/comment/<?=url_title($pic_title)?>/<?=$pic_id?>"><span id="shares<?=$pic_id?>"><?=$sharecnt?></span> <img src="<?=base_url()?>img/share.png" title="<?=$sharecnt?> people shared this."></a></span>
																<span style="font-size: 12px; font-weight: bold; color: #ccc;"> &#8226; </span>
																<span><a href="javascript:;" class="meta-fbstyle-link"><?=$commentcnt?> <img src="<?=base_url()?>img/comment.png" title="<?=$commentcnt?> people left a comment."></a></span>
																
															</div>
														</div>
													</div>
												</div>
												<div class="row-fluid" style="margin-top: 20px;">
											<div class="wrap-comments">
												<div id="comments">
													<? if($comments->num_rows() > 0){ ?>
														<? foreach($comments->result() AS $data){ ?>
															<div id="comment_<?=$data->comment_id?>" class="row-fluid" style="background-color: #EDEFF4; border-radius: 2px; margin: 5px 0 5px 0;">
																<div class="span12" style="padding: 4px;">
																	<div class="span1">
																		<img src="<?=$this->photopics->getinfo('filename','photo_id', $this->photousers->getinfo('avatar_id','userid',$data->userid));?>">
																	</div>
																	<div class="span11">
																<? if($userid == $data->userid):?>
																	<div class="pull-right">
																		<div class="dropdown">
																			<a href="#" data-toggle="dropdown" role="button" id="drop4" class="dropdown-toggle"> <i class="icon-pencil"></i></a>
																			<ul aria-labelledby="drop4" role="menu" class="dropdown-menu drop-menu-2" id="menu1">
																			  <li role="presentation"><a href="javascript:;" tabindex="-1" role="menuitem" class="edit" id="edit_<?=$data->comment_id?>">Edit...</a></li>
																			  <li role="presentation"><a href="javascript:;" tabindex="-1" role="menuitem" class="delete" id="delete_<?=$data->comment_id?>">Delete...</a></li>
																			</ul>
																		 </div>
																	</div>
																	<?endif;?>
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
												</div>
											</div>
													<div class="row-fluid">
													
													
													
													
													<!--<div id="disqus_thread"></div>
													    <script type="text/javascript">
													        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
													        var disqus_shortname = 'photostreamcom'; // required: replace example with your forum shortname
													
													        /* * * DON'T EDIT BELOW THIS LINE * * */
													        (function() {
													            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
													            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
													            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
													        })();
													    </script>
													    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript"></a></noscript>
													    <a href="http://disqus.com" class="dsq-brlink"> <span class="logo-disqus"></span></a>-->
													    
													
													
													
													
														<div class="span12">
															<div class="span1" style="margin: 2px 0 2px 0;">
																<img src="<?=$user_avatar?>">
															</div>
															<div class="span11">
																
																	<div class="controls">
																		<textarea id="comment" class="input-block-level" rows="2" placeholder="Write a comment..." style="font-size: 11px;"></textarea>
																	</div>
																	<div class="controls" id="comment_control">
																		<button class="btn btn-primary btn-small" id="addcomment">Submit</button>
																	</div>
																	<input type="hidden" id="photoID" value="<?=$pic_id?>">
																	<input type="hidden" id="userID" value="<?=$this->session->userdata('userid')?>">
																	<input type="hidden" id="slug" value="<?=$slug?>">
																	<input type="hidden" id="owner_id" value="<?=$owner_id?>">
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
							
					</div>
					<? }else{ ?>
					
						<div class="widget-content" style="width:100%"><center><img src="<?=base_url()?>img/404.png"></center></div>
					
					<? } ?>
				</div>
			</div>
		</div>
	</div>
</div>
					

<?php $this->load->view('backend/footer')?>
<script type="text/javascript" src="<?=base_url();?>js/jquery-slimscroll.js"></script>
<script>
$(document).ready(function() {
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
			});
	$(function(){
        $('#comments').slimScroll({
            height: 'auto'
        });
		
		$('.edit').click(function(){
		
			var str = $(this).attr('id');
			var id = str.replace('edit_',"");
			var base_url = $('#base_url').val();
			var photoID = $('#photoID').val();
			
			$.post(base_url+'photo/editcomment',{id:id,photoID:photoID},function(data){
				
				$('#comment_'+id).html(data);
			
			});
			
		
		});
		$('.delete').click(function(){
		
			var base_url = $('#base_url').val();
			var str = $(this).attr('id');
			var id = str.replace('delete_',"");
			
			$.post(base_url+'photo/deletecomment',{id:id},function(data){
				
				$('#comment_'+id).hide();
			
			});
		
		
		});
		
		
    });
	
});
</script>