<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
* 
*/
class Model_blogcomments extends My_Model
{
	
	protected $_table='comment';
	protected $primary_key='id';
	protected $return_type='array';


	    public function infogetone()
    {
        $this->db->select('comment.*');
        //$this->db->order_by("order", "asc");

        return $this;
    }

    	    public function infogetall($id)
    {
        $this->db->select('comment.*');
        $this->db->where('post_id', $id);

        return $this;
    }




        public function infogetcount($id)
    {
        $this->db->select('count(comment.id) as blogcomment_total');
        $this->db->where('post_id', $id);
        //$this->db->order_by("order", "asc");

        return $this;
    }

}
