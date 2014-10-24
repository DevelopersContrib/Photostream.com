<?php

include "../includes/main_functions_test.php";

$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$contact = $_REQUEST['contact'];
$service = $_REQUEST['service'];
$msg = mysql_real_escape_string($_REQUEST['msg']);
$domain = $_REQUEST['domain'];

$dir = new DIR_LIB();

$service_name = $dir->GetTableInfo('service_type','name','id',$service);
$save = $dir->SaveServicePage($name,$email,$contact,$service,$msg,$domain);

if($save=="success"){
	$admin_emails = '';
	$bcc_emails = '';
	$admin = $dir->GetAdminData();
	for($x =0;$x<count($admin);$x++){
            if($admin_emails!='') 
             $admin_emails .= ',';
             $bcc_emails .= ',';
            if ($admin[$x]['send_email']==1){
              $admin_emails .= $admin[$x]['admin_email'];
            }else if ($admin[$x]['send_email']==2){
              $bcc_emails .= $admin[$x]['admin_email'];
            }
	}

	$contactname = $name;
	$contactmsg = "";
	if ($domain != ""){
	  $contactmsg  .= "Domain: ".strtolower($domain)."\n"; 
	  $contactmsg  .= "Name: ".$name."\n";
	  $contactmsg  .= "Email: ".$email."\n";
	  $contactmsg  .= "Contact number: ".$contact."\n";
	  $contactmsg  .= "Interested in: ".$service_name."\n";
	}
      $contactmsg .= $msg;

	$to=$email;
	$subject = "Domain Directory Service Inquiry Form Submission";
	$headers = "From: DomainDirectory.com <$admin_emails>\r\n".'X-Mailer: PHP/' . phpversion();
	$messages= "Hello ".$contactname.",\n\n ";
	$messages.="Thank you for contacting us.  \n\n";
	$messages.="Your message has already been received by our team. One of our colleagues will contact you shortly. \r\n";
	$messages.="\n\n DomainDirectory.com Team";
	$emailmessage = wordwrap($messages);
	/*first send to guest */
	$sentmail = mail($to,$subject,$emailmessage,$headers);
	/*then send message to contact@domainholdings.com*/
	$contactemail = "$admin_emails";
	//$contactemail = "jogacer679@gmail.com";
	$headers2 = "From: ".$contactname."<".$email.">\r\n".'X-Mailer: PHP/' . phpversion(). "\r\n";
	$headers2 .= 'Bcc: ' .$bcc_emails.  "\r\n";
	$contactmessage = wordwrap($contactmsg);
	$sentmail2 = mail($contactemail,$subject,$contactmessage,$headers2);

	//echo "Thank you for contacting us.  \n\n";
    echo "Service inquiry successfully submitted! ";
	echo "Your message has already been received by our team. One of our colleagues will contact you shortly. ";

}else{
	echo $save;
}

?>
