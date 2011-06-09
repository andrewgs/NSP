<?php

class Users_interface extends CI_Controller {

	var $user = array('uid'=>0,'uname'=>'','ulogin'=>'','upassword'=>'','status'=>FALSE);
	var $months = array("01"=>"января","02"=>"февраля","03"=>"марта","04"=>"апреля",
						"05"=>"мая","06"=>"июня","07"=>"июля","08"=>"августа",
						"09"=>"сентября","10"=>"октября","11"=>"ноября","12"=>"декабря");
	
	
	function __construct(){
	
		parent::__construct();
		
		$this->load->model('usermodel');
		$this->load->model('textmodel');
		$this->load->model('newsmodel');
		$this->load->model('certificatesmodel');
		$this->load->model('organsmodel');
		$this->load->model('productsmodel');
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
//				$this->user = array();
			endif;
		endif;
	}
	
	/* ----------------------------------------	users menu ---------------------------------------------------*/
	
	function index(){
		
		$pagevar = array(
					'description'	=> '',
					'title'			=> 'NSP-DON',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'content'		=> array(),
					'contacts'		=> array(),
					'news'			=> array(),
			);
		$pagevar['content'] = $this->textmodel->read_record(1);
		$pagevar['contacts'] = $this->textmodel->read_record(10);
		$pagevar['news'] = $this->newsmodel->read_limit_records(3);
		for($i=0;$i<count($pagevar['news']);$i++):
			$pagevar['news'][$i]['full_text'] = $pagevar['news'][$i]['text'];
			$pagevar['news'][$i]['bdate'] = $this->operation_date($pagevar['news'][$i]['bdate']);
			if(mb_strlen($pagevar['news'][$i]['text'],'UTF-8') > 250):									
				$pagevar['news'][$i]['text'] = mb_substr($pagevar['news'][$i]['text'],0,250,'UTF-8');	
				$pos = mb_strrpos($pagevar['news'][$i]['text'],' ',0,'UTF-8');
				$pagevar['news'][$i]['text'] = mb_substr($pagevar['news'][$i]['text'],0,$pos,'UTF-8');
				$pagevar['news'][$i]['text'] .= ' ... ';
			endif;
		endfor;
		
		$this->load->view('users_interface/index',$pagevar);
	}
	
	function about_me(){
	
		$pagevar = array(
					'description'	=> '',
					'title'			=> 'NSP-DON',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'content'		=> array(),
					'contacts'		=> array(),
					'news'			=> array(),
					'status'		=> FALSE
			);
			
		if($this->input->post('submit')):
			$this->form_validation->set_rules('name','"Имя"','required|htmlspecialchars|strip_tags|trim');
			$this->form_validation->set_rules('email','"E-mail"','valid_email|required|trim');
			$this->form_validation->set_rules('note','"Сообщение"','required|strip_tags');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->about_me();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$pagevar['status'] = TRUE;
			endif;
		endif;
			
		$pagevar['content'] = $this->textmodel->read_record(2);
		$pagevar['contacts'] = $this->textmodel->read_record(10);
		$pagevar['news'] = $this->newsmodel->read_limit_records(3);
		for($i=0;$i<count($pagevar['news']);$i++):
			$pagevar['news'][$i]['full_text'] = $pagevar['news'][$i]['text'];
			$pagevar['news'][$i]['bdate'] = $this->operation_date($pagevar['news'][$i]['bdate']);
			if(mb_strlen($pagevar['news'][$i]['text'],'UTF-8') > 250):									
				$pagevar['news'][$i]['text'] = mb_substr($pagevar['news'][$i]['text'],0,250,'UTF-8');	
				$pos = mb_strrpos($pagevar['news'][$i]['text'],' ',0,'UTF-8');
				$pagevar['news'][$i]['text'] = mb_substr($pagevar['news'][$i]['text'],0,$pos,'UTF-8');
				$pagevar['news'][$i]['text'] .= ' ... ';
			endif;
		endfor;
		
		$this->load->view('users_interface/aboutme',$pagevar);
	}
	
