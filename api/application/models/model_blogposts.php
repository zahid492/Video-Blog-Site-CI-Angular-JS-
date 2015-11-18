<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
* 
*/
class Model_blogposts extends My_Model
{
	
	protected $_table='post';
	protected $primary_key='id';
	protected $return_type='array';



	    public function infogetone($id)
    {
        $this->db->select('post.*, comment.*');
        $this->db->join('comment', 'comment.post_id = post.id');
        $this->db->where('post.Id', $id);
        //$this->db->order_by("order", "asc");

        return $this;
    }

	    public function infogetall()
    {
        $this->db->select('post.*');
        $this->db->order_by('id', 'desc');

        return $this;
    }

        public function infogetcount()
    {
        $this->db->select('count(post.id) as blogpost_total');

        //$this->db->order_by("order", "asc");

        return $this;
    }

}
