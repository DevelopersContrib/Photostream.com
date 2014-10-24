<?

class Picasa extends CI_Controller{
    
    public function picasa_album(){
        
        $this->load->library('picasa');
        $data['albums'] = $this->picasa->getAlbums();
        
        //$this->load->view('backend/picasa',$data);
        
    }
    
    
    
    
}