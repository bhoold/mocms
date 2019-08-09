<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-08-02 23:52:48
 * @Last Modified by: Raven
 * @Last Modified time: 2019-08-07 02:44:51
 */


/**
 * 后台基础控制器
 */
class MY_Controller extends CI_Controller {

	/**
	 * 列表实际过滤条件
	 *
	 * @var array
	 */
	protected $_indexFilterQuery = array();

	/**
	 * 视图数据
	 *
	 * @var array
	 */
	protected $_data = array( //视图数据
		'page_title' => '', //当前模块菜单名称
		'page_message' => '', //页面消息

		'tooles_btns' => array(
			'left' => array(),
			'right' => array()
		),

		'index_leftMenu' => array(), //左侧菜单

		'index_filter' => array(), //列表过滤器数据
		'index_list' => array(), //列表页列表数据
		'index_pager' => array(
			'count' => 0,
			'pageNum' => 1,
			'pageSize' => 10
		),

		'edit_hideForm' => FALSE, //是否隐藏编辑表单
		'edit_formData' => array() //编辑数据
	);

	public function __construct() {
		parent::__construct();

		$this->load->database();
		$this->load->library(['ion_auth', 'form_validation']);

		$this->load->helper(['url', 'language']);
		$this->load->helper(['util']);

		if (!$this->ion_auth->logged_in())
		{
			redirectEx('/auth/login', 'location');
		}

		if(file_exists(APPPATH.'models'.DIRECTORY_SEPARATOR.$this->router->class.'_model.php')) {
			$this->load->model($this->router->class.'_model', 'model');
		}

		$this->_data['page_title'] = $this->router->class.'：'.$this->router->method;
	}

	/**
	 * 返回视图数据
	 *
	 * @return void
	 */
	public function getDisplayData() {
		return $this->_data;
	}

	/**
	 * 默认页面
	 *
	 * @return void
	 */
	public function index() {
		/*
		func_get_args
		func_num_args
		//echo $this->db->last_query();
		*/
		return $this->list(); //index只做引导
	}

	/**
	 * 列表页面
	 *
	 * @return void
	 */
	public function list() {

		$this->_disposeListAction();
		$this->_disposePager();
		$this->_disposeFilter();
		$this->_disposeTable();
		$this->_disposeMessage();

		$this->load->viewEx();
	}

	/**
	 * 添加页面
	 *
	 * @return void
	 */
	public function add() {
		if($this->input->method() == 'post'){
			$this->_disposeAddData();
		}

		$this->_disposeMessage();

		$this->load->viewEx();
	}

	/**
	 * 修改页面
	 *
	 * @param integer $id
	 * @return void
	 */
	public function edit($id = 0) {
		if($id) {
			if($rowData = $this->model->get(array('id' => $id))) {
				$this->_data['edit_formData'] = $rowData;
				if($this->input->method() == 'post') {
					$this->_disposeEditData($id);
				}
			} else {
				setPageMsg('数据不存在!', 'error');
			}
		} else {
			setPageMsg('数据不存在!', 'error');
			$this->_data['edit_hideForm'] = TRUE;
		}

		$this->_disposeMessage();

		$this->load->viewEx();
	}

	/**
	 * 处理列表页面按钮动作
	 *
	 * @return void
	 */
	protected function _disposeListAction() {
		$formAction = $this->input->get('_action');
		if($formAction){
			$gets = $this->input->get();
			switch($formAction){
				case 'delete':
					if($delIds = $this->input->get('_action_id')){
						$this->_delete($delIds);
						unset($gets['_action_id']);
					}
					break;
			}
			unset($gets['_action']);
			if(empty($gets)){
				redirectEx('index', 'location');
			}else{
				redirectEx('index?'.http_build_query($gets), 'location');
			}
		}
	}

	/**
	 * 处理列表页面分页
	 *
	 * @return void
	 */
	protected function _disposePager() {
		$pageNum = $this->input->get('pageNum');
		$pageSize = $this->input->get('pageSize');

		if($pageNum > 0) {
			$this->_data['index_pager']['pageNum'] = $pageNum;
		}
		if($pageSize > 0) {
			 $this->_data['index_pager']['pageSize'] = $pageSize;
		}
	}

	/**
	 * 处理列表页面查询条件
	 *
	 * @return void
	 */
	protected function _disposeFilter() {
		$query = array();
		foreach($this->_data['index_filter'] as &$item) {
			$value = $this->input->get('filter['.$item['name'].']');
			$item['value'] = $value;
			if(!(trim($value) === '' || $value === null)) {
				if(!isset($query[$item['pattern']])) {
					$query[$item['pattern']] = array();
				}
				if(isset($item['operator'])) {
					$query[$item['pattern']][$item['name'].' '.$item['operator']] = $value;
				} else {
					$query[$item['pattern']][$item['name']] = $value;
				}

			}
		}
		$this->_indexFilterQuery = $query;
	}

	/**
	 * 处理列表页面表格
	 *
	 * @return void
	 */
	protected function _disposeTable() {
		$result = $this->model->list($this->_indexFilterQuery, $this->_data['index_pager']['pageNum'], $this->_data['index_pager']['pageSize']);

		$this->_data['index_list'] = $result['list'];
		$this->_data['index_pager']['count'] = $result['count'];
	}

	/**
	 * 处理页面提示信息
	 *
	 * @return void
	 */
	protected function _disposeMessage() {
		$this->_data['page_message'] = getPageMsg();
	}

	/**
	 * 列表页面删除记录
	 *
	 * @param string $idsStr
	 * @return void
	 */
	protected function _delete($idsStr) {
		if($this->model->delete($idsStr)){
			setPageMsg('ID:' . $idsStr . ' ' . '删除成功!', 'success');
		}else{
			setPageMsg('ID:' . $idsStr . ' ' . '删除失败!', 'error');
		}
	}

	/**
	 * 列表页面修改字段
	 *
	 * @param string $idsStr
	 * @param array $data //要修改的字段和值
	 * @return void
	 */
	protected function _modifyField($idsStr, $data) {
	}


	/**
	 * 新增和编辑页面成功后跳转
	 *
	 * @param integer $id
	 * @return void
	 */
	protected function _forward($id = 0) {
		$follow_action = $this->input->post('_follow-action');
		if($follow_action === 'save_new') {
			redirectEx('add', 'location');
		} elseif($follow_action === 'save_close') {
			redirectEx('index', 'location');
		} elseif($id) {
			redirectEx('edit/'.$id, 'location');
		}
	}

	/**
	 * 处理添加页面的表单数据
	 *
	 * @return void
	 */
	protected function _disposeAddData() {
	}

	/**
	 * 处理编辑页面的表单数据
	 *
	 * @param integer $id
	 * @return void
	 */
	protected function _disposeEditData($id) {
	}
}
