<?if($profile_all_friends->num_rows() > 0):?>
	<ul class="gallery-container">
	<?foreach($profile_all_friends->result() AS $userfriend):?>
		<li>
			
			<?if($userfriend->friend_id == $profile_userid)
					$friend_id = $userfriend->userid_id;
				else
					$friend_id = $userfriend->friend_id;
			?>
			<a href="/<?=$this->photousers->getinfobyid('username',$friend_id)?>">
				<img src="<?=$this->photopics->getinfobyid('filename',$this->photousers->getinfobyid('avatar_id',$friend_id))?>" />
				<p><?=$this->photousers->getinfobyid('firstname',$friend_id)." ".$this->photousers->getinfobyid('lastname',$friend_id)?></p>
			</a>
		</li>
	<?endforeach;?>
	</ul>
<?else:?>
	<p class="generalNotif"><?=$profile_fullname?> has not added friends yet.</p>
<?endif;?>