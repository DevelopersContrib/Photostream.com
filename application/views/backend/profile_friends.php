<link rel="stylesheet" href="<?=base_url();?>css/photostream-add-style.css" />
<?if($profile_all_friends->num_rows() > 0):?>
	

	<ul id="friend-ul" class="inline">
	<?foreach($profile_all_friends->result() AS $userfriend):?>
		<li>
			<?if($userfriend->friend_id == $profile_userid)
					$friend_id = $userfriend->userid_id;
				else
					$friend_id = $userfriend->friend_id;
			?>
			<div class="media media2">
				<a class="pull-left" href="<?=base_url()?><?=$this->photousers->getinfobyid('username',$friend_id)?>">
					<img class="fimg" src="<?=$this->photopics->getinfobyid('filename',$this->photousers->getinfobyid('avatar_id',$friend_id))?>" />
				</a>
				<div class="media-body">
					<p class="friend-name p-friend ellipsis">
						<a href="<?=base_url()?><?=$this->photousers->getinfobyid('username',$friend_id)?>">
							<?=$this->photousers->getinfobyid('firstname',$friend_id)." ".$this->photousers->getinfobyid('lastname',$friend_id)?>
						</a>
					</p>
					<p class="p-friend">
						<a href="" class="muted"> <? echo $this->photofollowers->getcountbyattribute('followed_id', $friend_id); ?> followers</a>
					</p>
					<p class="p-friend">
						<span class="label label-info"><i class="icon-ok"></i> Friends</span>
					</p>
				</div>
			</div>	
		</li>
	<?endforeach;?>
	</ul>
	
<?else:?>
	<div class="message-info"><span><?=$profile_fullname?> has not added friends yet.</span></div>
<?endif;?>