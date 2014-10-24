<?
$db_server = "localhost";
$db_name = "mychanne_rdb";
$db_sessionname = "";
$db_username = "mychanne_maida";
$db_userpassword = "bing2k";
$dbhandle = mysql_connect($db_server, $db_username, $db_userpassword)
or die("Couldn't connect to SQL Server on $db_server");
$selected = mysql_select_db($db_name, $dbhandle) or die("Couldn't open
database $db_name");
 //for News Letter Subscription DB
$sub_db_server = "localhost";
$sub_db_name = "";
$sub_db_username = "";
$sub_db_userpassword = "";
 //$sitename = "mynewnews.com";//input sitename without
$sitename = $_SERVER["HTTP_HOST"];//input sitename without www
$sitename = str_replace("http://","",$sitename);
$sitename = str_replace("www.","",$sitename);
$admin_username = "admin";
$admin_password = "admin123";
$key = md5($sitename);
$api_url = "http://mychannel.com/api/";
include('library/constants.php');// for news functions
require_once("simplepie/simplepie.inc");
require_once('library/news.php');// for news functions