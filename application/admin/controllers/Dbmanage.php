<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-10-31 19:11:28
 * @Last Modified by: Raven
 * @Last Modified time: 2019-11-08 17:15:16
 */


 /**
  * 数据库
  */
class Dbmanage extends MY_Controller {

	/**
	 * 处理列表页面表格
	 *
	 * @return void
	 */
	protected function _disposeTable() {
		$tables = $this->db->list_tables();
		$list = array();
		foreach ($tables as $table) {
			$list[] = array(
				'name' => $table
			);
		}
		$this->_data['index_list'] = $list;

	}

}
