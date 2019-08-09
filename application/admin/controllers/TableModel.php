<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-08-07 12:04:27
 * @Last Modified by: Raven
 * @Last Modified time: 2019-08-09 11:57:48
 */


/**
 * 数据模型
 */
class TableModel extends MY_Controller {

	protected $modeldbprefix = 'model_';

    public function __construct()
    {
		parent::__construct();

	}

	public function list() {

		$this->_data['page_title'] = '数据模型：列表';

		$this->_data['tooles_btns'] = array(
			'left' => array(
				array(
					array(
						'text' => '新建',
						'action' => 'add',
						'domClass' => 'layui-btn-primary'
					),
					array(
						'text' => '编辑',
						'action' => 'edit'
					),
					array(
						'text' => '删除',
						'action' => 'del'
					)
				)
			),
			'right' => array(
				array(
					array(
						'text' => '设置',
						'action' => 'setup'
					)
				)
			)
		);

		$this->_data['index_leftMenu'] = array(
			array(
				'title' => '菜单',
				'link' => 'index',
				'active' => $this->router->class == 'menus' ? 'active' : ''
			),
			array(
				'title' => '菜单项',
				'link' => 'menusItem/index',
				'active' => $this->router->class == 'menusItem' ? 'active' : ''
			)
		);

		$this->_data['index_filter'] = array(
			array(
				'pattern' => 'like', //where,like
				'label' => '名称',
				'name' => 'title',
				'value' => '',
				//'operator' => '='
			)
		);

		$this->_data['index_tableField'] = array(
			array(
				'text' => '名称',
				'field' => 'title',
				'width' => '300'
			)
		);

		parent::list();
	}



	public function add() {

		$this->_data['page_title'] = '数据模型：添加';

		$this->_data['tooles_btns'] = array(
			'left' => array(
				array(
					array(
						'text' => '保存',
						'action' => 'save',
						'domClass' => 'layui-btn-primary'
					),
					array(
						'text' => '保存并关闭',
						'action' => 'save_close'
					),
					array(
						'text' => '保存并新建',
						'action' => 'save_new'
					),
					array(
						'text' => '取消',
						'action' => 'cancel'
					)
				)
			),
			'right' => array(
				array(
					array(
						'text' => '设置',
						'action' => 'setup'
					)
				)
			)
		);

		parent::add();
	}



	public function edit($id = 0) {
		$this->_data['page_title'] = '数据模型：编辑';

		$this->_data['tooles_btns'] = array(
			'left' => array(
				array(
					array(
						'text' => '保存',
						'action' => 'save',
						'domClass' => 'layui-btn-primary'
					),
					array(
						'text' => '保存并关闭',
						'action' => 'save_close'
					),
					array(
						'text' => '保存并新建',
						'action' => 'save_new'
					),
					array(
						'text' => '取消',
						'action' => 'cancel'
					)
				)
			),
			'right' => array(
				array(
					array(
						'text' => '设置',
						'action' => 'setup'
					)
				)
			)
		);

		parent::edit($id);
	}


	/**
	 * 处理添加页面的表单数据
	 *
	 * @return void
	 */
	protected function _disposeAddData() {
		if($this->input->method() == 'post'){
			$post = $this->input->post(array('title','desc','fields'));

			$this->form_validation->reset_validation();
			if($this->form_validation->run() !== FALSE){
				$flag = TRUE;

				$tableName = $this->modeldbprefix.$post['title'];
				if($this->model->checkExist(array('title' => $tableName))) {
					setPageMsg('表名重复!', 'error');
					$flag = FALSE;
				}

				$fields = json_decode($post['fields']);
				$fieldsFormat = array();
				foreach($fields as $row) {
					$fieldsFormat[$row->name] = array(
						'type' => $row->type,
						'unsigned' => $row->unsigned ? TRUE : FALSE,
						'null' => $row->null ? TRUE : FALSE,
						'unique' => $row->unique ? TRUE : FALSE,
						'auto_increment' => $row->auto_increment ? TRUE : FALSE,
					);
					if($row->value !== '') {
						$fieldsFormat[$row->name]['default'] = $row->value;
					}
				}

				$this->load->dbforge();
				$this->dbforge->add_field($fieldsFormat);
				$this->dbforge->add_key('id', TRUE);
				$this->dbforge->create_table($tableName, FALSE, array('ENGINE' => 'InnoDB','DEFAULT CHARSET' => 'utf8'));

				if($flag) {
					if($id = $this->model->insert($post)){
						setPageMsg('新增成功!', 'success');

						$this->_forward($id);
					}else{
						setPageMsg('保存数据失败!', 'error');
					}
				}
			}else{
				setPageMsg('表单验证失败!', 'error');
			}
		}
	}

	/**
	 * 处理编辑页面的表单数据
	 *
	 * @param integer $id
	 * @return void
	 */
	protected function _disposeEditData($id) {
		if($this->input->method() == 'post') {
			$post = $this->input->post(array('title'));

			$this->form_validation->reset_validation();
			if($this->form_validation->run() !== FALSE) {
				$flag = TRUE;

				//something: 验证$flag
				$existData = $this->model->get(array('title' => $post['title']));
				if($existData && $existData['id'] != $id) {
					setPageMsg('名称重复!', 'error');
					$flag = FALSE;
				}

				if($flag) {
					$where = array('id'=>$id);
					if($this->model->update($where, $post)) {
						setPageMsg('编辑成功!', 'success');

						$this->_forward($id);
					} else {
						setPageMsg('保存数据失败!', 'error');
					}
				}
			} else {
				setPageMsg('表单验证失败!', 'error');
			}
		}
	}

}
