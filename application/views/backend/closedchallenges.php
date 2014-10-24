<?if($challenges_closed->num_rows() > 0):?>
	<?foreach($challenges_closed->result() as $closedchall):?>
		<label>Challenge: <strong><?=$closedchall->title?></strong></label>
	<?endforeach;?>
<?else:?>
	<p>There are no closed challenges.</p>
<?endif;?>