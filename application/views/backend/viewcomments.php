<? if($comments->num_rows() > 0){ ?>
	<? foreach($comments->result() AS $data){ ?>
		<div class="row-fluid" id="comment_<?=$data->comment_id?>" style="background-color: #EDEFF4; border-radius: 2px; margin: 5px 0 5px 0;">
			<div class="span12" style="padding: 4px;">
				<div class="span1">
					<img src="<?=$this->photopics->getinfo('filename','photo_id', $this->photousers->getinfo('avatar_id','userid',$data->userid));?>">
				</div>
				<div class="span11">
				<? if($userid == $data->userid):?>
					<div class="pull-right">
						<div class="dropdown">
							<a href="#" data-toggle="dropdown" role="button" id="drop4" class="dropdown-toggle"> <i class="icon-pencil"></i></a>
							<ul aria-labelledby="drop4" role="menu" class="dropdown-menu drop-menu-2" id="menu1">
							  <li role="presentation"><a href="javascript:;" tabindex="-1" role="menuitem" class="edit" id="edit_<?=$data->comment_id?>">Edit...</a></li>
							  <li role="presentation"><a href="javascript:;" tabindex="-1" role="menuitem" class="delete" id="delete_<?=$data->comment_id?>">Delete...</a></li>
							</ul>
						 </div>
					</div>
				<?endif;?>
					<span>
						<a href="<?=base_url()?><?=$this->photousers->getinfo('username','userid',$data->userid)?>" style="color: #3B5998;"><strong><?=ucwords($this->photousers->getinfo('firstname','userid',$data->userid)." ".$this->photousers->getinfo('lastname','userid',$data->userid))?></strong></a>
						<p style="text-align: left; color: #000; font-size: 12px;"><?=$data->comment?></p>
					</span>
					<div class="row-fluid">
						<span><p style="font-size: 11px;color: #868a97;"><?=date('M j, Y  g:i a',strtotime($data->date_posted))?></p></span>
					</div>
				</div>
			</div>
		</div>
	<? } ?>
<? } ?>
<input type="hidden" id="photoID" value="<?=$photoID?>">
<script>


$(function(){
      
		$('.edit').click(function(){
		
			var str = $(this).attr('id');
			var id = str.replace('edit_',"");
			var photoID = $('#photoID').val();
			var base_url = $('#base_url').val();
			
			$.post(base_url+'photo/editcomment',{id:id,photoID:photoID},function(data){
				
				$('#comment_'+id).html(data);
			
			});
		
		});
		
		$('.editcom').click(function(){
		
			
		
		});
		
		$('.cancelcom').click(function(){
			
			var base_url = $('#base_url').val();
			var photoID = $('#photoID').val();
			$.post(base_url+'photo/viewcomments',{photoID:photoID},function(data){
							
				$('#comments').html(data);
				
			
			});
		
		
		});
		$('.delete').click(function(){
		
			var base_url = $('#base_url').val();
			var str = $(this).attr('id');
			var id = str.replace('delete_',"");
			
			$.post(base_url+'photo/deletecomment',{id:id},function(data){
				
				$('#comment_'+id).hide();
			
			});
		
		
		});
	});

</script>