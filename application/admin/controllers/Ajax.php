<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-09-17 01:26:22
 * @Last Modified by: Raven
 * @Last Modified time: 2019-09-29 02:23:01
 */


/**
 * 处理ajax请求模块
 */
class Ajax extends MY_Controller {


	public function modalUpload() {
		//todo: 根据文件hash做到同个文件只需上传一次

		$config['upload_path']      = config_item('app'.DIRECTORY_SEPARATOR.'upload')['image']['path'];
		$config['allowed_types']    = config_item('app'.DIRECTORY_SEPARATOR.'upload')['image']['exts'];
		$config['max_size']     	= config_item('app'.DIRECTORY_SEPARATOR.'upload')['image']['size'];

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file')) {
			$this->_ajaxData['code'] = AJAX_FAIL;
			$this->_ajaxData['msg'] = '图片上传失败';
			//print_r( $error = array('error' => $this->upload->display_errors()) );

		} else {
			$this->load->model('uploadfile_model');
			$uploadData = $this->upload->data();
			$data = array(
				'user_id' => getCurUser('user_id'),
				'title' => $uploadData['file_name'],
				'path' => config_item('app'.DIRECTORY_SEPARATOR.'upload')['image']['path'].'/'.$uploadData['file_name']
			);
			if($id = $this->uploadfile_model->insert($data)) {
				unset($data['user_id']);
				$data['id'] = $id;
				$this->_ajaxData['data'] = $data;
				$this->_ajaxData['code'] = AJAX_SUCCESS;
				$this->_ajaxData['msg'] = '图片上传成功';
			} else {
				$this->_ajaxData['code'] = AJAX_FAIL;
				$this->_ajaxData['msg'] = '无法保存上传记录';
			}
		}

		echo json_encode($this->_ajaxData);
	}

	/**
	 * 图片附件列表
	 *
	 * @return void
	 */
	public function imagesList() {
		$this->load->model('uploadfile_model', '_model');

		$this->_disposePager();
		$this->_disposeTable();

		$this->_ajaxData['data'] = array(
			'list' => $this->_data['index_list'],
			'count' => $this->_data['index_pager']['count']
		);
		$this->_ajaxData['code'] = AJAX_SUCCESS;
		$this->_ajaxData['msg'] = '成功获取数据';

		echo json_encode($this->_ajaxData, JSON_NUMERIC_CHECK);
	}

	public function regionList() {
		$this->load->model('region_model', '_model');

		$this->_data['index_pager']['pageNum'] = 1;
		$this->_data['index_pager']['pageSize'] = 0;
		$this->_disposeTable();

		$this->_ajaxData['data'] = array(
			'list' => $this->_data['index_list'],
			'count' => $this->_data['index_pager']['count']
		);
		$this->_ajaxData['code'] = AJAX_SUCCESS;
		$this->_ajaxData['msg'] = '成功获取数据';

		echo json_encode($this->_ajaxData, JSON_NUMERIC_CHECK);
	}
}
