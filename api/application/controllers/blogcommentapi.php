<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class BlogcommentApi extends REST_Controller{

    function __construct() {
                parent::__construct();
                $this->load->helper('my_api');
    }    


  

  function blogcomment_get(){

        //$blogcomment_count = $this->Model_blogcomments->infogetcount($id)->get_all();
        $this->load->model('Model_blogcomments');  
        $blogcomment = $this->Model_blogcomments->infogetone()->get_all();
        $this->response(array('status' =>'success','message'=>$blogcomment)); 

        
          
        }

    

function blogcomment_put() {

    $id=$this->uri->segment(3);  //Get Post-id from the URL 
    $this->load->library('form_validation');       //form validation
    $data = remove_unknown_fields($this->put(), $this->form_validation->get_field_names('blogcomment_put'));
    $data['post_id']=$id;
    $this->form_validation->set_data($data);

    $this->load->model('Model_blogcomments'); 
    if ($this->form_validation->run('blogcomment_put') !=false) {


        $url=$data['comment_about'];
        $data['comment_type']=$this->CheckUrlType($url);


        if($data['comment_type']=='Youtube_URL'){
          $youtubeId = preg_replace('/^[^v]+v.(.{11}).*/', '$1', $url);
       
          $data['comment_about']= "<iframe width='560' height='315' src='https://www.youtube.com/embed/$youtubeId' frameborder='0' allowfullscreen></iframe>";
        }

       
        $blogcomment_id =$this->Model_blogcomments->insert($data);


        if(!$blogcomment_id){
                 $this->response(array('status'=>'failure','message'=>'An unexpected error occurred while trying to create the blogcomment'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
                $this->response(array('status' =>'success','message'=>'Created' ));
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