<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

set_include_path(implode(PATH_SEPARATOR, array(realpath(dirname(APPPATH))."/application/libraries/",get_include_path())));
       
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata');
Zend_Loader::loadClass('Zend_Debug');
Zend_Loader::loadClass('Zend_Gdata_Query');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
Zend_Loader::loadClass('Zend_Gdata_Photos');
Zend_Loader::loadClass('Zend_Gdata_Photos_UserQuery');
Zend_Loader::loadClass('Zend_Gdata_Photos_AlbumQuery');
Zend_Loader::loadClass('Zend_Gdata_Photos_PhotoQuery');

class Picasa {  

    var $client;
    var $service;
    var $albumName;
    var $email;
    var $_ci;
    var $status = array('error'=>true,'message'=>'');

    function __construct(){
   
        $this->_ci =& get_instance();
        //Since Picasa doesn't allow you to create sub-albums, as far as I know, I had to prepend
        // the department name to the Picasa album and strip it off when displaying the album as a workaround.  
        // For example, the albums look like so in Picasa: Department - Our Gallery
        // and when displayed "Department - " is stripped off rendering just "Our Gallery".
        $this->albumName = $this->_ci->config->item('picasaAlbumName');  

    }
   
     function auth($mail,$pass){
        //$email = "trialseph@gmail.com";
        //$pass = "school3030";
        /*$ci =& get_instance();
        $ci->config->load('google');
	$config = $ci->config->item('gmail');
        $config2 = $ci->config->item('gpassword');*/
        //var_dump($mail);
        $svc = Zend_Gdata_Photos::AUTH_SERVICE_NAME;
        $this->client = Zend_Gdata_ClientLogin::getHttpClient($mail, $pass, $svc);
        //$this->client = Zend_Gdata_ClientLogin::getHttpClient($email, $pass, $svc);
        $this->service = new Zend_Gdata_Photos($this->client,"ANO");
        
    }
   
    public function getAlbums($mail,$pass){
   
        $this->auth($mail,$pass);
        return $this->getAlbumFeeds();
           
    }
   
    public function getPhotos($albumID,$mail,$pass,$limit=NULL){
   
        $this->auth($mail,$pass);
        return $this->getPhotosFromAlbum($albumID,$limit); 
       
    }
   
    protected function getAlbumFeeds(){

        $albums = array();
       
        try {
            $userFeed = $this->service->getUserFeed("default");

            foreach ($userFeed as $entry) {
           
                $album = $entry->title;
               
                //get the album id
                $p = explode('/',$entry->id);
                $albumID = end($p);

                if (empty($this->albumName) || stristr($album,$this->albumName)){
               
                    //stript the dept. name from the album
                    $a['title'] = str_replace($this->albumName.' - ','',$album);
                    $a['id'] = $albumID;
                    $a['description'] = $entry->summary;
                    $albumInfo = $this->getPhotosFromAlbum($albumID, 1);
                    $a['pics'] = $albumInfo['pics'];
                    $albums[] = $a;
                   
                }
            }
        } catch (Zend_Gdata_App_HttpException $e) {
            echo "Error: " . $e->getMessage() . "<br />\n";
            if ($e->getResponse() != null) {
                echo "Bodys: <br />\n" . $e->getResponse()->getBody() .
                     "<br />\n";
            }

        } catch (Zend_Gdata_App_Exception $e) {
            echo "Error: " . $e->getMessage() . "<br />\n";
        }
       
        return $albums;
       
    }
   
    protected function getPhotosFromAlbum($albumID,$limit=NULL){
   
        $album =array('pics'=>array());
        $query = new Zend_Gdata_Photos_AlbumQuery();

        $query->setUser("default");
        $query->setAlbumID($albumID);
        $entry = $this->service->getAlbumEntry($query);
        if ($limit)
            $query->setMaxResults($limit);
           
       
       
        $album['description'] = $entry->summary;
       
        $albumFeed = $this->service->getAlbumFeed($query);     

        foreach ($albumFeed as $albumEntry) {      
       
            $pic = array();
           
            $pic['title'] = $albumEntry->title->text;
            $pic['description'] = $albumEntry->summary->text;
            $pic['id'] = $albumEntry->getGphotoId()->getText();
            $pic['thumbs'] = array();
            $pic['content'] = array();
           
            if ($albumEntry->getMediaGroup()->getContent() != null) {
              $mediaContentArray = $albumEntry->getMediaGroup()->getContent();
              foreach ($mediaContentArray as $m)
                $pic['content'][] = $m->getURL();

            }
           
            if ($albumEntry->getMediaGroup()->getThumbnail() != null) {
              $mediaThumbnailArray = $albumEntry->getMediaGroup()->getThumbnail();
              foreach ($mediaThumbnailArray as $t)
                $pic['thumbs'][] = $t->getURL();

            }
            $album['pics'][]=$pic;
        }
       
        return $album;

    }
   
    protected function albumExists($album){
   
        try {
            $userFeed = $this->service->getUserFeed("default");

            foreach ($userFeed as $entry) {

                if (stristr($entry->title,$album)){
               
                    return true;
                   
                }
            }
        } catch (Zend_Gdata_App_HttpException $e) {
           
        } catch (Zend_Gdata_App_Exception $e) {
                       
        }
       
        return false;
   
    }
   
