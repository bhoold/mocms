<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-08-02 23:52:08
 * @Last Modified by: Raven
 * @Last Modified time: 2019-08-10 12:03:39
 */


 /**
  * 菜单模型
  */
class tableModel_model extends MY_Model {

	protected $dbprefix = 'system_';

	public function __construct()
	{
		parent::__construct();

	}

	/**
	 * 获取表字段
	 *
	 * @param string $tableName
	 * @return array //[字段名称...]
	 */
	public function getFields($tableName)
	{
		return $this->db->list_fields($tableName);
	}

	/**
	 * 判断表是否有指定字段
	 *
	 * @param string $fieldName
	 * @param string $tableName
	 * @return boolean
	 */
	public function isExistFields($fieldName, $tableName)
	{
		return $this->db->field_exists($fieldName, $tableName);
	}

	/**
	 * 返回指定表的所有字段信息
	 *
	 * @param string $tableName
	 * @return array //二维数组
	 */
	public function getFieldsData($tableName)
	{
		return $this->db->field_data($tableName);
	}


}
