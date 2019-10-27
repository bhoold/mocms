<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-08-02 23:52:08
 * @Last Modified by: Raven
 * @Last Modified time: 2019-08-10 12:55:11
 */


 /**
  * 功能模块模型
  */
class module_model extends MY_Model {

	protected $dbprefix = 'system_';

	public function __construct()
	{
		parent::__construct();

	}


}
