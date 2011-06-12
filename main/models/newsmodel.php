<?php
class Newsmodel extends CI_Model {

	var $id 		= 0;
	var $title		= '';
	var $text		= '';
	var $image		= '';
	var $imgexist	= 0;
	var $bdate		= '';
	var $edate		= '';
	
	function __construct(){
    
		parent::__construct();
	}
	
	function read_record($id){
		$this->db->select('id,title,text,imgexist,bdate,edate');
		$this->db->where('id',$id);
		$query = $this->db->get('news',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_limit_records($limit){
		
		$this->db->select('id,title,text,imgexist,bdate,edate');
		$this->db->where('bdate <=',date("Y-m-d"));
		$this->db->where('edate >=',date("Y-m-d"));
		$this->db->order_by('id desc, bdate DESC');
		$query = $this->db->get('news',$limit);
		$data = $query->result_array();
		if(isset($data)) return $data;
		return NULL;
	}
	
	function read_records(){
		
		$this->db->select('id,title,text,imgexist,bdate,edate');
		$this->db->where('bdate <=',date("Y-m-d"));
		$this->db->where('edate >=',date("Y-m-d"));
		$this->db->order_by('id desc, bdate DESC');
		$query = $this->db->get('news');
		$data = $query->result_array();
		if(isset($data)) return $data;
		return NULL;
	}

	function read_all_records(){
		
		$this->db->select('id,title,text,imgexist,bdate,edate');
		$this->db->order_by('id desc, bdate DESC');
		$query = $this->db->get('news');
		$data = $query->result_array();
		if(isset($data)) return $data;
		return NULL;
	}
	
	function get_image($id){
		
		$this->db->where('id',$id);
		$this->db->select('image');
		$query = $this->db->get('news');
		$data = $query->result_array();
		return $data[0]['image'];
	}

	function update_record($data){
	
		$this->db->set('title',$data['title']);
		$this->db->set('text',$data['text']);
		$this->db->set('bdate',$data['bdate']);
		$this->db->set('edate',$data['edate']);
		if($data['image']):
			$this->db->set('image',$data['image']);
			$this->db->set('imgexist',1);
		endif;
		if(isset($data['delete'])):
			$this->db->set('image','');
			$this->db->set('imgexist',0);
		endif;
		$this->db->where('id',$data['id']);
		$this->db->update('news');
	}
	
	function delete_record($id){
	
		$this->db->where('id',$id);
		$this->db->delete('news');
	}
	
	function insert_record($data){
	
		$this->title	= $data['title'];
		$this->text		= $data['text'];
		$this->bdate	= $data['bdate'];
		$this->edate	= $data['edate'];
		if($data['image']):
			$this->image = $data['image'];
			$this->imgexist = 1;
		endif;
		$this->db->insert('news',$this);
	}
}