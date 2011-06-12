<?php

class Admin_interface extends CI_Controller {

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
					'title'			=> 'Администрирование - Профиль',
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
		
		$pagevar = array(
					'description'	=> '',
					'title'			=> 'Администрирование - Редактирование',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'note'			=> ''
			);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('userfile','','callback_userfile_check');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->text_edit();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				if($_FILES['userfile']['error'] != 4):
					if($this->uri->segment(4)=='about-me'):
						$_POST['image'] = $this->resize_img($_FILES['userfile']['tmp_name'],300,400,TRUE);
					elseif($this->uri->segment(4)=='contact'):
						$_POST['image'] = $this->resize_img($_FILES['userfile']['tmp_name'],100,100,TRUE);
					else:
						$_POST['image'] = $this->resize_photo($_FILES['userfile']['tmp_name'],600,200,FALSE);
					endif;
				else:
					$_POST['image'] = '';
				endif;
				$this->textmodel->update_text($_POST);
				if($this->uri->segment(4) == 'contact'):
					redirect('');
				endif;
				redirect($this->uri->segment(4));
			endif;
		endif;
		$pagevar['note'] = $this->textmodel->read_text($this->uri->segment(3));
		$this->load->view('admin_interface/edit-text',$pagevar);
	}
	
	function certificates_edit(){
		
		$pagevar = array(
					'description'	=> '',
					'title'			=> 'Администрирование - Редактирование сертификата',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'content'		=> ''
			);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('userfile','','callback_userfile_check');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->certificates_edit();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				if($_FILES['userfile']['error'] != 4):
					$_POST['image'] = $this->resize_photo($_FILES['userfile']['tmp_name'],100,150,FALSE);
				else:
					$_POST['image'] = '';
				endif;
				$this->certificatesmodel->update_record($_POST);
				redirect('certificates-company');
			endif;
		endif;
		$pagevar['content'] = $this->certificatesmodel->read_record($this->uri->segment(3));
		$this->load->view('admin_interface/certificates-edit',$pagevar);
	}
	
	function certificates_delete(){
		
		$this->certificatesmodel->delete_record($this->uri->segment(3));
		redirect('certificates-company');
	}
	
	function certificates_add(){
	
		$pagevar = array(
					'description'	=> '',
					'title'			=> 'Администрирование - Добавление сертификата',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user
			);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title','"Название"','required|trim');
			$this->form_validation->set_rules('text','"Описание"','trim');
			$this->form_validation->set_rules('userfile','','callback_userfile_check');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->certificates_add();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				if($_FILES['userfile']['error'] != 4):
					$_POST['image'] = $this->resize_photo($_FILES['userfile']['tmp_name'],100,150,FALSE);
				else:
					$_POST['image'] = '';
				endif;
				$this->certificatesmodel->insert_record($_POST);
				redirect('certificates-company');
			endif;
		endif;
		$this->load->view('admin_interface/certificates-add',$pagevar);
	}
	
	function organs_add(){
		
		$pagevar = array(
					'description'	=> '',
					'title'			=> 'Администрирование - Добавление орган',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user
			);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title','"Название"','required|trim');
			$this->form_validation->set_rules('text','"Описание"','trim');
			$this->form_validation->set_rules('userfile','','callback_userfile_check');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->organs_add();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				if($_FILES['userfile']['error'] != 4):
					$_POST['image'] = $this->resize_photo($_FILES['userfile']['tmp_name'],250,300,FALSE);
					$_POST['simage'] = $this->resize_photo($_FILES['userfile']['tmp_name'],150,200,FALSE);
				else:
					$_POST['image'] = '';
				endif;
				$this->organsmodel->insert_record($_POST);
				redirect('products');
			endif;
		endif;
		$this->load->view('admin_interface/organs-add',$pagevar);
	}

	function organs_edit(){
		
		$pagevar = array(
					'description'	=> '',
					'title'			=> 'Администрирование - Добавление орган',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'content'		=> ''
			);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title','"Название"','required|trim');
			$this->form_validation->set_rules('userfile','','callback_userfile_check');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->organs_edit();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				if($_FILES['userfile']['error'] != 4):
					$_POST['image'] = $this->resize_photo($_FILES['userfile']['tmp_name'],250,300,FALSE);
					$_POST['simage'] = $this->resize_photo($_FILES['userfile']['tmp_name'],150,200,FALSE);
				else:
					$_POST['image'] = '';
				endif;
				$this->organsmodel->update_record($_POST);
				redirect('products');
			endif;
		endif;
		$pagevar['content'] = $this->organsmodel->read_record($this->uri->segment(3));
		$this->load->view('admin_interface/organs-edit',$pagevar);
	}
	
	function organs_delete(){
		
		$this->organsmodel->delete_record($this->uri->segment(3));
		redirect('products');
	}

	function product_add(){
	
		$pagevar = array(
					'description'	=> '',
					'title'			=> 'Администрирование - Добавление продукта',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user
			);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title','"Название"','required|trim');
			$this->form_validation->set_rules('text','"Описание"','trim');
			$this->form_validation->set_rules('price','"Цена"','required|trim');
			$this->form_validation->set_rules('userfile','','callback_userfile_check');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->product_add();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				if($_FILES['userfile']['error'] != 4):
					$_POST['image'] = $this->resize_photo($_FILES['userfile']['tmp_name'],250,300,FALSE);
					$_POST['simage'] = $this->resize_photo($_FILES['userfile']['tmp_name'],150,200,FALSE);
				else:
					$_POST['image'] = '';
				endif;
				$this->productsmodel->insert_record($_POST);
				redirect($this->uri->segment(2).'/'.$this->uri->segment(3));
			endif;
		endif;
		$this->load->view('admin_interface/product-add',$pagevar);
	}

	function product_edit(){
		
		$pagevar = array(
					'description'	=> '',
					'title'			=> 'Администрирование - Добавление продукта',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'content'		=> ''
			);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title','"Название"','required|trim');
			$this->form_validation->set_rules('price','"Цена"','required|trim');
			$this->form_validation->set_rules('userfile','','callback_userfile_check');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->product_add();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				if($_FILES['userfile']['error'] != 4):
					$_POST['image'] = $this->resize_photo($_FILES['userfile']['tmp_name'],250,300,FALSE);
					$_POST['simage'] = $this->resize_photo($_FILES['userfile']['tmp_name'],150,200,FALSE);
				else:
					$_POST['image'] = '';
				endif;
				$this->productsmodel->update_record($_POST);
				redirect($this->uri->segment(2).'/'.$this->uri->segment(3));
			endif;
		endif;
		$pagevar['content'] = $this->productsmodel->read_record($this->uri->segment(5));
		$this->load->view('admin_interface/product-edit',$pagevar);
	}
	
	function product_delete(){
	
		$this->productsmodel->delete_record($this->uri->segment(5));
		redirect($this->uri->segment(2).'/'.$this->uri->segment(3));
	}

	function news_add(){
		
		$pagevar = array(
					'description'	=> '',
					'title'			=> 'Администрирование - Добавление новости',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user
			);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title','"Название"','required|trim');
			$this->form_validation->set_rules('text','','trim');
			$this->form_validation->set_rules('bdate','','trim');
			$this->form_validation->set_rules('edate','','trim');
			$this->form_validation->set_rules('text','"Описание"','trim');
			$this->form_validation->set_rules('userfile','','callback_userfile_check');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->news_add();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				if($_FILES['userfile']['error'] != 4):
					$_POST['image'] = $this->resize_photo($_FILES['userfile']['tmp_name'],100,100,FALSE);
				else:
					$_POST['image'] = '';
				endif;
				$pattern = "/(\d+)\/(\w+)\/(\d+)/i";
				$replacement = "\$3-\$2-\$1";
				$_POST['bdate'] = preg_replace($pattern,$replacement,$_POST['bdate']);
				$pattern = "/(\d+)\/(\w+)\/(\d+)/i";
				$replacement = "\$3-\$2-\$1";
				$_POST['edate'] = preg_replace($pattern,$replacement,$_POST['edate']);
				$this->newsmodel->insert_record($_POST);
				redirect('news');
			endif;
		endif;
		$this->load->view('admin_interface/news-add',$pagevar);
	}
	
	function news_edit(){
		
		$pagevar = array(
					'description'	=> '',
					'title'			=> 'Администрирование - Редактирование новости',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'content'		=> array()
			);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title','"Название"','required|trim');
			$this->form_validation->set_rules('text','','trim');
			$this->form_validation->set_rules('bdate','','trim');
			$this->form_validation->set_rules('edate','','trim');
			$this->form_validation->set_rules('text','"Описание"','trim');
			$this->form_validation->set_rules('userfile','','callback_userfile_check');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->news_add();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				if($_FILES['userfile']['error'] != 4):
					$_POST['image'] = $this->resize_photo($_FILES['userfile']['tmp_name'],100,100,FALSE);
				else:
					$_POST['image'] = '';
				endif;
				$pattern = "/(\d+)\/(\w+)\/(\d+)/i";
				$replacement = "\$3-\$2-\$1";
				$_POST['bdate'] = preg_replace($pattern,$replacement,$_POST['bdate']);
				$pattern = "/(\d+)\/(\w+)\/(\d+)/i";
				$replacement = "\$3-\$2-\$1";
				$_POST['edate'] = preg_replace($pattern,$replacement,$_POST['edate']);
				$this->newsmodel->update_record($_POST);
				redirect('news');
			endif;
		endif;
		$pagevar['content'] = $this->newsmodel->read_record($this->uri->segment(3));
		$pagevar['content']['bdate'] = $this->operation_date_slash($pagevar['content']['bdate']);
		$pagevar['content']['edate'] = $this->operation_date_slash($pagevar['content']['edate']);
		$this->load->view('admin_interface/news-edit',$pagevar);
	}
	
	function news_delete(){
	
		$this->newsmodel->delete_record($this->uri->segment(3));
		redirect('news');
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
											
	function userfile_check($file){
		
		$tmpName = $_FILES['userfile']['tmp_name'];
		
		/*if($_FILES['userfile']['error'] == 4):
			$this->form_validation->set_message('userfile_check','Не указан файл');
			return FALSE;
		endif;*/
		if($_FILES['userfile']['error'] != 4):
			if(!$this->case_image($tmpName)):
				$this->form_validation->set_message('userfile_check','Формат не поддерживается');
				return FALSE;
			endif;
		endif;
		if($_FILES['userfile']['error'] == 1):
			$this->form_validation->set_message('userfile_check','Размер более 5 Мб!');
			return FALSE;
		endif;
		return TRUE;
	}
	
	function resize_img($tmpName,$wgt,$hgt,$ratio){
			
		chmod($tmpName,0777);
		$img = getimagesize($tmpName);		
		$size_x = $img[0];
		$size_y = $img[1];
		$wight = $wgt;
		$height = $hgt; 
		if(($size_x < $wgt) or ($size_y < $hgt)):
			$this->resize_image($tmpName,$wgt,$hgt,FALSE);
			$image = file_get_contents($tmpName);
			return $image;
		endif;
		if($size_x > $size_y):
			$this->resize_image($tmpName,$size_x,$hgt,$ratio);
		else:
			$this->resize_image($tmpName,$wgt,$size_y,$ratio);
		endif;
		$img = getimagesize($tmpName);		
		$size_x = $img[0];
		$size_y = $img[1];
		switch ($img[2]){
			case 1: $image_src = imagecreatefromgif($tmpName); break;
			case 2: $image_src = imagecreatefromjpeg($tmpName); break;
			case 3:	$image_src = imagecreatefrompng($tmpName); break;
		}
		$x = round(($size_x/2)-($wgt/2));
		$y = round(($size_y/2)-($hgt/2));
		if($x < 0):
			$x = 0;	$wight = $size_x;
		endif;
		if($y < 0):
			$y = 0; $height = $size_y;
		endif;
		$image_dst = ImageCreateTrueColor($wight,$height);
		imageCopy($image_dst,$image_src,0,0,$x,$y,$wight,$height);
		imagePNG($image_dst,$tmpName);
		imagedestroy($image_dst);
		imagedestroy($image_src);
		$image = file_get_contents($tmpName);
		return $image;
	}				

	function resize_image($image,$wgt,$hgt,$ratio){
	
		$this->load->library('image_lib');
		$this->image_lib->clear();
		$config['image_library'] 	= 'gd2';
		$config['source_image']		= $image; 
		$config['create_thumb'] 	= FALSE;
		$config['maintain_ratio'] 	= $ratio;
		$config['width'] 			= $wgt;
		$config['height'] 			= $hgt;
				
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	}

	function resize_photo($tmpName,$wgt,$hgt,$ratio){
		
		chmod($tmpName,0777);
		$this->load->library('image_lib');
		$this->image_lib->clear();
		$config['image_library'] 	= 'gd2';
		$config['source_image']		= $tmpName; 
		$config['create_thumb'] 	= FALSE;
		$config['maintain_ratio'] 	= $ratio;
		$config['width'] 			= $wgt;
		$config['height'] 			= $hgt;
				
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		
		return file_get_contents($tmpName);
	}

	function case_image($file){
			
		$info = getimagesize($file);
		switch ($info[2]):
			case 1	: return TRUE;
			case 2	: return TRUE;
			case 3	: return TRUE;
			default	: return FALSE;	
		endswitch;
	}
}