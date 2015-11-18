<?php  if ( !defined('BASEPATH')) exit('No direct script access allowed');

$config= array(
   'blogpost_put'=>array(
  array('field' =>'dummyname','label'=>'dummyname','rules'=>'trim|max_length[20]'), 
  array('field' =>'dummyimage','label'=>'dummyimage','rules'=>'trim|max_length[20]'),  
  array('field' =>'message_about','label'=>'message','rules'=>'trim|required'),  
  array('field' =>'message_type','label'=>'message_type','rules'=>'trim|required|max_length[20]'),
	),
   'blogcomment_put'=>array(
  array('field' =>'post_id','label'=>'post_id','rules'=>'trim|required|max_length[20]'),   
  array('field' =>'dummyname','label'=>'dummyname','rules'=>'trim|max_length[20]'), 
  array('field' =>'dummyimage','label'=>'dummyimage','rules'=>'trim|max_length[20]'),  
  array('field' =>'comment_about','label'=>'comment','rules'=>'trim|required'),  
  array('field' =>'comment_type','label'=>'comment_type','rules'=>'trim|required|max_length[20]'),

	),   
);
?>