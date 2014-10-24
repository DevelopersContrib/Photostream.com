<?php
	$this->load->view('backend/header');
?>

<h3>Your file was successfully uploaded!</h3>

<ul>
<?php
 /*$test = 0;
 foreach($upload_data as $file) {
    echo '<li><ul>';
    echo $test++;
    foreach ($file as $item => $value) {
        echo '<li>'.$item.': '.$value.'</li>';
    }
    echo '</ul></li>';
 }*/

echo print_r($upload_data);
echo $upload_data['0']['file'];



echo $upload_data['0']['name']; 
?>

<img src="<? echo base_url();?>/uploads/<? echo $upload_data['0']['name']; ?>" width="80" height="80"/>
</ul>



<p><?php echo anchor('home/upload/'.$segment, 'Upload More Files!'); ?></p>



<?


?>


<?
    $this->load->view('backend/footer');
?>