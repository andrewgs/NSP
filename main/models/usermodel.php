<?php
class Usermodel extends CI_Model {

	var $uid 			= 0;	/* идентификатор пользователя*/
	var $ulogin 		= '';	/* логин пользователя*/
	var $upassword 		= '';	/* пароль пользователя*/
	var $uname 			= '';	/* имя пользователя*/
	var $usubname 		= '';	/* фамилия пользователя*/
	var $uthname 		= '';	/* отчество пользователя*/
	var $uphoto 		= '';	/* фото пользователя*/
	var $usphoto 		= '';	/* фото пользователя*/
	var $uconfirmation	= '';	/* идентификатор подтверждения регистрации */
	
	function __construct(){
    
		parent::__construct();
	}

	function read_record($id){
		
		$this->db->where('uid',$id);
		$query = $this->db->get('users',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_info($id){
		
		$this->db->select('uid,uemail,uname,usubname,uthname,uconfirmation');
		$this->db->where('uid',$id);
		$query = $this->db->get('users');
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return FALSE;
	}
	
	function save_single_data($uid,$field,$data){
		
		$this->db->where('uid',$uid);
		$this->db->set($field,$data);
		$this->db->update('users');
		return $this->db->affected_rows();
	}
	
	function auth_user($login,$password){
		
		$this->db->where('uemail',$login);
		$this->db->where('upassword',md5($password));
		$query = $this->db->get('users',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function update_password($password,$email){
			
		$this->db->set('upassword',md5($password));
		$this->db->set('ucryptpassword',$this->encrypt->encode($password));
		$this->db->where('uemail',$email);
		$this->db->update('users');
		$res = $this->db->affected_rows();
		if($res == 0) return FALSE;
		return TRUE;
	}
	
	function read_field($uid,$field){
			
		$this->db->where('uid',$uid);
		$query = $this->db->get('users',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function get_image($id){
	
		$this->db->where('uid',$id);
		$this->db->select('uphoto');
		$query = $this->db->get('users');
		$data = $query->result_array();
		return $data[0]['uphoto'];
	}

	function get_simage($id){
	
		$this->db->where('uid',$id);
		$this->db->select('uphoto');
		$query = $this->db->get('users');
		$data = $query->result_array();
		return $data[0]['usphoto'];
	}
}
?>