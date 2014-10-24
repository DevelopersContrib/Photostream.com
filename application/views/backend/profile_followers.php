<link rel="stylesheet" href="<?=base_url();?>css/photostream-add-style.css" />
<?if($prof_followers->num_rows() > 0):?>
	

	<ul id="friend-ul" class="inline">
	<?foreach($prof_followers->result() AS $follower):?>
		<li>
			<?/*if($following->followed_id == $profile_userid)
					$friend_id = $following->userid_id;
				else
					$friend_id = $following->followed_id;*/
			?>
			<div class="media media2">
				<a class="pull-left" href="<?=base_url()?><?=$this->photousers->getinfobyid('username',$follower->user_id)?>">
					<img class="fimg" src="<?=$this->photopics->getinfobyid('filename',$this->photousers->getinfobyid('avatar_id',$follower->user_id))?>" />
				</a>
				<div class="media-body">
					<p class="friend-name p-friend ellipsis">
						<a href="<?=base_url()?><?=$this->photousers->getinfobyid('username',$follower->user_id)?>">
							<?=$this->photousers->getinfobyid('firstname',$follower->user_id)." ".$this->photousers->getinfobyid('lastname',$follower->user_id)?>
						</a>
					</p>
					<p class="p-friend">
						<a href="" class="muted"> <? echo $this->photofollowers->getcountbyattribute('followed_id', $follower->user_id); ?> followers</a>
					</p>
					<p class="p-friend">
						<span class="label label-info"><i class="icon-ok"></i> follower</span>
					</p>
				</div>
			</div>	
		</li>
	<?endforeach;?>
	</ul>
	
<?else:?>
	<div class="message-info"><span><?=$profile_fullname?> did not follow any one yet.</span></div>
<?endif;?>
