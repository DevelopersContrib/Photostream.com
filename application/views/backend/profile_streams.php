<?if($profile_streams->num_rows() > 0):?>
		<link rel="stylesheet" href="<?=base_url();?>css/photostream-add-style.css" />
		<ul class="inline">
		<?foreach($profile_streams->result() AS $stream):?>
		<?if($stream->cover_pic == NULL){
			$album_cover = 'http://d2qcctj8epnr7y.cloudfront.net/images/2013/avatar-photostream-logo.png';
		}else{
			$album_cover = $this->photopics->getinfobyid('filename',$stream->cover_pic);
		}?>
			<li>
				<div class='albumDetails'>
					<a href="/stream/album/<?=url_title($stream->title)?>/<?=$stream->stream_id?>"><div class="fbAlbum">
						<!-- the first image is the album cover photo -->
						<img class="active" src="<?=$album_cover?>" />
						<? $album_pics = $this->photopics->getbyattribute('stream_id',$stream->stream_id); ?>
						<?foreach($album_pics->result() AS $pic):?>
						<img src="<?=$pic->filename?>" />
						<? endforeach; ?>
					</div></a>
					<div class='albumTitle ellipsis'><a href="/stream/album/<?=url_title($stream->title)?>/<?=$stream->stream_id?>"><?=$stream->title?></a></div>
					<div class='photosNum'><?=$album_pics->num_rows()?> photos
					<? if($isSelf == 1): ?>
					<? if($stream->is_public == '1'): ?> 
					
						<a class="icon-globe pull-right span-size" rel="tooltip" data-original-title="album <?=$stream->title?> is public"></a>
					<? else: ?>
						<a class="icon-lock pull-right span-size" rel="tooltip" data-original-title="album <?=$stream->title?> is private"></a>
					<? endif; ?>
					</div>
					<? endif; ?>
					
				</div>
			</li>
		<?endforeach;?>
<script type='text/javascript'>
/*FbAlbumPreview jQuery Plugin by Mike Dalisay - http://codeofaninja.com/ */
(function(a){a.fn.FbAlbumPreview=function(b){var c=a.extend({viewSpeed:1e3,fadeSpeed:500},b);return this.each(function(){var b;var d=c.fadeSpeed;var e=false;a(this).hover(function(){var f=a(this);b=setInterval(function(){f.find("IMG").show();var a=f.find("IMG.active");if(a.length==0){a=f.find("IMG:last")}var b=a.next().length?a.next():f.find("IMG:first");a.addClass("last-active");b.css({opacity:0}).addClass("active").animate({opacity:1},d,function(){a.removeClass("active last-active");e=true})},c.viewSpeed)},function(){clearInterval(b);if(e==true){var c=a(this);c.find("img").hide();c.find("IMG.active").removeClass("active");var f=c.find("IMG:first").fadeOut(d).fadeIn(d).addClass("active");e=false}})})}})(jQuery)
</script>
<script type='text/javascript'>
$(document).ready(function(){
	// since all albums images container are under the class 'fbAlbum',
	// that's what we are gonna user as the selector
	$('.fbAlbum').FbAlbumPreview();
	$('[rel=tooltip]').tooltip({'placement': 'top'});
});
</script>
		</ul>
<?else:?>
		<p>This user has no streams yet</p>
<?endif;?>