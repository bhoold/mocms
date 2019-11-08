<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-08-02 23:52:48
 * @Last Modified by: Raven
 * @Last Modified time: 2019-11-05 03:31:17
 */


/**
 * 后台基础控制器
 */
class MY_Controller extends CI_Controller {

	public $_model = NULL;

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
		'page_menu' => '', //头部菜单
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

	/**
	 * ajax数据
	 *
	 * @var array
	 */
	protected $_ajaxData = array(
		'code' => 0, //0失败, 1成功, -1未登录
		'msg' => '',
		'data' => array()
	);

	public function __construct() {
		parent::__construct();

		$this->load->database();
		$this->load->library(['ion_auth', 'form_validation']);

		$this->load->helper(['url', 'language']);
		$this->load->helper(['util']);

		if (!$this->ion_auth->logged_in())
		{
			if($this->input->is_ajax_request()) {
				$this->_ajaxData['code'] = AJAX_FAIL;
				$this->_ajaxData['msg'] = '未登录';
				echo json_encode($this->_ajaxData);
			} else {
				redirectEx('/auth/login?redirect='.current_url(), 'location');
			}
			exit;
		}

		//当前模块的模型
		if(file_exists(APPPATH.'models'.DIRECTORY_SEPARATOR.$this->router->class.'_model.php')) {
			if($this->_model) {
				$this->load->model($this->router->class.'_model');
			} else {
				$this->load->model($this->router->class.'_model', '_model');
			}
		}

		//上传配置
		$this->config->load('app'.DIRECTORY_SEPARATOR.'upload', TRUE);

		//菜单配置
		$this->config->load('app'.DIRECTORY_SEPARATOR.'menu', TRUE);
		$menu = $this->config->item('app'.DIRECTORY_SEPARATOR.'menu');

		//公共配置
		$this->config->load('app'.DIRECTORY_SEPARATOR.'common', TRUE);
		$common = $this->config->item('app'.DIRECTORY_SEPARATOR.'common');

		//当前模块配置
		$config = array();
		if($this->config->load('app'.DIRECTORY_SEPARATOR.'module'.DIRECTORY_SEPARATOR.$this->router->class.'_'.$this->router->method, TRUE, TRUE)) {
			$config = $this->config->item('app'.DIRECTORY_SEPARATOR.'module'.DIRECTORY_SEPARATOR.$this->router->class.'_'.$this->router->method);
		}

		foreach ($common as $key => $value) {
			if($key === 'page_template') {
				if(isset($config[$key])) {
					$this->_data[$key] = $config[$key];
				} else {
					$this->_data[$key] = $value;
					//$this->_data[$key] = $this->router->class.DIRECTORY_SEPARATOR.$this->router->method;
				}
			} else if($key === 'page_menu') {
				if(isset($config[$key])) {
					$this->_data[$key] = $config[$key];
				} else {
					$this->_data[$key] = $menu;
				}
			} else if($key === 'page_title') {
				if(isset($config[$key])) {
					$this->_data[$key] = $config[$key];
				} else {
					$this->_data[$key] = getMenuName($this->router->class.'/'.$this->router->method);
				}
			} else if($key === 'index_pager') {
				if(isset($config[$key])) {
					$this->_data[$key] = $config[$key];
				} else {
					$this->_data[$key] = $value;
				}
			} else if(isset($config[$key])) {
				if(is_array($common[$key]) && is_array($config[$key])) {
					$this->_data[$key] = array_merge($common[$key], $config[$key]);
				} else {
					$this->_data[$key] = $config[$key];
				}
			} else {
				$this->_data[$key] = $value;
			}
		}
	}

	/**
	 * 返回视图数据
	 *
	 * @return void
	 */
	public function getData() {
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

		$this->_data['tooles_btns'] = $this->_data['index_tooles_btns'];
		$this->_disposeListAction();
		$this->_disposePager();
		$this->_disposeFilter();
		$this->_disposeTable();
		$this->_disposeMessage();

		$this->load->viewEx($this->_data['page_template']);
	}

	/**
	 * 添加页面
	 *
	 * @return void
	 */
	public function add() {
		$this->_data['tooles_btns'] = $this->_data['edit_tooles_btns'];

		if($this->input->method() == 'post'){
			$this->_disposeAddData();
		}

		$this->_disposeMessage();

		$this->load->viewEx($this->_data['page_template']);
	}

	/**
	 * 修改页面
	 *
	 * @param integer $id
	 * @return void
	 */
	public function edit($id = 0) {
		$this->_data['tooles_btns'] = $this->_data['edit_tooles_btns'];

		if($id) {
			if($rowData = $this->_model->get(array('id' => $id))) {
				$this->_data['edit_formData'] = $rowData;
				if($this->input->method() == 'post') {
					$this->_disposeEditData($id);
				}
			} else {
				setPageMsg('数据不存在!', 'error');
				$this->_data['edit_hideForm'] = TRUE;
			}
		} else {
			setPageMsg('数据不存在!', 'error');
			$this->_data['edit_hideForm'] = TRUE;
		}

		$this->_disposeMessage();

		$this->load->viewEx($this->_data['page_template']);
	}

	public function setup() {
		$this->load->model('config_model');

		$filter = array(
			'where' => array('type' => 'global')
		);
		$globalResult = $this->config_model->list($filter);

		$filter = array(
			'where' => array('type' => $this->router->class.'_'.$this->router->method)
		);
		$currentResult = $this->config_model->list($filter);

		$this->_disposeMessage();

		$this->load->viewEx('/config/index');
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
			switch($formAction){ //定义所有操作
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
		if($this->_data['index_pager']){
			$pageNum = $this->input->get('pageNum');
			$pageSize = $this->input->get('pageSize');

			if($pageNum > 0) {
				$this->_data['index_pager']['pageNum'] = $pageNum;
			}
			if($pageSize > 0) {
				 $this->_data['index_pager']['pageSize'] = $pageSize;
			}
		}
	}

	/**
	 * 处理列表页面查询条件
	 *
	 * @return void
	 */
	protected function _disposeFilter() {
		if($this->_data['index_filter']){
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
	}

	/**
	 * 处理列表页面表格
	 *
	 * @return void
	 */
	protected function _disposeTable() {
		if($this->_model && $this->_data['index_field'] !== false && $this->_data['index_pager'] !== false){
			$result = $this->_model->list($this->_indexFilterQuery, $this->_data['index_pager']['pageNum'], $this->_data['index_pager']['pageSize']);

			$this->_data['index_list'] = $result['list'];
			$this->_data['index_pager']['count'] = $result['count'];

			if(count($this->_data['index_field']) == 0) { //如果没定义列表字段将从数据表获取
				if(count($result['list']) == 0) { //从数据表获取
					$fields = $this->_model->getFields();
					foreach ($fields as $field) {
						$this->_data['index_field'][] = array(
							'field' => $field,
							'label' => $field
						);
					}
				} else { //从返回的数据获取
					foreach ($result['list'] as $i => $row) {
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
		if($this->_model->delete($idsStr)){
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
	protected function _disposeAddData($post = array()) {
		if(count($post) == 0) {
			$post = $this->input->post();
		}
		unset($post['_follow-action']);
		$this->_model->insert($post);
	}

	/**
	 * 处理编辑页面的表单数据
	 *
	 * @param integer $id
	 * @return void
	 */
	protected function _disposeEditData($id) {
		$post = $this->input->post();
	}
}
