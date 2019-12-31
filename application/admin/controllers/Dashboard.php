<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-08-27 15:21:06
 * @Last Modified by: Raven
 * @Last Modified time: 2019-10-31 19:17:50
 */


 /**
  * 首页
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
		$this->_disposeMessage();

		$this->_data['ciVer'] = CI_VERSION;
		$this->_data['dbName'] = $this->db->platform();
		$this->_data['dbVer'] = $this->db->version();


		$this->load->viewEx('/dashboard');
	}
}
