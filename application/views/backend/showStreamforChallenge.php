<?if($user_streams->num_rows() > 0):?>
	<ul id="ul-gallery-container" class="gallery-container">
	<?foreach($user_streams->result() AS $stream):?>
		<li>
			<a href="javascript:showStreamContent(<?=$stream->stream_id?>)">
			<img src="<?=$this->photopics->getinfobyid('filename',$stream->cover_pic)?>">
			<p><?=$stream->title?></p>
			</a>
		</li>
	<?endforeach;?>
	</ul>
<?else:?>
	<div class="message-warning"><span>You have not created any stream yet.</span></div>
<?endif;?>