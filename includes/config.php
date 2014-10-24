<?php
function createApiCall($url, $method, $headers, $data = array(),$user=null,$pass=null)
{
        if (($method == 'PUT') || ($method=='DELETE'))
        {
            $headers[] = 'X-HTTP-Method-Override: '.$method;
        }

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        if ($user){
         curl_setopt($handle, CURLOPT_USERPWD, $user.':'.$pass);
        } 

        switch($method)
        {
            case 'GET':
                break;
            case 'POST':
                curl_setopt($handle, CURLOPT_POST, true);
                curl_setopt($handle, CURLOPT_POSTFIELDS, http_build_query($data));
                break;
            case 'PUT':
                curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($handle, CURLOPT_POSTFIELDS, http_build_query($data));
                break;
            case 'DELETE':
                curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
        }
        $response = curl_exec($handle);
        return $response;
}




$api_url = "http://api.contrib.com/request/";
$headers = array('Accept: application/json');
$domain = $_SERVER["HTTP_HOST"]."".$_SERVER['REQUEST_URI'];//input sitename without www
$error = 0;

if(stristr($domain,'~') ===FALSE) {
	$domain = $_SERVER["HTTP_HOST"];
    $domain = str_replace("http://","",$domain);
	$domain = str_replace("www.","",$domain);
	$key = md5($domain);
}else {
   $key = md5('vnoc.com');
   $d = explode('~',$domain);
   $user = str_replace('/','',$d[1]);
   
   $url = $api_url.'getdomainbyusername?username='.$user.'&key='.$key;
   $result =  createApiCall($url, 'GET', $headers, array());
   $data_domain = json_decode($result,true);
   $domain =   $data_domain[0]['domain'];
}

$url = $api_url.'getdomaininfo?domain='.$domain.'&key='.$key;
$result = createApiCall($url, 'GET', $headers, array());
$data_domain = json_decode($result,true);

if (!$data_domain['error']){
	$domainid = $data_domain[0]['DomainId'];
	$domainname = $data_domain[0]['DomainName'];
	$memberid = $data_domain[0]['MemberId'];
	$title = $data_domain[0]['Title'];
	$logo = $data_domain[0]['Logo'];
	$description = $data_domain[0]['Description'];
	$account_ga = $data_domain[0]['AccountGA'];
	$description = stripslashes(str_replace('\n','<br>',$description));
		
		
	$url2 = $api_url.'getdomainattributes?domain='.$domain.'&key='.$key;
	$result2 = createApiCall($url2, 'GET', $headers, array());
	$data_domain2 = json_decode($result2,true);
		
	if(!$data_domain2[0]['error']){
		$background_image = $data_domain2[0]['background_image_url'];
		$top_description = $data_domain2[1]['top_description'];
		$top_description = stripslashes(str_replace('\n','<br>',$top_description));
		
		$forsale = $data_domain2[2]['show_for_sale_banner'];
		$forsaletext = $data_domain2[3]['for_sale_text'];
	
		if($forsaletext=='') $forsaletext = 'This domain belongs to the Global Ventures network. We have interesting opportunities for work, sponsors and partnerships.';
		
		
	}else{
		$error++;
	}
			
}else {
	$error++;
}


//get monetize ads from vnoc
$url = $api_url.'getbannercode?d='.$team_domain_name.'&p=footer';
$result = createApiCall($url, 'GET', $headers, array());
$data_ads = json_decode($result,true);
$footer_banner = html_entity_decode(base64_decode($data_ads[0]['code']));


//get number of leads for counter
$url = $api_url.'getdomainleadscount?domain='.$domain.'&key='.$key;
$result = createApiCall($url, 'GET', $headers, array());
$data_follow_count = json_decode($result,true);
if (!$data_follow_count['error']){
	$follow_count = ($data_follow_count[0]['total'] + 1 ) * 25;
}else {
	$follow_count = 1 * 25;
}

//get domain affiliate id
$url = $api_url.'getdomainaffiliateid?domain='.$domain.'&key='.$key;
$result = createApiCall($url, 'GET', $headers, array());
$data_domain_affiliate = json_decode($result,true);
if (!$data_domain_affiliate['error']){
	$domain_affiliate_id = $data_domain_affiliate['affiliate_id'];
}else {
	$domain_affiliate_id = '391'; //contrib.com affiliate id
}
$domain_affiliate_link = 'http://referrals.contrib.com/idevaffiliate.php?id='.$domain_affiliate_id.'&url=http://www.contrib.com/signup/firststep?domain='.$domain;


	
//get Widget Users
$url = $api_url.'getwidget?ma=users&key='.$key;
$result = createApiCall($url, 'GET', $headers, array());
$data_widget_users = json_decode($result,true);

	
//get Widget Jobs
$url = $api_url.'getwidget?ma=jobs&key='.$key;
$result = createApiCall($url, 'GET', $headers, array());
$data_widget_jobs = json_decode($result,true);

//get form option selects
$url = $api_url.'getsignupformdata';
$result = createApiCall($url, 'GET', $headers, array());
$data_signup = json_decode($result,true);
if (!$data_signup['error']){
	$rolesarray = $data_signup['roles'];
	$countriesarray = $data_signup['countries'];
	$industriesarray = $data_signup['industries'];
	$parnershiptypes = array('Sponsorship Marketing Partnerships','Distribution Marketing Partnerships','Affiliate Marketing Partnerships','Added Value Marketing Partnerships');
}	
	

	//	generate robots.txt if not exist
	$filename = '/robots.txt';
	//if(!(file_exists($filename))) {
    $my_file = 'robots.txt';
	$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
	$data = '---BEGIN ROBOTS.TXT ---
User-Agent: *
Disallow:

Sitemap: http://'.$domain.'/sitemap.html
--- END ROBOTS.TXT ----';
	fwrite($handle, $data);
	//}

	
	


/*
$host = "domaindirectory.com";
$user = "domaindi_maida";
$pwd = "bing2k";
$db = "domaindi_sites";

$link = mysql_connect($host, $user,$pwd);
if (!$link) {
   echo "Error establishing connection.";
}

$db_selected = mysql_select_db($db, $link);

*/	
	
	
	
?>