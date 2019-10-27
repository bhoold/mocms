<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-08-07 12:04:27
 * @Last Modified by: Raven
 * @Last Modified time: 2019-08-12 19:03:23
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
				'label' => '表名',
				'name' => 'title',
				'value' => '',
				//'operator' => '='
			)
		);

		$this->_data['index_tableField'] = array(
			array(
				'text' => '表名',
				'field' => 'title',
				'width' => '150'
			),
			array(
				'text' => '描述',
				'field' => 'desc',
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
		if($id === 0) {
			return FALSE;
		}
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

		$tableInfo = $this->model->get(array('id' => $id));
		$realFields = $this->model->getFields($this->modeldbprefix.$tableInfo['title']);
		$recordingFields = json_decode($tableInfo['fields'], TRUE);

		if(count($realFields) !== count($recordingFields)) {
			setPageMsg('记录的表信息字段数量和实际不符,请维护!', 'error');
		} else {
			$isFieldError = FALSE;
			foreach($recordingFields as $item) {
				if($isFieldError) {
					break;
				}
				if(in_array($item['name'], $realFields)) {
					$fieldsData = $this->model->getFieldsData($this->modeldbprefix.$tableInfo['title']);
					foreach($fieldsData as $item2) {
						if($item2->name === $item['name']) {
							$fieldType = '';
							$fieldConstraint = 0;
							preg_match_all('/\b(([a-z]{3,})|([A-Z]{3,}))/', $item['type'], $result);
							$fieldType = $result[0][0];
							preg_match_all('/\d{1,}/', $item['type'], $result);
							if(count($result[0])) {
								$fieldConstraint = $result[0][0];
							}
							if(strtoupper($fieldType) != strtoupper($item2->type)) {
								setPageMsg('字段 “'.$item['name'].'” 类型与实际不一致,请维护!', 'error');
								$isFieldError = TRUE;
							} else if($fieldConstraint > 0 && $fieldConstraint != $item2->max_length) {
								setPageMsg('字段 “'.$item['name'].'” 长度与实际不一致,请维护!', 'error');
								$isFieldError = TRUE;
							}/* else if($item['value'] != $item2->default) { //bug: 不能判断空格
								setPageMsg('字段 “'.$item['name'].'” 默认值与实际不一致,请维护!', 'error');
								$isFieldError = TRUE;
							}*/
							break;
						}
					}
					//print_r($recordingFields);print_r($fieldsData);
				} else {
					setPageMsg('记录的表信息有些字段不存在,请维护!', 'error');
					break;
				}
			}
		}

		parent::edit($id);
	}

	/**
	 * 列表页面删除记录
	 *
	 * @param string $idsStr
	 * @return void
	 */
	protected function _delete($idsStr) {

		$idArr = explode(',', $idsStr);
		$tableNameArr = array();
		foreach ($idArr as $id) {
			$tableInfo = $this->model->get(array('id' => $id));
			$tableNameArr[] = $this->modeldbprefix.$tableInfo['title'];
		}

		if($this->model->delTable($tableNameArr) && $this->model->delete($idArr)){
			setPageMsg('ID:' . $idsStr . ' ' . '删除成功!', 'success');
		}else{
			setPageMsg('ID:' . $idsStr . ' ' . '删除失败!', 'error');
		}
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

				if($this->model->checkExist(array('title' => $post['title']))) {
					setPageMsg('表名重复!', 'error');
					$flag = FALSE;
				}

				if($flag) {
					$tableName = $this->modeldbprefix.$post['title'];
					$fields = json_decode($post['fields']);
					$fieldsFormat = array();
					foreach($fields as $row) {
						if((!$row->name) || (!$row->type)) {
							setPageMsg('字段未填写完整!', 'error');
							$flag = FALSE;
							break;
						}

						$fieldType = '';
						$fieldConstraint = 0;
						if(preg_match('/\b(([a-z]{3,})|([A-Z]{3,}))\({0,}[\d]{0,}\){0,}$/', $row->type)) {
							preg_match_all('/\b(([a-z]{3,})|([A-Z]{3,}))/', $row->type, $result);
							$fieldType = $result[0][0];

							preg_match_all('/\d{1,}/', $row->type, $result);
							if(count($result[0])) {
								$fieldConstraint = $result[0][0];
							}
						} else {
							setPageMsg('字段类型格式错误!', 'error');
							$flag = FALSE;
							break;
						}

						$fieldsFormat[$row->name] = array(
							'type' => $fieldType,
							'unsigned' => $row->unsigned ? TRUE : FALSE,
							'null' => $row->notnull ?  FALSE : TRUE,
							'unique' => $row->unique ? TRUE : FALSE,
							'auto_increment' => $row->auto_increment ? TRUE : FALSE,
							'comment' => $row->desc
						);
						if($fieldConstraint > 0) {
							$fieldsFormat[$row->name]['constraint'] = $fieldConstraint;
						}
						if($row->value !== '') {
							$fieldsFormat[$row->name]['default'] = $row->value;
						}
					}
				}

				if($flag) {

					$this->load->dbforge();
					$this->dbforge->add_field($fieldsFormat);
					$this->dbforge->add_key('id', TRUE);
					$this->dbforge->create_table($tableName, FALSE, array('ENGINE' => 'InnoDB','DEFAULT CHARSET' => 'utf8','COMMENT' => '\''.$post['desc'].'\''));

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
			$post = $this->input->post(array('title','desc','fields'));

			$this->form_validation->reset_validation();
			if($this->form_validation->run() !== FALSE) {
				$flag = TRUE;

				$existData = $this->model->get(array('title' => $post['title']));
				if($existData && $existData['id'] != $id) {
					setPageMsg('表名重复!', 'error');
					$flag = FALSE;
				}

				//处理字段
				if($flag) {
					$oldTable = $this->model->get(array('id' => $id));
					$oldFields = json_decode($oldTable['fields'], TRUE);

					$newFields = json_decode($post['fields'], TRUE);


					$modifyFields = array();
					$addFields = array();
					$delFields = array(); //一维数组，删除字段数组只有字段名称

					$modifyIndex = array();
					$addIndex = array();
					$delIndex = array();
					$equalIndex = array();

					$isFieldError = FALSE;

					//找出修改和删除的字段
					foreach ($oldFields as $oldItem) {
						if($isFieldError) {
							break;
						}
						$delFlag = TRUE;
						foreach ($newFields as $newItem) {
							if($oldItem['_rowIndex'] == $newItem['_rowIndex']) { //交集
								if($oldItem['name'] == $newItem['name']
									&& $oldItem['type'] == $newItem['type']
									&& $oldItem['value'] == $newItem['value']
									&& $oldItem['desc'] == $newItem['desc']
									&& $oldItem['primary'] == $newItem['primary']
									&& $oldItem['auto_increment'] == $newItem['auto_increment']
									&& $oldItem['unsigned'] == $newItem['unsigned']
									&& $oldItem['notnull'] == $newItem['notnull']
									&& $oldItem['unique'] == $newItem['unique'] ) {
										//完全一样的字段不用动
										$equalIndex[] = $newItem['_rowIndex'];
								} else {
									if((!$newItem['name']) || (!$newItem['type'])) {
										$isFieldError = TRUE;
										break;
									}
									//要修改的字段
									$fieldType = '';
									$fieldConstraint = 0;
									if(preg_match('/\b(([a-z]{3,})|([A-Z]{3,}))\({0,}[\d]{0,}\){0,}$/', $newItem['type'])) {
										preg_match_all('/\b(([a-z]{3,})|([A-Z]{3,}))/', $newItem['type'], $result);
										$fieldType = $result[0][0];

										preg_match_all('/\d{1,}/', $newItem['type'], $result);
										if(count($result[0])) {
											$fieldConstraint = $result[0][0];
										}
									} else {
										$isFieldError = TRUE;
										break;
									}
									$modifyFields[$oldItem['name']] = array(
										'name' => $newItem['name'],
										'type' => $fieldType,
										'comment' => $newItem['desc'],
										'auto_increment' => $newItem['auto_increment'] ? TRUE : FALSE,
										'unsigned' => $newItem['unsigned'] ? TRUE : FALSE,
										'null' => $newItem['notnull'] ? FALSE : TRUE,
										'unique' => $newItem['unique'] ? TRUE : FALSE
									);
									if($fieldConstraint > 0) {
										$modifyFields[$oldItem['name']]['constraint'] = $fieldConstraint;
									}
									if($newItem['value'] !== '') {
										$modifyFields[$oldItem['name']]['default'] = $newItem['value'];
									}
									$modifyIndex[] = $newItem['_rowIndex'];
								}
								$delFlag = FALSE;
								break;
							}
						}
						if($delFlag) {
							//删除$newFields没有的字段
							$delFields[] = $oldItem['name'];
							$delIndex[] = $oldItem['_rowIndex'];
						}
					}

					//找出新增字段
					foreach ($newFields as $newItem) {
						if($isFieldError) {
							break;
						}
						$addFlag = TRUE;
						foreach ($oldFields as $oldItem) {
							if($oldItem['_rowIndex'] == $newItem['_rowIndex']) {
								$addFlag = FALSE;
								break;
							}
						}
						if($addFlag) {
							if((!$newItem['name']) || (!$newItem['type'])) {
								$isFieldError = TRUE;
								break;
							}
							//添加$oldFields没有的字段
							$fieldType = '';
							$fieldConstraint = 0;
							if(preg_match('/\b(([a-z]{3,})|([A-Z]{3,}))\({0,}[\d]{0,}\){0,}$/', $newItem['type'])) {
								preg_match_all('/\b(([a-z]{3,})|([A-Z]{3,}))/', $newItem['type'], $result);
								$fieldType = $result[0][0];

								preg_match_all('/\d{1,}/', $newItem['type'], $result);
								if(count($result[0])) {
									$fieldConstraint = $result[0][0];
								}
							} else {
								$isFieldError = TRUE;
								break;
							}
							$addFields[$newItem['name']] = array(
								'type' => $fieldType,
								'comment' => $newItem['desc'],
								'auto_increment' => $newItem['auto_increment'] ? TRUE : FALSE,
								'unsigned' => $newItem['unsigned'] ? TRUE : FALSE,
								'null' => $newItem['notnull'] ? FALSE : TRUE,
								'unique' => $newItem['unique'] ? TRUE : FALSE
							);
							if($fieldConstraint > 0) {
								$addFields[$newItem['name']]['constraint'] = $fieldConstraint;
							}
							if($newItem['value'] !== '') {
								$addFields[$newItem['name']]['default'] = $newItem['value'];
							}
							$addIndex[] = $newItem['_rowIndex'];
						}
					}

					if($isFieldError) {
						setPageMsg('字段未填写完整!', 'error');
						$flag = FALSE;
					}
				}

				if($flag) {

					$oldTableName = $this->modeldbprefix.$oldTable['title'];
					$tableName = $this->modeldbprefix.$post['title'];

					$this->load->dbforge();

					//重命名表
					if($oldTableName !== $tableName) {
						$this->dbforge->rename_table($oldTableName, $tableName);
					}

					//先删除字段，防止新增字段和删除字段同名
					foreach($delFields as $fieldName) {
						if($this->model->isExistField($fieldName, $tableName)) {
							$this->dbforge->drop_column($tableName, $fieldName);
						}
					}
					if(count($modifyFields)) {
						$this->dbforge->modify_column($tableName, $modifyFields);
					}
					if(count($addFields)) {
						$this->dbforge->add_column($tableName, $addFields);
					}

					//重新定义字段的rowIndex
					foreach ($newFields as $index => $item) {
						$newFields[$index]['_rowIndex'] = $index;
					}
					$post['fields'] = json_encode($newFields);

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






	public function modalList() {

		$this->_data['index_filter'] = array(
			array(
				'pattern' => 'like', //where,like
				'label' => '表名',
				'name' => 'title',
				'value' => '',
				//'operator' => '='
			)
		);

		$this->_data['index_tableField'] = array(
			array(
				'text' => '表名',
				'field' => 'title',
				'width' => '150'
			),
			array(
				'text' => '描述',
				'field' => 'desc',
				'minWidth' => '200'
			)
		);

		$this->_disposePager();
		$this->_disposeFilter();
		$this->_disposeTable();

		$this->load->viewEx();
	}


	public function modalFieldList($id = 0) {
		if($id === 0) {
			return FALSE;
		}
		$tableInfo = $this->model->get(array('id' => $id));
		$recordingFields = json_decode($tableInfo['fields'], TRUE);
		//print_r($recordingFields);
		$fields = array();
		foreach($recordingFields as $field) {
			$fields[] = array(
				'title' => $field['name'],
				'desc' => $field['desc']
			);

		}
		$this->_data['index_tableField'] = array(
			array(
				'type' => 'checkbox',
				'fixed' => 'left'
			),
			array(
				'title' => '字段',
				'field' => 'title',
				'width' => '200'
			),
			array(
				'title' => '描述',
				'field' => 'desc',
				'minWidth' => '200'
			)
		);

		$this->_data['index_list'] = $fields;

		$this->load->viewEx();
	}


}
