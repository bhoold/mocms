<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-08-02 23:56:15
 * @Last Modified by: Raven
 * @Last Modified time: 2019-11-05 02:13:16
 */


/**
 * 后台基础模型
 */
class MY_Model extends CI_Model {

	protected $_dbprefix = '';

	protected $_table;

	public function __construct()
	{
		parent::__construct();

		if(!$this->_table) {
			$this->_table = $this->_dbprefix.$this->router->class;
		}
	}

	/*
	public function __call($method, $arguments)
	{
		if (!method_exists( $this, $method) )
		{
			throw new Exception('模型类的方法 '. $method.'() 不存在');
		}
		//return call_user_func_array( [$this, $method], $arguments);
	}*/


	/**
	 * 列表
	 *
	 * @param array $filter		查询条件
	 * @param number $num		当前页数
	 * @param number $size		每页数量
	 * @return array
	 */
	public function list($filter, $num = 1, $size = 0, $sort = 'id DESC') {
		$this->db->reset_query();

		foreach($filter as $key => $value) {
			if($key == 'where'){
				$this->db->where($value);
			}elseif($key == 'like'){
				$this->db->like($value);
			}elseif($key == 'where_in'){
				foreach ($value as $keyField => $valueField) {
					$this->db->where_in($keyField, $valueField);
				}
			}
		}

		$this->db->from($this->_table);
		$count = $this->db->count_all_results('', false);

		$this->db->select('*');
		$this->db->order_by($sort);
		if($size !== 0) {
			$this->db->limit($size, ($num-1)*$size);//从0开始要减1
		}

		$query = $this->db->get();

		//echo $this->db->last_query();

		return array(
			'list' => $query->result_array(),
			'count' => $count
		);
	}


	/**
	 * 获取单个记录
	 *
	 * @param array $data
	 * @return array
	 */
	public function get($data)
	{
		$query = $this->db->get_where($this->_table, $data);
		return $query->row_array();
	}


	/**
	 * 添加单个记录
	 *
	 * @param array $data
	 * @return bool
	 */
	public function insert($data)
	{
		$id = 0;
		if($this->db->insert($this->_table, $data)){
			$id = $this->db->insert_id();
		}
		return $id;
		//$this->db->insert_batch()
		//$this->db->affected_rows();
	}


	/**
	 * 更新单个记录
	 *
	 * @param array $where
	 * @param array $data
	 * @return number
	 */
	public function update($where, $data)
	{
		$id = 0;
		if($this->db->update($this->_table, $data, $where)){
			$query = $this->db->get_where($this->_table, $where);
			$row = $query->row_array();
			$id = $row['id'];
		}
		return $id;
		//$this->db->affected_rows();
	}


	/**
	 * 删除记录
	 *
	 * @param string|array $ids
	 * @return bool
	 */
	public function delete($ids)
	{
		$idsStr = '';
		if(is_array($ids)) {
			$idsStr = implode(',', $ids);
		} else {
			$idsStr = $ids;
		}

		if(strpos($idsStr, ',')){ //多个id
			$this->db->where_in('id', explode(',', $idsStr));
		}else{
			$this->db->where('id', $idsStr);
		}
		return $this->db->delete($this->_table);
		//$this->db->affected_rows();
	}


	/**
	 * 修改字段值
	 *
	 * @param string $idsStr
	 * @param array $data
	 * @return bool
	 */
	public function setField($idsStr, $data)
	{
		if(strpos($idsStr, ',')){ //多个id
			$this->db->where_in('id', explode(',', $idsStr));
		}else{
			$this->db->where('id', $idsStr);
		}
		return $this->db->update($this->_table, $data);
		//$this->db->affected_rows();
	}


	/**
	 * 是否有重复记录
	 *
	 * @param array $data
	 * @return bool
	 */
	public function checkExist($data)
	{

		if (empty($data))
		{
			return FALSE;
		}

		return $this->db->where($data)
						->limit(1)
						->count_all_results($this->_table) > 0;
	}


	public function getFields()
	{
		//return $fields = $this->db->field_data($this->_table);
		return $fields = $this->db->list_fields($this->_table);
	}

}
