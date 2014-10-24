<ul class="news-items" >
					
		<?foreach($latest_users->result() AS $user):?>
			<? 	$my_avatar = $this->photopics->getinfobyid('filename',$user->avatar_id);?>
			<li>
							<div class="news-item-detail">										
								<a href="<?=base_url()?><?=$user->username?>" class="news-item-title"><?=$user->firstname." ".$user->lastname?></a>
								<p class="news-item-preview">Member Since <?=date("M d, Y g:i A", strtotime($user->date_signedup))?> &nbsp <span>Follower (<?=$this->photofollowers->getcountbyattribute('followed_id', $user->userid)?>)</span><span>|</span><span>Following (<?=$this->photofollowers->getcountbyattribute('user_id',$user->userid)?>)</span></p>
							</div>
							&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
							<div class="news-item-date">
								<a href="<?=base_url()?><?=$user->username?>"><img style="width:50px;height:50px" src="<?=$my_avatar?>"></img></a>
							</div>
						</li>
		<?endforeach;?>
</ul>