<?php
class Productsmodel extends CI_Model {

	var $id 	= 0;
	var $title	= '';
	var $text	= '';
	var $image	= '';
	var $simage	= '';
	var $price	= '';
	var $currency = '';
	var $organ = '';
	
	function __construct(){
    
		parent::__construct();
	}
	
	function read_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('products',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($organ){
		
		$this->db->where('organ',$organ);
		$this->db->order_by('title');
		$query = $this->db->get('products');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function get_image($id){
		
		$this->db->where('id',$id);
		$this->db->select('image');
		$query = $this->db->get('products');
		$data = $query->result_array();
		return $data[0]['image'];
	}
	
	function get_simage($id){
		
		$this->db->where('id',$id);
		$this->db->select('simage');
		$query = $this->db->get('products');
		$data = $query->result_array();
		return $data[0]['simage'];
	}
	
	function insert_record($data){
	
		$this->title	= $data['title'];
		$this->text		= $data['text'];
		$this->price	= $data['price'];
		$this->currency	= $data['currency'];
		$this->organ	= $data['organ'];
		if($data['image']):
			$this->image = $data['image'];
			$this->simage = $data['simage'];
		endif;
		$this->db->insert('products',$this);
	}
	
	function update_record($data){
	
		$this->db->set('title',$data['title']);
		$this->db->set('text',$data['text']);
		$this->db->set('price',$data['price']);
		$this->db->set('currency',$data['currency']);
		if($data['image']):
			$this->db->set('image',$data['image']);
			$this->db->set('simage',$data['simage']);
		endif;
		if(isset($data['delete'])):
			$this->db->set('image','');
			$this->db->set('simage','');
		endif;
		$this->db->where('id',$data['id']);
		$this->db->update('products');
	}

	function delete_record($id){
	
		$this->db->where('id',$id);
		$this->db->delete('products');
	}
}