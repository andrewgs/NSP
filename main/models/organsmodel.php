<?php
class Organsmodel extends CI_Model {

	var $id 	= 0;
	var $title	= '';
	var $text	= '';
	var $image	= '';
	var $simage	= '';
	
	function __construct(){
    
		parent::__construct();
	}
	
	function read_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('organs',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records(){
		
		$query = $this->db->get('organs');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function get_image($id){
		
		$this->db->where('id',$id);
		$this->db->select('image');
		$query = $this->db->get('organs');
		$data = $query->result_array();
		return $data[0]['image'];
	}
	
	function get_simage($id){
		
		$this->db->where('id',$id);
		$this->db->select('simage');
		$query = $this->db->get('organs');
		$data = $query->result_array();
		return $data[0]['simage'];
	}

	function insert_record($data){
	
		$this->title	= $data['title'];
		$this->text		= $data['text'];
		if($data['image']):
			$this->image = $data['image'];
			$this->simage = $data['simage'];
		endif;
		$this->db->insert('organs',$this);
	}
	
	function update_record($data){
	
		$this->db->set('title',$data['title']);
		$this->db->set('text',$data['text']);
		if($data['image']):
			$this->db->set('image',$data['image']);
			$this->db->set('simage',$data['simage']);
		endif;
		if(isset($data['delete'])):
			$this->db->set('image','');
			$this->db->set('simage','');
		endif;
		$this->db->where('id',$data['id']);
		$this->db->update('organs');
	}

	function delete_record($id){
	
		$this->db->where('id',$id);
		$this->db->delete('organs');
	}
}