	function about_company(){
		
		$pagevar = array(
					'description'	=> '',
					'title'			=> 'NSP-DON',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'content'		=> array(),
					'contacts'		=> array(),
					'news'			=> array(),
			);
		$pagevar['content'] = $this->textmodel->read_record(3);
		$pagevar['contacts'] = $this->textmodel->read_record(10);
		$pagevar['news'] = $this->newsmodel->read_limit_records(3);
		for($i=0;$i<count($pagevar['news']);$i++):
			$pagevar['news'][$i]['full_text'] = $pagevar['news'][$i]['text'];
			$pagevar['news'][$i]['bdate'] = $this->operation_date($pagevar['news'][$i]['bdate']);
			if(mb_strlen($pagevar['news'][$i]['text'],'UTF-8') > 250):									
				$pagevar['news'][$i]['text'] = mb_substr($pagevar['news'][$i]['text'],0,250,'UTF-8');	
				$pos = mb_strrpos($pagevar['news'][$i]['text'],' ',0,'UTF-8');
				$pagevar['news'][$i]['text'] = mb_substr($pagevar['news'][$i]['text'],0,$pos,'UTF-8');
				$pagevar['news'][$i]['text'] .= ' ... ';
			endif;
		endfor;
		
		$this->load->view('users_interface/aboutcompany',$pagevar);
	}
	
	function certificates(){
	
		$pagevar = array(
					'description'	=> '',
					'title'			=> 'NSP-DON',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'content'		=> array(),
					'certificates'	=> array(),
					'contacts'		=> array(),
					'news'			=> array(),
			);
		$pagevar['content'] = $this->textmodel->read_record(4);
		$pagevar['certificates'] = $this->certificatesmodel->read_records();
		$pagevar['contacts'] = $this->textmodel->read_record(10);
		$pagevar['news'] = $this->newsmodel->read_limit_records(3);
		for($i=0;$i<count($pagevar['news']);$i++):
			$pagevar['news'][$i]['full_text'] = $pagevar['news'][$i]['text'];
			$pagevar['news'][$i]['bdate'] = $this->operation_date($pagevar['news'][$i]['bdate']);
			if(mb_strlen($pagevar['news'][$i]['text'],'UTF-8') > 250):									
				$pagevar['news'][$i]['text'] = mb_substr($pagevar['news'][$i]['text'],0,250,'UTF-8');	
				$pos = mb_strrpos($pagevar['news'][$i]['text'],' ',0,'UTF-8');
				$pagevar['news'][$i]['text'] = mb_substr($pagevar['news'][$i]['text'],0,$pos,'UTF-8');
				$pagevar['news'][$i]['text'] .= ' ... ';
			endif;
		endfor;
		
		$this->load->view('users_interface/certificates',$pagevar);	
	}
	
	function organs(){
	
		$pagevar = array(
					'description'	=> '',
					'title'			=> 'NSP-DON',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'content'		=> array(),
					'organs'		=> array(),
					'contacts'		=> array(),
					'news'			=> array(),
			);
		$pagevar['content'] = $this->textmodel->read_record(5);
		$pagevar['organs'] = $this->organsmodel->read_records();
		
		for($i=0;$i<count($pagevar['organs']);$i++):
			$pagevar['organs'][$i]['full_text'] = $pagevar['organs'][$i]['text'];
			if(mb_strlen($pagevar['organs'][$i]['text'],'UTF-8') > 250):									
				$pagevar['organs'][$i]['text'] = mb_substr($pagevar['organs'][$i]['text'],0,250,'UTF-8');	
				$pos = mb_strrpos($pagevar['organs'][$i]['text'],' ',0,'UTF-8');
				$pagevar['organs'][$i]['text'] = mb_substr($pagevar['organs'][$i]['text'],0,$pos,'UTF-8');
				$pagevar['organs'][$i]['text'] .= ' ... ';
			endif;
		endfor;
		
		$pagevar['contacts'] = $this->textmodel->read_record(10);
		$pagevar['news'] = $this->newsmodel->read_limit_records(3);
		for($i=0;$i<count($pagevar['news']);$i++):
			$pagevar['news'][$i]['full_text'] = $pagevar['news'][$i]['text'];
			$pagevar['news'][$i]['bdate'] = $this->operation_date($pagevar['news'][$i]['bdate']);
			if(mb_strlen($pagevar['news'][$i]['text'],'UTF-8') > 250):									
				$pagevar['news'][$i]['text'] = mb_substr($pagevar['news'][$i]['text'],0,250,'UTF-8');	
				$pos = mb_strrpos($pagevar['news'][$i]['text'],' ',0,'UTF-8');
				$pagevar['news'][$i]['text'] = mb_substr($pagevar['news'][$i]['text'],0,$pos,'UTF-8');
				$pagevar['news'][$i]['text'] .= ' ... ';
			endif;
		endfor;
		
		$this->load->view('users_interface/organs',$pagevar);	
	}
	
