<a href="javascript:showstreamsagain();">Back to streams</a>
<?if($stream_images->num_rows() > 0):?>
	<ul id="ul-gallery-container" class="gallery-container">
		<?foreach($stream_images->result() AS $image):?>
			<li id="selectThisImage">
				<a href="javascript:selectThisImage(<?=$image->photo_id?>);">
					<img src="<?=$image->filename?>">
				</a>
			</li>
		<?endforeach;?>
	</ul>
<?else:?>
	<div class="message-warning"><span>This stream has no content.</span></div>
<?endif;?>