    public function createAlbum($album){
   
        $this->auth($mail,$pass);
       
        if ($this->albumExists($album)){
            $this->status['message'] = "Album '$album' already exists.";
            return $r;
        }
       
        $entry = new Zend_Gdata_Photos_AlbumEntry();
        $entry->setTitle($this->service->newTitle($album));
               
        try {
            $this->service->insertAlbumEntry($entry);
            $this->status['error']=false;
           
        } catch (Zend_Gdata_App_HttpException $e) {
            $this->status['message'] =$e->getMessage();
        } catch (Zend_Gdata_App_Exception $e) {
            $this->status['message'] =$e->getMessage();
        }
       
        return $this->status;
       
    }
   
    public function updateAlbumSummary($albumId,$summary){
   
        $this->auth($mail,$pass);
       
        $albumQuery = new Zend_Gdata_Photos_AlbumQuery;
        $albumQuery->setUser("default");
        $albumQuery->setAlbumId($albumId);
        $albumQuery->setType('entry');
       
        try {
            $entry = $this->service->getAlbumEntry($albumQuery);
            $entry->setSummary($this->service->newSummary($summary));
            $entry->save();
            $this->status['error']=false;
        } catch (Zend_Gdata_App_Exception $e) {
            $this->status['message'] =$e->getMessage();
        }
       
        return $this->status;
   
    }
       
    public function deleteAlbum($albumID){
   
        $this->auth($mail,$pass);
       
        $albumQuery = new Zend_Gdata_Photos_AlbumQuery;
        $albumQuery->setUser("default");
        $albumQuery->setAlbumId($albumID);
        $albumQuery->setType('entry');
 
        $entry = $this->service->getAlbumEntry($albumQuery);       
       
        try {
            $this->service->deleteAlbumEntry($entry, true);
            $this->status['error']=false;
        } catch (Zend_Gdata_App_HttpException $e) {
            $this->status['message'] =$e->getMessage();
        } catch (Zend_Gdata_App_Exception $e) {
            $this->status['message'] =$e->getMessage();
        }
       
        return $this->status;
       
    }
   
    public function rename_album($albumID,$newAlbumName){
   
        $this->auth($mail,$pass);
   
        $query = new Zend_Gdata_Photos_AlbumQuery();
        $query->setUser("default");
        $query->setAlbumId($albumID);
        $query->setType("entry");
         
        try {
            $albumEntry = $this->service->getAlbumEntry($query);
            $this->status['error']=false;
            $albumEntry->setTitle($this->service->newTitle($newAlbumName));
            $albumEntry->save();
        } catch (Zend_Gdata_App_Exception $e) {
            $this->status['message'] =$e->getMessage();
        }
   
        return $this->status;
   
    }
   
    public function upload($albumID,$pic){

        $this->auth($mail,$pass);
       
        $fd = $this->service->newMediaFileSource($pic["tmp_name"]);
        $fd->setContentType($pic["type"]);
       
        $entry = new Zend_Gdata_Photos_PhotoEntry();
        $entry->setMediaSource($fd);
        $entry->setTitle($this->service->newTitle($pic["name"]));
       
        $albumQuery = new Zend_Gdata_Photos_AlbumQuery;
        $albumQuery->setUser("default");
        $albumQuery->setAlbumId($albumID);
 
        $albumEntry = $this->service->getAlbumEntry($albumQuery);
        try {
            $this->service->insertPhotoEntry($entry, $albumEntry);
            $this->status['error']=false;
        } catch (Zend_Gdata_App_Exception $e) {
            $this->status['message'] =$e->getMessage();
        }
   
        return $this->status;
   
    }
   
   
    public function updateSummary($albumId,$picId,$summary){
   
        $this->auth($mail,$pass);
       
        $gphoto = new Zend_Gdata_Photos($this->client);
        $query = new Zend_Gdata_Photos_PhotoQuery();
        $query->setUser("default");
        $query->setAlbumId($albumId);
        $query->setPhotoId($picId);
        $query->setType("entry");
       
        try {
            $photoEntry = $this->service->getPhotoEntry($query);
            $photoEntry->setSummary($gphoto->newSummary($summary));
            $photoEntry->save();
            $this->status['error']=false;
        } catch (Zend_Gdata_App_Exception $e) {
            $this->status['message'] =$e->getMessage();
        }
       
        return $this->status;
   
    }
   
    public function deletePic($albumId,$picId){
   
        $this->auth($mail,$pass);
               
        $photoQuery = new Zend_Gdata_Photos_PhotoQuery;
        $photoQuery->setUser("default");
        $photoQuery->setAlbumId($albumId);
        $photoQuery->setPhotoId($picId);
        $photoQuery->setType('entry');
       
        try {
            $entry = $this->service->getPhotoEntry($photoQuery);     
            $this->service->deletePhotoEntry($entry, true);
            $this->status['error'] = false;
           
        } catch (Zend_Gdata_App_Exception $e) {
            $this->status['message'] =$e->getMessage();
        }
       
        return $this->status;
    }

}