	function organ_type(){
		
		$pagevar = array(
					'description'	=> '',
					'title'			=> 'NSP-DON',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'organ'			=> array(),
					'products'		=> array(),
					'contacts'		=> array(),
					'news'			=> array(),
			);
		$organ = $this->uri->segment(2);
		$pagevar['organ'] = $this->organsmodel->read_record($organ);
		$pagevar['products'] = $this->productsmodel->read_records($organ);
		
		for($i=0;$i<count($pagevar['products']);$i++):
			$pagevar['products'][$i]['full_text'] = $pagevar['products'][$i]['text'];
			if(mb_strlen($pagevar['products'][$i]['text'],'UTF-8') > 250):									
				$pagevar['products'][$i]['text'] = mb_substr($pagevar['products'][$i]['text'],0,250,'UTF-8');	
				$pos = mb_strrpos($pagevar['products'][$i]['text'],' ',0,'UTF-8');
				$pagevar['products'][$i]['text'] = mb_substr($pagevar['products'][$i]['text'],0,$pos,'UTF-8');
				$pagevar['products'][$i]['text'] .= ' ... ';
			endif;
		endfor;
		
		$pagevar['contacts'] = $this->textmodel->read_record(10);
		$pagevar['news'] = $this->newsmodel->read_limit_records(3);
		for($i=0;$i<count($pagevar['news']);$i++):
			$pagevar['news'][$i]['full_text'] = $pagevar['news'][$i]['text'];
			$pagevar['news'][$i]['bdate'] = $this->operation_date($pagevar['news'][$i]['bdate']);
			if(mb_strlen($pagevar['news'][$i]['text'],'UTF-8') > 250):									
				$pagevar['news'][$i]['text'] = mb_substr($pagevar['news'][$i]['text'],0,250,'UTF-8');	
				$pos = mb_strrpos($pagevar['news'][$i]['text'],' ',0,'UTF-8');
				$pagevar['news'][$i]['text'] = mb_substr($pagevar['news'][$i]['text'],0,$pos,'UTF-8');
				$pagevar['news'][$i]['text'] .= ' ... ';
			endif;
		endfor;
		
		$this->load->view('users_interface/organ',$pagevar);
	}

	function product(){
		
		$pagevar = array(
					'description'	=> '',
					'title'			=> 'NSP-DON',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'product'		=> array(),
					'contacts'		=> array(),
					'news'			=> array(),
			);
		$product = $this->uri->segment(4);
		$pagevar['product'] = $this->productsmodel->read_record($product);
		$pagevar['contacts'] = $this->textmodel->read_record(10);
		$pagevar['news'] = $this->newsmodel->read_limit_records(3);
		for($i=0;$i<count($pagevar['news']);$i++):
			$pagevar['news'][$i]['full_text'] = $pagevar['news'][$i]['text'];
			$pagevar['news'][$i]['bdate'] = $this->operation_date($pagevar['news'][$i]['bdate']);
			if(mb_strlen($pagevar['news'][$i]['text'],'UTF-8') > 250):									
				$pagevar['news'][$i]['text'] = mb_substr($pagevar['news'][$i]['text'],0,250,'UTF-8');	
				$pos = mb_strrpos($pagevar['news'][$i]['text'],' ',0,'UTF-8');
				$pagevar['news'][$i]['text'] = mb_substr($pagevar['news'][$i]['text'],0,$pos,'UTF-8');
				$pagevar['news'][$i]['text'] .= ' ... ';
			endif;
		endfor;
		
		$this->load->view('users_interface/product',$pagevar);
	}
	
	function news(){
		
		$pagevar = array(
					'description'	=> '',
					'title'			=> 'NSP-DON',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'content'		=> array(),
					'contacts'		=> array(),
					'news'			=> array(),
			);
		$news = $this->uri->segment(2);
		$pagevar['content'] = $this->newsmodel->read_record($news);
		$pagevar['content']['bdate'] = $this->operation_date($pagevar['content']['bdate']);
		$pagevar['contacts'] = $this->textmodel->read_record(10);
		$pagevar['news'] = $this->newsmodel->read_limit_records(3);
		for($i=0;$i<count($pagevar['news']);$i++):
			$pagevar['news'][$i]['full_text'] = $pagevar['news'][$i]['text'];
			$pagevar['news'][$i]['bdate'] = $this->operation_date($pagevar['news'][$i]['bdate']);
			if(mb_strlen($pagevar['news'][$i]['text'],'UTF-8') > 250):									
				$pagevar['news'][$i]['text'] = mb_substr($pagevar['news'][$i]['text'],0,250,'UTF-8');	
				$pos = mb_strrpos($pagevar['news'][$i]['text'],' ',0,'UTF-8');
				$pagevar['news'][$i]['text'] = mb_substr($pagevar['news'][$i]['text'],0,$pos,'UTF-8');
				$pagevar['news'][$i]['text'] .= ' ... ';
			endif;
		endfor;
		
		$this->load->view('users_interface/news',$pagevar);
	}
	
