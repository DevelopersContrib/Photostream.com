<?if($latest_streams->num_rows() > 0):?>
	<div id="gallery-container">
	<?foreach($latest_streams->result() AS $stream):?>
		<div class="gallery-grid">
			<div class="imgholder">
				<a href="/stream/album/<?=$stream->stream_id?>">
					<img src="<?=$this->photopics->getinfobyid('filename',$stream->cover_pic)?>"/>
				</a>
				<!--<pre>
					<?
						/*$image_size = $this->photopics->getinfobyid('filename',$stream->cover_pic);
						
						$size = getimagesize($image_size);
						
						print_r($size);*/
						
						echo $size[2];
					
					 ?>
				</pre>-->
				<div>
					<p><a href="/<?=$this->photousers->getinfobyid('username',$stream->userid)?>">
					<div class = "row-fluid">
				<div class = "span12">
					<div class = "row-fluid">
					<div class = "span2">
					<img class="recnt-pic" src="<? echo $this->photopics->getinfobyid('filename',$this->photousers->getinfobyid('avatar_id',$stream->userid)); ?>" style="width:30px;"/>
					</div>
					<div class="span10">
					<div class = "row-fluid">
						<?=$this->photousers->getinfobyid('firstname',$stream->userid)." ".$this->photousers->getinfobyid('lastname',$stream->userid)?>
					</div>
					<div class = "row-fluid">
						<span class="meta-date-challenges"><i class="icon-time"></i> 
						 <?php 
													  $datetime = strtotime($stream->date_created);
	                                                  echo date("M d, Y", $datetime);
													?>
						</span>
					</div>
						</a>
					</p>
					</div>
				</div>
				</div>
				</div>
				</div>
			</div>
		</div>
	<?endforeach;?>
	</div>
<?else:?>
	<div class="message-warning">
		<span>No streams found. Your query resulted <? var_dump($latest_streams);?></span>
	</div>
<?endif;?>