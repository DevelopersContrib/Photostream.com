<?php
	$this->load->view('backend/header');
?>

<h1>Upload pictures</h1>

<? if($stream == 0):?>
<form method="post" action="<? echo base_url();?>index.php/home/input_stream">
    title: <input type="text" name="title" id="title"><br>
    description: <textarea name="description" id="description" rows="5" cols="5">
    </textarea><br>
    visibility: <select id="visibility" name="visibility">
                    <option value="0">private</option>
                    <option value="1">public</option>
                    </select>
    <button class="btn btn-danger" type="submit">Create</button>
</form>

<? else: ?>

<h1> select stream to upload </h1>

 <? if(isset($stream2)) : foreach($stream2 as $row) : ?>
    
	<? echo anchor('home/photos/'.$row->stream_id,$row->title);
		echo $row->description."<br>";
		?>
	
	<? endforeach;
	
	else: ?>
	
	<?
	endif;
	
	?>

<? endif; ?>





<?php
	$this->load->view('backend/footer');
?>



