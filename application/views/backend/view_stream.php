<?php
	$this->load->view('backend/header');
?>

<h1>view stream</h1>


	<?
	if(isset($stream)) : foreach($stream as $row) : ?>
    
	<?
		echo anchor('photos/view_photos/'.$row->stream_id,$row->title);
		echo $row->description;?><?
	
	endforeach;
	
	else: ?>
	
	no stream yet click <a href="<? echo base_url();?>/home/stream"> here </a>
	to create stream
	
	<?
	endif;
	
	?>
	
	
	
	
	






<?php
	$this->load->view('backend/footer');
?>
