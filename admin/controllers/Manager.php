<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends Admin_Controller {
	public function logout()
	{
		$this->session->unset_userdata('manager');
	}
}
