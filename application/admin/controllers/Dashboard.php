<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

	}

	/**
	 * 显示控制台界面
	 */
	public function index()
	{
		$data = array();
		$data['list'] = array(0 => array(
			'id' => '1',
			'username' => '1',
			'sex' => '1',
			'email' => '1',
			'state' => '1',
			'regtime' => '1',
			'regip' => '1',
			'lastlogintime' => '1',
			'lastloginip' => '1',
			'createbyadmin' => '1',

		));
		$this->load->viewEx('/dashboard', $data);
	}
}
