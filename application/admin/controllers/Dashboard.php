<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-08-27 15:21:06
 * @Last Modified by:   Raven
 * @Last Modified time: 2019-08-27 15:21:06
 */


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


		//getCurUser();
		$this->_data['index_list'] = array(0 => array(
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


		$this->load->viewEx('/dashboard');
	}
}
