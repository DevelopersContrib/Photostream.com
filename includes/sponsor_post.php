<?php

include "../includes/main_functions_test.php";

$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$contact = $_REQUEST['contact'];
$service = $_REQUEST['service'];
$msg = mysql_real_escape_string($_REQUEST['msg']);
$domain = $_REQUEST['domain'];

$dir = new DIR_LIB();

$save = $dir->SaveServicePage($name,$email,$contact,$service,$msg,$domain);
$servicename = $dir->GetTableInfo('service_type','name','id',$service);

if($save=="success"){
	$admin_emails = '';
	$admin = $dir->GetAdminData();
	for($x =0;$x<count($admin);$x++){
            if($admin_emails!='') $admin_emails .= ',';
            $admin_emails .= $admin[$x]['admin_email'];
	}

	$contactname = $name;
	
	$senderinfo = "Domain Name: ".$domain."\nSender: ".$name."\nContact Number: ".$contact."\nService Interested in: ".$servicename."\n\n";
	
	$contactmsg = $senderinfo."".$msg;
	
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
	//$contactemail = "maidabarrientos@gmail.com"; // for testing (Sept 28)
	$headers2 = "From: ".$contactname."<".$email.">\r\n".'X-Mailer: PHP/' . phpversion();
	$contactmessage = wordwrap($contactmsg);
	$sentmail2 = mail($contactemail,$subject,$contactmessage,$headers2);

	//echo "Thank you for contacting us.  \n\n";
        echo "Service inquiry successfully submitted!  <br><br> Your message has been already been received by our team.
		One of our colleagues will contact you shortly.";
	//echo "Your message has already been received by our team. One of our colleagues will contact you shortly. ";

}else{
	echo $save;
}

?>
