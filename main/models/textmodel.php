<?php
class Textmodel extends CI_Model {

	var $id 	= 0;
	var $text	= '';
	var $image	= '';
	var $imgexist = 0;
	function __construct(){
    
		parent::__construct();
	}
	
	function read_record($id){
		
		$this->db->select('id,text,imgexist');
		$this->db->where('id',$id);
		$query = $this->db->get('text',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_text($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('text',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0]['text'];
		return NULL;
	}

	function get_image($id){
		
		$this->db->where('id',$id);
		$this->db->select('image');
		$query = $this->db->get('text');
		$data = $query->result_array();
		return $data[0]['image'];
	}

	function update_text($data){
	
		$this->db->set('text',$data['text']);
		if($data['image']):
			$this->db->set('image',$data['image']);
			$this->db->set('imgexist',1);
		endif;
		if(isset($data['delete'])):
			$this->db->set('image','');
			$this->db->set('imgexist',0);
		endif;
		$this->db->where('id',$data['id']);
		$this->db->update('text');
	}
}