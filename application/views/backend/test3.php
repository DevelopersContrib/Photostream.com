<?php/*for($x=0; $x<=5; $x++){$result[$x]["id"] = "id".$x;}*/$x = 0;foreach($updates->result() as $update){	$result[$x]["id"] = $x;	$result[$x]["message"] = $update->message;	$x++;}echo json_encode($result);?> 