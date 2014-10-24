 
 <div id="blog_containers" style="border-left: 1px solid #e9e9e9;margin: 15px 10px; 10px; 10px;">
											
		<? foreach($pic_data AS $pic):
			$sharecnt = $this->picshares->getcountbyattribute('photo_id',$pic['photo_id']);
			$commentcnt =  $this->piccomments->getcountbyattribute('photo_id',$pic['photo_id']);
			$lovecnt =  $this->picslikes->getcountbyattribute('photo_id',$pic['photo_id']);
			$loved =  $this->picslikes->checkexist('photo_id',$pic['photo_id'],'userid',$this->session->userdata('userid'));	
		?>
		<?
			$messages = explode(" ",str_replace('_',' ',$pic['title']));
		
		?>
		<input type="hidden" id="social_<?=$pic['photo_id']?>" value="<?=$messages[0]?>" />
		<input type="hidden" id="titlepic_<?=$pic['photo_id']?>" value="<?=str_replace('_',' ',$pic['title'])?>"/>
		<input type="hidden" id="user_id" value="<?=$this->session->userdata('userid')?>" />
		<input type="hidden" id="stream_id" name="stream_id" value="<?=$stream_id?>" />
						<div class="row-fluid" style="border-bottom: 2px solid #534741;width: 85%;margin:auto; margin-bottom: 30px;padding-bottom: 4px;">
							<div class="span12">
							<div class="row-fluid">
									<div class="span12" style="text-align: center;">
										<img class="img-polaroid" src="<?=$pic['filename']?>">
									</div>
								</div>
								<div class="row-fluid" style="margin-top:5px;border-bottom: 1px solid #ccc;padding-bottom: 3px;">
									<div class="span12">
										<div class="row-fluid">
											<div class="span12">
												<div class="row-fluid">
													<div class="span1" style="margin:0;margin-right: 10px;">
														<span class="meta-blogstyle-date" style="float:left;font-size: 35px;font-weight: 700;padding: 6px 0 0;width: 100%;color: #959595;"><?=date('j',strtotime($pic['date_uploaded']))?>'</span>										
														<span class="meta-blogstyle-year" style="float:left;font-size: 9px;font-weight: 700;letter-spacing: 1.5px;padding-top: 0;text-transform: uppercase;width: 100%;padding-left: 5px;color: #959595;"><?=date('My',strtotime($pic['date_uploaded']))?></span>
													</div>
													<div class="span11" style="margin:0">
													<div class="row-fluid" style="margin-top: 5px;">
															<div style="padding-left: 3px;line-height: 15px;">
																<span class="meta-fbstyle-text">
																	&quot;<?=str_replace('_',' ',$pic['title'])?>&quot;
																</span>
															</div>
														</div>
														<div class="row-fluid" style="">																				
															<div style="padding: 3px 0 0 3px;display: inline-block;">
																<span class="meta-fbstyle-text">
																	<a href="javascript:;" class="meta-fbstyle-link"><span id="labeltl<?=$pic['photo_id']?>"><?=$lovecnt?></span> people</a> love this.
																</span>
																and
																<span class="meta-fbstyle-text">
																	<a href="<?=base_url()?>photo/comment/<?=url_title($pic['title'])?>/<?$pic['photo_id']?>" target="_blank" class="meta-fbstyle-link"><?=$commentcnt?> people</a> commented on this.
																</span>
															</div>
															<div style="padding-left: 3px;display: inline-block;float:right">
							<span><span id="lovetl<?=$pic['photo_id']?>"><img id="img<?=$pic['photo_id']?>" class="like" src="<?=base_url()?><?=($loved===TRUE)?'img/loves.png':'img/love.png'?>"/> </span></span>
																<span style="font-size: 12px; font-weight: bold; color: #ccc;"> &#8226;</span>
							<span><a href="#" class="share" id="share_<?=$pic['photo_id']?>" name="<?=base_url()?>photo/comment/<?=url_title($pic['title'])?>/<?=$pic['photo_id']?>"><span id="shares<?=$pic['photo_id']?>"><?=$sharecnt?></span> <img src="<?=base_url()?>img/share.png" title="<?=$sharecnt?> people shared this."></a></span>
																<span style="font-size: 12px; font-weight: bold; color: #ccc;"> &#8226;</span>
						<span><a href="<?=base_url()?>photo/comment/<?=url_title($pic['title'])?>/<?=$pic['photo_id']?>" class="meta-fbstyle-link"><img src="<?=base_url()?>img/comment.png"></a></span>
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
										
		<? endforeach; ?>
		
		<!-- pagination -->
				<?if($results_cnt > $limit):
					$pages_count = floor($results_cnt/$limit);
					if(($results_cnt % $limit) > 0){
						$pages_count = $pages_count + 1;
					}
					?>
					<div class="pagination pagination-centered">
						<ul>
							<?for($page = 1 ; $page <= $pages_count ; $page++ ){?>
								<li <?echo $page==$curr_page ? 'class="active"':''?> >
									<a class="pages" id="page<?=$page?>"><?=$page?></a>
									<!--<span class="pages" id="page<?//=$page?>"><?//=$page?></span>-->
								</li>
							<?}?>	
						 </ul>
					</div>
				
				<?endif;?>
		<!-- pagination -->
										
</div>

<script src="<?=base_url()?>js/lovesharecomment.js"></script>
<script>
$(document).ready(function() {


	$('.pages').click(function(){
	
		var page = $(this).attr('id').replace('page','');
		var base_url = $('#base_url').val();
		var stream_id = $('#stream_id').val();
		
		$('#blog_containers').html('<center><br><br><br><img src="'+base_url+'img/loading.gif"></center>');
		$.post(base_url+'photo/loadnextpageblog',{page:page,stream_id:stream_id},function(data_html){
				$('#blog_containers').html(data_html);
		});
		
	
	})

	$('.like').click(function(){
	
		var photoID = $(this).attr('id').replace('img','');
		var userID = $('#user_id').val();
		var base_url = $('#base_url').val();
		
		var photo_id = photoID;
		var user_id  = userID;
		
		
		
		if($(this).attr('src') == base_url+'img/loves.png'){
		
			
			$(this).attr('src',base_url+'img/love.png');
			$.post(base_url+'photo/dislikephoto',{photo_id:photo_id,user_id:user_id},function(res){
	
				$('#labeltl'+photoID).text(res);
	
			});
			
		}else{
			
			$(this).attr('src',base_url+'img/loves.png');
			$.post(base_url+'photo/likephoto',{photoID:photoID,userID:userID},function(res){
		
				if(res=='error' || res=='exists'){
					
				}else{
					$('#labeltl'+photoID).text(res);
				}
			});
			
		}
		
	
	
	})


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
			 //alert("test");
			});
	
});
</script>