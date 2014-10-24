<ul class="gallery-container">
	<li>
		<img src="<?=$profile_picture?>" alt="#" />
		
	</li>		
</ul>
<center>
<?if($isSelf == 1):?>
	<a class="btn btn-tertiary" href="<?=base_url()?>account">Edit Account</a>
<?else:?>
	<div id="friendship">
		<?if($isFriends == 0):?>
			
				<input type="hidden" name="to_add_userid" id="to_add_userid" value="<?=$profile_userid?>" />
				<a class="btn btn-primary" href="javascript:addfriend();">Add to friends list</a>
			
		<?endif;?>
		<?if($isFriends == 2):?>
			<div class="message-info"><span>Waiting for confirmation</span></div>
		<?endif;?>
	</div>
<?endif;?>
</center>
<h3 class="text-center"><?=$profile_fullname?></h3>
<p class="text-center">Member Since <?=$member_since?></p>
<p class="text-center muted">
	<span id="followers">Follower (<?=$follower_count?>)</span> 
	<span>|</span> 
	<span>Following (<?=$followed_count?>)</span>
</p>
<!--<input type="text" name="profuserid" id="profuserid" value="<?//$profile_id?>" />-->
<?if($isSelf == 1):?>

<?else: ?>
<? if($following == false): ?>
<div id="b_follow">
<p class="text-center"> <a href="javascript:follow(<?=$profileid?>)" class="btn btn-danger"> <i class="icon-camera"></i> Follow</a> </p>
</div>
<? else: ?>
<div id="b_follow">
<p class="text-center"> <a href="#" class="btn btn-danger"> <i class="icon-camera"></i> Following</a> </p>
</div>
<? endif; ?>
<? endif; ?>