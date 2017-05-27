<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        if(!$this->isLogin())
        	redirect('welcome');
    }
    private function isLogin(){
    	$this->session->account;
    	return false;
    }
}
