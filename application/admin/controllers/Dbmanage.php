<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-10-31 19:11:28
 * @Last Modified by: Raven
 * @Last Modified time: 2019-11-10 01:10:58
 */


 /**
  * 数据库
  */
class Dbmanage extends MY_Controller {

	public function add() {
		$this->_data['tooles_btns'] = $this->_data['edit_tooles_btns'];

		if($this->input->method() == 'post'){
			$this->_disposeAddData();
			$this->_data['edit_formData'] = array(
				'name' => $this->form_validation->set_value('name'),
				'comment' => $this->form_validation->set_value('comment')
			);
		} else {
			$this->_data['edit_formData'] = array(
				'name' => '',
				'comment' => ''
			);
		}

		$this->_disposeMessage();

		$this->load->viewEx($this->_data['page_template']);
	}

	public function edit($name = '') {
		$this->_data['tooles_btns'] = $this->_data['edit_tooles_btns'];

		if($name) {
			if($rowData = $this->_model->get($name)) {
				if($this->input->method() == 'post') {
					$this->_disposeEditData($name);
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

		$this->load->viewEx($this->_data['page_template']);
	}

	/**
	 * 处理列表页面表格
	 *
	 * @return void
	 */
	protected function _disposeTable() {
		if($this->_model && $this->_data['index_field'] !== false){
			$list = $this->_model->list();
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
	protected function _disposeAddData($post = array()) {
		if($this->input->method() == 'post'){
			if(count($post) == 0) {
				$post = $this->input->post(array('name','comment'));
			}

			if($this->form_validation->run() === FALSE){
				setPageMsg(validation_errors() ? validation_errors() : '表单未设置验证规则!', 'error');
				return;
			}


			if($this->_model->isExist($post['name'])) {
				setPageMsg('表名已存在!', 'error');
				return;
			}

			if($this->_model->create($post['name'], $post['comment'])) {
				setPageMsg('保存成功!', 'success');
				$this->_forward($post['name']);
			} else {
				$error = $this->_model->getError();
				setPageMsg($error ? $error : '保存失败!', 'error');
			}

		}
	}

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
}
