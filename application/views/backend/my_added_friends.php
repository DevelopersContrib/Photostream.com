<? if($current_user_invited->num_rows() > 0):?>
	<ul class="gallery-container">
	<?foreach($current_user_invited->result() AS $friend):?>
			<li id="added_<?=$friend->id?>">
				<a href="<?=base_url()?><?=$this->photousers->getinfobyid('username',$friend->friend_id)?>">
					<img src="<?=$this->photopics->getinfobyid('filename',$this->photousers->getinfobyid('avatar_id',$friend->friend_id))?>" alt="#" />
					<p><?=$this->photousers->getinfobyid('firstname',$friend->friend_id)." ".$this->photousers->getinfobyid('lastname',$friend->friend_id)?></p>
				</a>
				<a class="btn btn-tertiary" href="javascript:CancelRequest(<?=$friend->id?>);">Cancel Friend Request</a>
			</li>		
	<?endforeach;?>
	</ul>
<? else:?>
	<div class="message-info"><span>Invited Friends list is empty.</span></div>
<? endif;?>