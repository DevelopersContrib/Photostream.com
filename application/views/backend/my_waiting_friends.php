<? if($current_user_waiting->num_rows() > 0):?>
	<ul class="gallery-container">
	<?foreach($current_user_waiting->result() AS $friend):?>
			<li id="friend_<?=$friend->id?>">
				<a href="<?=base_url()?><?=$this->photousers->getinfobyid('username',$friend->friend_id)?>">
					<img src="<?=$this->photopics->getinfobyid('filename',$this->photousers->getinfobyid('avatar_id',$friend->userid_id))?>" alt="#" />
					<p><?=$this->photousers->getinfobyid('firstname',$friend->userid_id)." ".$this->photousers->getinfobyid('lastname',$friend->userid_id)?>
					
					</p></a>
				
				<a class="btn btn-tertiary" href="javascript:ConfirmAddFriend(<?=$friend->id?>)"><i class="icon-plus-sign"></i>&nbsp;&nbsp;Accept Request</a>
			</li>		
	<?endforeach;?>
	</ul>
<? else:?>
	<div class="message-info"><span>No pending invites.</span></div>
<? endif;?>
