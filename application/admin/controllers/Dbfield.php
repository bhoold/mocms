<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-10-31 19:11:28
 * @Last Modified by: Raven
 * @Last Modified time: 2019-11-30 00:36:48
 */


 /**
  * 表字段
  */
class Dbfield extends MY_Controller {

	/**
	 * 默认页面
	 *
	 * @return void
	 */
	public function index($tableName = null) {
		/*
		func_get_args
		func_num_args
		//echo $this->db->last_query();
		*/
		return $this->list($tableName); //index只做引导
	}

	/**
	 * 列表页面
	 *
	 * @return void
	 */
	public function list($tableName = null) {

		$this->_data['tooles_btns'] = $this->_data['index_tooles_btns'];
		$this->_disposeListAction();
		$this->_disposePager();
		$this->_disposeFilter();
		$this->_disposeTable($tableName);
		$this->_disposeMessage();

		$this->_data['page_get']['tableName'] = $tableName;

		$this->load->viewEx($this->_data['page_template']);
	}

	/**
	 * 添加页面
	 *
	 * @return void
	 */
	public function add($tableName = null) {
		$this->_data['tooles_btns'] = $this->_data['edit_tooles_btns'];

		if($this->input->method() == 'post'){
			$this->_disposeAddData($tableName);
			$this->_data['edit_formData'] = array(
				'name' => $this->form_validation->set_value('name'),
				'comment' => $this->form_validation->set_value('comment'),
				'type' => $this->form_validation->set_value('type'),
				'value' => $this->form_validation->set_value('value'),
				'length' => $this->form_validation->set_value('length')
			);
		} else {
			$this->_data['edit_formData'] = array(
				'name' => '',
				'comment' => '',
				'type' => '',
				'value' => '',
				'length' => ''
			);
		}

		$this->_disposeMessage();

		$this->_data['page_get']['tableName'] = $tableName;

		$this->load->viewEx($this->_data['page_template']);
	}

	/**
	 * 编辑页面
	 *
	 * @param string $name
	 * @return void
	 */
	public function edit($tableName = '') {
		$this->_data['tooles_btns'] = $this->_data['edit_tooles_btns'];

		if($tableName) {
			if($rowData = $this->_model->get($tableName)) {
				if($this->input->method() == 'post') {
					$this->_disposeEditData($tableName);
					$this->_data['edit_formData'] = array(
						'name' => $this->form_validation->set_value('name'),
						'comment' => $this->form_validation->set_value('comment')
					);
				} else {
					$this->_data['edit_formData'] = array(
						'name' => $rowData['Name'],
						'comment' => $rowData['Comment']
					);
				}
			} else {
				setPageMsg('数据不存在!', 'error');
				$this->_data['edit_hideForm'] = TRUE;
			}
		} else {
			setPageMsg('未提供查询关键词!', 'error');
			$this->_data['edit_hideForm'] = TRUE;
		}

		$this->_disposeMessage();

		$this->_data['page_get']['tableName'] = $tableName;

		$this->load->viewEx($this->_data['page_template']);
	}

	/**
	 * 处理列表页面表格
	 *
	 * @return void
	 */
	protected function _disposeTable($tableName = null) {
		if($this->_model && $this->_data['index_field'] !== false){
			if(!$tableName) {
				setPageMsg('未选择数据表!', 'error');
				return;
			}

			if(!$this->_model->isExistTable($tableName)) {
				setPageMsg($tableName.'数据表不存在!', 'error');
				return;
			}

			$list = $this->_model->list($tableName);
			$this->_data['index_list'] = $list;

			if(count($this->_data['index_field']) == 0) { //如果没定义列表字段将从数据表获取
				$this->_data['index_field'][] = array(
					'type' => 'checkbox',
					'fixed' => 'left'
				);
				foreach ($list as $i => $row) {
					if($i > 0) {
						break;
					}
					foreach ($row as $key => $value) {
						$this->_data['index_field'][] = array(
							'field' => $key,
							'label' => $key
						);
					}
				}
			}
		}
	}

	/**
	 * 处理添加页面的表单数据
	 *
	 * @return void
	 */
	protected function _disposeAddData($tableName = null, $post = array()) {
		if($this->input->method() == 'post'){
			if(count($post) == 0) {
				$post = $this->input->post(array('name','comment','type','length','value','other'));
			}

			if($this->form_validation->run() === FALSE){
				setPageMsg(validation_errors() ? validation_errors() : '表单未设置验证规则!', 'error');
				return;
			}


			if($this->_model->isExist($tableName, $post['name'])) {
				setPageMsg('字段已存在!', 'error');
				return;
			}

			if($this->_model->create($tableName, $post)) {
				setPageMsg('保存成功!', 'success');
				$this->_forward($tableName, $post['name']);
			} else {
				$error = $this->_model->getError();
				setPageMsg($error ? $error : '保存失败!', 'error');
			}

		}
	}

	/**
	 * 处理编辑页面的表单数据
	 *
	 * @return void
	 */
	protected function _disposeEditData($name) {
		if($this->input->method() == 'post') {
			$post = $this->input->post(array('name','comment'));

			if($this->form_validation->run() === FALSE){
				setPageMsg(validation_errors() ? validation_errors() : '表单未设置验证规则!', 'error');
				return;
			}

			if($name != $post['name']) {
				if($this->_model->isExist($post['name'])) {
					setPageMsg('表名已存在!', 'error');
					return;
				} else {
					if($this->_model->update($name, $post)) {
						setPageMsg('保存成功!', 'success');

						$this->_forward($post['name']);
					} else {
						$error = $this->_model->getError();
						setPageMsg($error ? $error : '保存失败!', 'error');
					}
				}
			} else {
				if($this->_model->modifyComment($name, $post['comment'])) {
					setPageMsg('保存成功!', 'success');

					$this->_forward($post['name']);
				} else {
					$error = $this->_model->getError();
					setPageMsg($error ? $error : '保存失败!', 'error');
				}
			}
		}
	}


	/**
	 * 列表页面删除记录
	 *
	 * @param string $idsStr
	 * @return void
	 */
	protected function _delete($idsStr) {
		if($this->_model->delete($idsStr)){
			setPageMsg($idsStr . ' ' . '删除成功!', 'success');
		}else{
			setPageMsg($idsStr . ' ' . '删除失败!', 'error');
		}
	}


	/**
	 * 新增和编辑页面成功后跳转
	 *
	 * @param integer $id
	 * @return void
	 */
	protected function _forward($tableName = null, $name = null) {
		$follow_action = $this->input->post('_follow-action');
		if($follow_action === 'save_new') {
			redirectEx('add/'.$tableName, 'location');
		} elseif($follow_action === 'save_close') {
			redirectEx('index/'.$tableName, 'location');
		} elseif($name) {
			redirectEx('edit/'.$tableName.'/'.$name, 'location');
		}
	}
}
