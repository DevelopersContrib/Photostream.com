<?

$page = $_SERVER['PHP_SELF'];

if (strpos($page, 'terms') !== false){    

	$meta = 'Terms of Use - '.ucwords($domain);	

}else if (strpos($page, 'policy') !== false){    

	$meta = 'Privacy Policy - '.ucwords($domain);	

}else{	

	$meta = $title;

} 

if(str_replace(' ','',$top_description)!=''){	

	$meta_desc = $top_description;	

}else if($description!=''){	

	$meta_desc = $description;	

}else{	

	$meta_desc = 'Learn more about Joining our Partner Network.';	

} ?>