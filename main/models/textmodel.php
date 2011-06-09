<?php
class Textmodel extends CI_Model {

	var $id 	= 0;
	var $text	= '';
	var $image	= '';
	
	function __construct(){
    
		parent::__construct();
	}
	
	function read_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('text',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function get_image($id){
		
		$this->db->where('id',$id);
		$this->db->select('image');
		$query = $this->db->get('text');
		$data = $query->result_array();
		return $data[0]['image'];
	}
}