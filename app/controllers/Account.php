<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Account extends Admin_Controller {
	public function create() {
		$form_rules = array (
				array (
						'field' => 'username',
						'label' => 'Username',
						'rules' => 'trim|required|min_length[4]|max_length[12]|callback_is_user_exist',
						'errors' => array (
								'required' => '请输入账号',
								'min_length' => '账号最少4个字符',
								'max_length' => '账号最多12个字符',
								'is_user_exist' => '账号重复' 
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
				),
				array (
						'field' => 'repassword',
						'label' => 'Repassword',
						'rules' => 'matches[password]',
						'errors' => array (
								'matches' => '两次密码不一致' 
						) 
				),
				array (
						'field' => 'email',
						'label' => 'Email',
						'rules' => 'trim|required|valid_email',
						'errors' => array (
								'required' => '请输入email',
								'valid_email' => '请输入有效email' 
						) 
				) 
		);
		
		$this->load->helper(array('form','url' ) );
		$this->load->library( 'form_validation' );
		$this->load->model( 'admin' );
		$this->form_validation->set_rules ( $form_rules );
		if ($this->form_validation->run () !== FALSE) {
			$username = $this->input->post ( 'username' );
			$password = $this->input->post ( 'password' );
			$email = $this->input->post ( 'email' );
			$ip = $this->input->ip_address ();
			
			$this->admin->addUser ( $username, $password, $email, $ip );
			
		}
		
		$this->load->view ( 'account' );
	}
	public function retrieve($username) {
		$pwd = password_hash ( "rasmuslerdorf", PASSWORD_BCRYPT );
		echo $pwd;
		echo '<br />';
		if (password_verify ( 'rasmuslerdorf', $pwd )) {
			echo 'Password is valid!';
		} else {
			echo 'Invalid password.';
		}
	}
	public function update($param) {
	}
	public function delete($param) {
	}
	private function is_user_exist($username) {
		$userInfo = $this->admin->getUser ( $username );
		return count ( $userInfo ) == 0;
	}
}
