<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-08-27 15:21:06
 * @Last Modified by: Raven
 * @Last Modified time: 2019-09-29 01:52:43
 */


class Modal extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

	}

	/**
	 * 默认弹框
	 */
	public function index()
	{
		$this->load->model('uploadfile_model', '_model');
		$this->_data['page_template'] = '/modal';
		//$this->_data['index_pager']['pageSize'] = 42;

		//已选择的
		$this->_data['selectedList'] = array('list' => array(), 'count' => 0);
		$selected = $this->input->get('selected');
		if($selected) {
			$ids = explode(',', $selected);
			$result = $this->_model->list(array('where_in' => array('id' => $ids)));
			$list = array();
			foreach ($ids as $id) {
				foreach ($result['list'] as $key => $value) {
					if($value['id'] == $id) {
						$list[] = $value;
					}
				}
			}
			$this->_data['selectedList']['list'] = $list;
			$this->_data['selectedList']['count'] = count($list);
		}


		parent::list();
	}
}
