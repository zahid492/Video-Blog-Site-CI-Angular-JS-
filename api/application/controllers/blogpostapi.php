<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class BlogpostApi extends REST_Controller{

    function __construct() {
                parent::__construct();
                $this->load->helper('my_api');
    }    


  

  function blogpost_get(){
        $id=$this->uri->segment(3);
    	if(isset($id)){
    	$this->load->model('Model_blogposts');
    	$blogpost = $this->Model_blogposts->infogetone($id)->get_all();
        
    	 if(isset($blogpost)){
          $this->response(array('status' =>'success','message'=>$blogpost ));

    	}else{
    		$this->response(array('status' =>'failur','message'=>'No data found' ));

    	}    	
    }
    	else
        {
        $blogpost_count = $this->Model_blogposts->infogetcount($id)->get_all();
        $this->load->model('Model_blogposts'); 	
       
        //$params =null;
        $params = array();

    	$blogpost = $this->Model_blogposts->infogetall()->get_all();
        $this->response(array('status' =>'success','count'=>$blogpost_count,'message'=>$blogpost)); 


        }

    }

function blogpost_put() {

    $this->load->library('form_validation');
    $data = remove_unknown_fields($this->put(), $this->form_validation->get_field_names('blogpost_put'));
    $this->form_validation->set_data($data);
    $this->load->model('Model_blogposts');
    if ($this->form_validation->run('blogpost_put') !=false) {
    
        $url=$data['message_about'];
        
        //$url="https://www.youtube.com/watch?v=yf4Y92Oath8";
        $data['message_type']=$this->CheckUrlType($url);


        if($data['message_type']=='Youtube_URL'){
          $youtubeId = preg_replace('/^[^v]+v.(.{11}).*/', '$1', $url);
          //$youtubeId=1;
          $data['message_about']= "<iframe width='560' height='315' src='https://www.youtube.com/embed/$youtubeId' frameborder='0' allowfullscreen></iframe>";
        }



		//$blogpost=$this->put();
		$blogpost_id =$this->Model_blogposts->insert($data);


		if(!$blogpost_id){
                 $this->response(array('status'=>'failure','message'=>'An unexpected error occurred while trying to create the blogpost'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
		}else{
                $this->response(array('status' =>'success','message'=>'Created'));
		}
	}
	else{
        $this->response(array('status'=> 'form failure', 'message'=> $this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
	}
}




function CheckUrlType($url){
    $regex = "((http|https?|ftp)\:\/\/)?"; // SCHEME 
    $regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?"; // User and Pass 
    $regex .= "([a-z0-9-.]*)\.([a-z]{2,3})"; // Host or IP 
    $regex .= "(\:[0-9]{2,5})?"; // Port 
    $regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?"; // Path 
    $regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?"; // GET Query 
    $regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?"; // Anchor 
  //echo $hostname; 


       if(preg_match("/^$regex$/", $url)) 
       { 
               return "Plain_URL";
             
        }

if (filter_var($url, FILTER_VALIDATE_URL)) { 
  // you're good
    if(preg_match("/^http|https:\/\/(?:www\.)?(?:youtube.com|youtu.be)\/(?:watch\?(?=.*v=([\w\-]+))(?:\S+)?|([\w\-]+))$/",$url)){
    // do youtube stuff
          
          
          if(preg_match('/youtube/',parse_url($url, PHP_URL_HOST))){
            return "Youtube_URL";
          }
          else {
            return "Plain_URL";
          }
}
}



  return "Plain_Text";

}























    }

 ?>