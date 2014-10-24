<?
class Flickrdata extends CI_Model {

	private $api_url = "https://api.flickr.com/services/rest/?";
	private $api_key = "d6c0d7b8d5de76bf23aabaada770a5f2";
	private $format = "json&nojsoncallback=1";
	private $secret= "40816380af087fcf";
	
	function GetUserInfo($method,$frob){
	
		$api_sig = md5($this->secret.'api_key'.$this->api_key.'formatjsonfrob'.$frob.'method'.$method.'nojsoncallback1');
				
		$url = $this->api_url."method=".$method."&api_key=".$this->api_key."&frob=".$frob."&api_sig=".$api_sig."&format=".$this->format;
		$this->curlclient->get($url);
		$result = $this->curlclient->currentResponse('body');
		$res = json_decode($result,true);
		
		return $res;
	}
	
	function GetPhotos($method,$nsid){
	
		$url = $this->api_url."method=".$method."&api_key=".$this->api_key."&user_id=".$nsid."&format=".$this->format;
		$this->curlclient->get($url);
		$result = $this->curlclient->currentResponse('body');
		$res = json_decode($result,true);
	
		return $res;
	}
	
}
?>