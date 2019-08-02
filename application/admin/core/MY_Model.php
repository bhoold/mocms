<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 后台基础控制器
 */
class MY_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();

	}
}
