<?if($profile_streams->num_rows() > 0):?>
		<ul class="gallery-container">
			<?foreach($profile_streams->result() AS $stream):?>
				<?if($stream->cover_pic == NULL){
					$album_cover = 'http://d2qcctj8epnr7y.cloudfront.net/images/2013/avatar-photostream-logo.png';
				}else{
					$album_cover = $this->photopics->getinfobyid('filename',$stream->cover_pic);
				}?>
				<li>
					<a href="/stream/album/<?=$stream->stream_id?>">
									<img src="<?=$album_cover?>" />
					</a>					<p><?=$stream->title?></p>
				</li>
			<?endforeach;?>
		</ul>
<?else:?>
		<p>This user has no streams yet</p>
<?endif;?>