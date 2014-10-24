<?if($profile_challenges->num_rows() > 0):?>
	<div class="span6">
		<ul id="ul-challenges" class="unstyled">
			<?foreach($profile_challenges->result() AS $challenge):?>
			<li>
				<p><strong><a href="<?=base_url()?>challenges/info/<?=$challenge->challenge_id?>"><?=$challenge->title?></a></strong></p>
				<p><?=$challenge->description?></p>
			</li>
			<?endforeach;?>
		</ul>
	</div>
<?else:?>
	<p class="generalNotif"><?=$profile_fullname?> has no photo challenge post.</p>
<?endif;?>