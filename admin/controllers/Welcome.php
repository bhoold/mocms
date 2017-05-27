<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index(){
		$this->load->helper(array('form','url' ) );
		$this->load->library( 'form_validation' );
		
		$form_rules = array (
				array (
						'field' => 'username',
						'label' => 'Username',
						'rules' => 'trim|required|min_length[4]|max_length[12]|callback_is_user_exist',
						'errors' => array (
								'required' => '请输入账号',
								'min_length' => '账号最少4个字符',
								'max_length' => '账号最多12个字符',
								'is_user_exist' => '登录信息错误' 
						) 
				),
				array (
						'field' => 'password',
						'label' => 'Password',
						'rules' => 'trim|required|min_length[8]',
						'errors' => array (
								'required' => '请输入密码',
								'min_length' => '密码最少8个字符' 
						) 
				)
		);
		$this->form_validation->set_rules ( $form_rules );
		if ($this->form_validation->run () !== FALSE) {
			$username = $this->input->post ( 'username' );
			$password = $this->input->post ( 'password' );
			$ip = $this->input->ip_address ();
			if($this->login($username, $password, $ip))
				redirect('dashboard');
		}
		$this->load->view('login');
	}
	private function login($username, $password, $ip){
		$this->load->model( 'admin' );
		$userInfo = $this->admin->getUser($username);
		$pwdHash = $userInfo[0]['password'];
		if(password_verify($password, $pwdHash)){
				
		}
	}
	public function is_user_exist($username) {
		$this->load->model( 'admin' );
		$userInfo = $this->admin->getUser ( $username );
		return count ( $userInfo ) > 0;
	}
}
