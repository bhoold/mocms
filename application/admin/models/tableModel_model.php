<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-08-02 23:52:08
 * @Last Modified by: Raven
 * @Last Modified time: 2019-08-10 12:48:15
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
	 * 判断表是否存在
	 *
	 * @param string $tableName
	 * @return boolean
	 */
	public function isExistTable($tableName)
	{
		return $this->db->table_exists($tableName);
	}

	/**
	 * 返回表字段
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
	public function isExistField($fieldName, $tableName)
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

	/**
	 * 删除一个或多个表
	 *
	 * @param string|array $tableNames
	 * @return boolean
	 */
	public function delTable($tableNames) {
		$names = array();
		if(is_array($tableNames)) {
			$names = $tableNames;
		} else {
			if(strpos($tableNames, ',')) {
				$names = explode(',', $tableNames);
			} else {
				$names[] = $idsStr;
			}
		}

		$successArr = array();
		$failedArr = array();
		$this->load->dbforge();
		foreach($names as $tableName) {
			if($this->dbforge->drop_table($tableName, TRUE)) {
				$successArr[] = $tableName;
			} else {
				$failedArr[] = $tableName;
			}
		}

		return count($successArr) === count($tableNames);
	}
}
