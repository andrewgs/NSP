<?php
class Certificatesmodel extends CI_Model {

	var $id 	= 0;
	var $title	= '';
	var $text	= '';
	var $image	= '';
	
	function __construct(){
    
		parent::__construct();
	}
	
	function insert_record($data){
	
		$this->title	= $data['title'];
		$this->text		= $data['text'];
		if($data['image']):
			$this->image = $data['image'];
		endif;
		$this->db->insert('certificates',$this);
	}
	
	function update_record($data){
	
		$this->db->set('title',$data['title']);
		$this->db->set('text',$data['text']);
		if($data['image']):
			$this->db->set('image',$data['image']);
		endif;
		if(isset($data['delete'])):
			$this->db->set('image','');
		endif;
		$this->db->where('id',$data['id']);
		$this->db->update('certificates');
	}

	function delete_record($id){
	
		$this->db->where('id',$id);
		$this->db->delete('certificates');
	}
	
	function read_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('certificates',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records(){
		
		$this->db->order_by('id','DESC');
		$query = $this->db->get('certificates');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function get_image($id){
		
		$this->db->where('id',$id);
		$this->db->select('image');
		$query = $this->db->get('certificates');
		$data = $query->result_array();
		return $data[0]['image'];
	}
}