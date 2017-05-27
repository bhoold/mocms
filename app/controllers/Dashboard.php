<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Base_Controller {
	public function index()
	{
		$this->load->view('dashboard');
	}
}
