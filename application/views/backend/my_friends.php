<? if($current_user_friends->num_rows() > 0):?>
	<ul class="gallery-container">
	<?foreach($current_user_friends->result() AS $friend):?>
		<?	if($friend->friend_id == $this->session->userdata('userid'))
				$connection_id = $friend->userid_id;
			else
				$connection_id = $friend->friend_id;
		?>
			<li id="already_friend_<?=$friend->id?>">
				<a href="<?=base_url()?><?=$this->photousers->getinfobyid('username',$connection_id)?>"><img src="<?=$this->photopics->getinfobyid('filename',$this->photousers->getinfobyid('avatar_id',$connection_id))?>" alt="#" />
				<p><?=$this->photousers->getinfobyid('firstname',$connection_id)." ".$this->photousers->getinfobyid('lastname',$connection_id)?></p></a>
				<a class="btn btn-tertiary" href="javascript:unfriend(<?=$friend->id?>);">Unfriend</a>
			</li>		
	<?endforeach;?>
	</ul>
<? else:?>
	<div class="message-info"><span>Friends list is empty.</span></div>
<? endif;?>