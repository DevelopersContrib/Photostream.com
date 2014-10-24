<?if($user_challenges->num_rows() > 0):?>
	<?foreach($user_challenges->result() as $mychall):?>
		<label>Challenge: <strong><?=$mychall->title?></strong></label>
	<?endforeach;?>
<?else:?>
	<p>There are no closed challenges.</p>
<?endif;?>