<?php

class Admin_interface extends CI_Controller {

	var $user = array('uid'=>0,'uname'=>'','ulogin'=>'','upassword'=>'','status'=>FALSE);
	var $months = array("01"=>"января","02"=>"февраля","03"=>"марта","04"=>"апреля",
						"05"=>"мая","06"=>"июня","07"=>"июля","08"=>"августа",
						"09"=>"сентября","10"=>"октября","11"=>"ноября","12"=>"декабря");
	
	
	function __construct(){
	
		parent::__construct();
		
		$this->load->model('usermodel');
		$cookieuid = $this->session->userdata('login_id');
		if(isset($cookieuid) and !empty($cookieuid)):
			$this->user['uid'] = $this->session->userdata('userid');
			if($this->user['uid']):
				$userinfo = $this->usermodel->read_info($this->user['uid']);
				if($userinfo):
					$this->user['uname']	 = $userinfo['uname'];
					$this->user['ulogin'] 	 = $userinfo['ulogin'];
					$this->user['upassword'] = $userinfo['upassword'];
					$this->user['uemail'] 	 = $userinfo['uemail'];
					$this->user['status'] 	 = TRUE;
				endif;
			endif;
			
			if($this->session->userdata('login_id') != md5($this->user['ulogin'].$this->user['upassword'])):
				$this->user['status'] = FALSE;
				$this->user = array();
				redirect('admin');
			endif;
		else:
			redirect('admin');
		endif;
	}
	
	function profile(){
	
		$pagevar = array(
					'description'	=> '',
					'title'			=> 'NSP-DON',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'status'		=> FALSE
			);
			
		if($this->input->post('submit')):
			$this->form_validation->set_rules('name','"Имя"','required|htmlspecialchars|strip_tags|trim');
			$this->form_validation->set_rules('email','"E-mail"','valid_email|required|trim');
			$this->form_validation->set_rules('newpass','"Новый пароль"','required|trim|min_length[6]');
			$this->form_validation->set_rules('confpass','"Подтвердите пароль"','required|matches[newpass]|trim');
			$this->form_validation->set_message('matches','Пароли не совпадают');
			$this->form_validation->set_message('min_length','Длина пароля должна быть не менее 6 символов');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->profile();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$this->usermodel->update_data($this->user['uid'],$_POST);
				$this->session->set_userdata('login_id',md5($this->user['ulogin'].md5($_POST['newpass'])));
				$pagevar['status'] = TRUE;
			endif;
		endif;
		
		$this->load->view('admin_interface/profile',$pagevar);
	}
	
	function pass_check($curpass){
	
		if($this->usermodel->user_exist('upassword',md5($curpass))):
			$this->form_validation->set_message('pass_check','Не верный пароль');
			return FALSE;
		else:
			return TRUE;
		endif;
	}
	
	function shutdown(){
	
		$this->session->sess_destroy();
		redirect('');
	}

	function text_edit(){
		
	}
	
	function certificates_edit(){
		
	}
	
	function certificates_delete(){
		
	}
	
	function certificates_add(){
		
	}
	
	function organs_add(){
		
	}

	function organs_edit(){
		
	}
	
	function organs_delete(){
		
	}

	function product_add(){
		
	}

	function product_edit(){
		
	}
	
	function product_delete(){
		
	}
	
	function operation_date($field){
			
		$list = preg_split("/-/",$field);
		$nmonth = $this->months[$list[1]];
		$pattern = "/(\d+)(-)(\w+)(-)(\d+)/i";
		$replacement = "\$5 $nmonth \$1 г."; 
		return preg_replace($pattern, $replacement,$field);
	}

	function operation_date_slash($field){
		
		$list = preg_split("/-/",$field);
		$nmonth = $this->months[$list[1]];
		$pattern = "/(\d+)(-)(\w+)(-)(\d+)/i";
		$replacement = "\$5/\$3/\$1"; 
		return preg_replace($pattern, $replacement,$field);
	}

	function operation_date_minus($field){
		
		$list = preg_split("/-/",$field);
		$nmonth = $this->months[$list[1]];
		$pattern = "/(\d+)(-)(\w+)(-)(\d+)/i";
		$replacement = "\$5-\$3-\$1"; 
		return preg_replace($pattern, $replacement,$field);
	}				
}