<? foreach($pic_data AS $pic):
			
				
				$commentcnt =  $this->piccomments->getcountbyattribute('photo_id',$pic['photo_id']);
				$lovecnt =  $this->picslikes->getcountbyattribute('photo_id',$pic['photo_id']);
				$loved =  $this->picslikes->checkexist('photo_id',$pic['photo_id'],'userid',$this->session->userdata('userid'));
				$laps = abs((time() - strtotime($pic['date_uploaded'])) / (60 * 60 * 24));
				$sharecnt = $this->picshares->getcountbyattribute('photo_id',$pic['photo_id']); //$commentcnt = 0; 
				
				
				
				if(intval($laps)>0)
					$time = intval($laps).' days ago';
				else if($laps>=0.1)
					$time = intval($laps*10).' hours ago';
				else if($laps>=0.01)
					$time = intval($laps*100).' minutes ago';
				else
					$time = intval($laps*1000).' seconds ago';
					
				$messages = explode(" ",str_replace('_',' ',$pic['title']));
	?>
				<input type="hidden" id="social_<?=$pic['photo_id']?>" value="<?=$messages[0]?>" />
				<input type="hidden" id="titlepic_<?=$pic['photo_id']?>" value="<?=str_replace('_',' ',$pic['title'])?>"/>
				<input type="hidden" id="user_id" value="<?=$this->session->userdata('userid')?>" />
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
											<strong><?=$user_fname?> <?=$user_lname?></strong>
										</a> 
										&mdash; <span class="meta-fbstyle-addphts" style="font-size: 11px">added a photo. </span>
										<span class="meta-fbstyle-hours" style="font-size: 11px"><?=$time?></span>
										<span><p class="meta-fbstyle-desc">&quot;<?=str_replace('_',' ',$pic['title'])?>&quot;</p></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row-fluid">
							<center><img class="img-polaroid fb-content-img" src="<?=$pic['filename']?>" style="max-width:96%;width:auto;height:auto;"></center>
						</div>
						<div class="row-fluid" style="border-bottom: 1px solid #e9e9e9;">
							<div style="padding-left: 3px;">
								<!--<span><a href="javascript:loveTimelinePhoto(<?//=$pic->photo_id?>,<?//=$this->session->userdata('userid')?>);" class="meta-fbstyle-link"><span id="lovetl<?//=$pic->photo_id?>"><img id="img<?//=$pic->photo_id?>" class="like<?//=$pic->photo_id?>" src="<?//=base_url()?><?//=($loved===TRUE)?'img/loves.png':'img/love.png'?>"/> </span></a></span>-->
								<span><span id="lovetl<?=$pic['photo_id']?>"><img id="img<?=$pic['photo_id']?>" class="like" src="<?=base_url()?><?=($loved===TRUE)?'img/loves.png':'img/love.png'?>"/> </span></span>
								<span style="font-size: 12px; font-weight: bold; color: #ccc;"> &#8226; </span>
								<span><a href="#" class="share" id="share_<?=$pic['photo_id']?>" name="<?=base_url()?>photo/comment/<?=url_title($pic['title'])?>/<?=$pic['photo_id']?>"><span id="shares<?=$pic['photo_id']?>"><?=$sharecnt?></span> <img src="<?=base_url()?>img/share.png" title="<?=$sharecnt?> people shared this."></a></span>
								<span style="font-size: 12px; font-weight: bold; color: #ccc;"> &#8226; </span>
								<span><a href="<?=base_url()?>photo/comment/<?=url_title($pic['title'])?>/<?=$pic['photo_id']?>" target="_blank" class="meta-fbstyle-link"><?=$commentcnt?> <img src="<?=base_url()?>img/comment.png" title="<?=$commentcnt?> people left a comment."></a></span>
							</div>
						</div>
						<div class="row-fluid" style="margin-bottom: 5px;">
							<div style="padding-left: 3px;">
								<span class="meta-fbstyle-text">
									<a href="javascript:;" class="meta-fbstyle-link"><span id="labeltl<?=$pic['photo_id']?>"><?=$lovecnt?></span> people</a> love this.
								</span>
							and
								<span class="meta-fbstyle-text">
									<a href="<?=base_url()?>photo/comment/<?=url_title($pic['title'])?>/<?=$pic['photo_id']?>" target="_blank" class="meta-fbstyle-link"><?=$commentcnt ?>people</a> commented on this.
								</span>
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