	function allnews(){
		
		$pagevar = array(
					'description'	=> '',
					'title'			=> 'NSP-DON',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'content'		=> array(),
					'contacts'		=> array(),
					'news'			=> array(),
			);
		$pagevar['content'] = $this->newsmodel->read_records();
		for($i=0;$i<count($pagevar['content']);$i++):
			$pagevar['content'][$i]['full_text'] = $pagevar['content'][$i]['text'];
			$pagevar['content'][$i]['bdate'] = $this->operation_date($pagevar['content'][$i]['bdate']);
			if(mb_strlen($pagevar['content'][$i]['text'],'UTF-8') > 250):									
				$pagevar['content'][$i]['text'] = mb_substr($pagevar['content'][$i]['text'],0,250,'UTF-8');	
				$pos = mb_strrpos($pagevar['content'][$i]['text'],' ',0,'UTF-8');
				$pagevar['content'][$i]['text'] = mb_substr($pagevar['content'][$i]['text'],0,$pos,'UTF-8');
				$pagevar['content'][$i]['text'] .= ' ... ';
			endif;
		endfor;
		$pagevar['contacts'] = $this->textmodel->read_record(10);
		$pagevar['news'] = $this->newsmodel->read_limit_records(3);
		for($i=0;$i<count($pagevar['news']);$i++):
			$pagevar['news'][$i]['full_text'] = $pagevar['news'][$i]['text'];
			$pagevar['news'][$i]['bdate'] = $this->operation_date($pagevar['news'][$i]['bdate']);
			if(mb_strlen($pagevar['news'][$i]['text'],'UTF-8') > 250):									
				$pagevar['news'][$i]['text'] = mb_substr($pagevar['news'][$i]['text'],0,250,'UTF-8');	
				$pos = mb_strrpos($pagevar['news'][$i]['text'],' ',0,'UTF-8');
				$pagevar['news'][$i]['text'] = mb_substr($pagevar['news'][$i]['text'],0,$pos,'UTF-8');
				$pagevar['news'][$i]['text'] .= ' ... ';
			endif;
		endfor;
		
		$this->load->view('users_interface/allnews',$pagevar);
	}

	/*********************************************************************************************************************/
	
	function admin_login(){
	
		$pagevar = array(
					'description'	=> '',
					'title'			=> 'NSP-DON',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'error'			=> FALSE
			);
		if($this->user['status']):
			redirect('');
		endif;
		if($this->input->post('submit')):
			$this->form_validation->set_rules('login-name','"Логин"','required|trim');
			$this->form_validation->set_rules('login-pass','"Пароль"','required');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->admin_login();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$user = $this->usermodel->auth_user($_POST['login-name'],$_POST['login-pass']);
				if($user):
					$this->session->set_userdata('login_id',md5($user['ulogin'].$user['upassword']));
					$this->session->set_userdata('userid',$user['uid']);
					redirect('');
				endif;
				$pagevar['error'] = TRUE;
			endif;
		endif;
		$this->load->view('users_interface/admin-login',$pagevar);
	}
	
	function viewimage(){
		
		$section = $this->uri->segment(1);
		$id = $this->uri->segment(3);
		switch ($section){
			case 'sowner'			: $image = $this->usermodel->get_simage($id); break;
			case 'owner'			: $image = $this->usermodel->get_image($id); break;
			case 'news' 			: $image = $this->newsmodel->get_image($id); break;
			case 'text' 			: $image = $this->textmodel->get_image($id); break;
			case 'certificates' 	: $image = $this->certificatesmodel->get_image($id); break;
			case 'organs' 			: $image = $this->organsmodel->get_image($id); break;
			case 'sorgans' 			: $image = $this->organsmodel->get_simage($id); break;
			case 'product' 			: $image = $this->productsmodel->get_image($id); break;
			case 'sproduct' 		: $image = $this->productsmodel->get_simage($id); break;
		}
		header('Content-type: image/gif');
		echo $image;
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