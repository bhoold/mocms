<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-11-05 01:47:34
 * @Last Modified by: Raven
 * @Last Modified time: 2019-11-10 01:11:46
 */


class dbtable_model extends CI_Model {

	public function list()
	{
		$sql = 'SHOW TABLE status FROM '.$this->db->database;
		$query = $this->db->query($sql);
		$list = $query->result_array();

		return $list;
	}

	public function create($name, $comment)
	{
		$sql = <<<EOT
		CREATE TABLE `$name` (
			`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			`created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
			`modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='$comment';
		EOT;
		if($query = $this->db->query($sql)) {
			return true;
		} else {
			$this->error = $this->db->error();
			return false;
		}
	}

	public function modifyComment($name, $comment)
	{

		$sql = 'ALTER TABLE '.$name.' COMMENT = \''.$comment.'\'';
		if($query = $this->db->query($sql)) {
			return true;
		} else {
			$this->error = $this->db->error();
			return false;
		}
	}

	public function update($name, $data)
	{

		$sql = 'ALTER TABLE '.$name.' COMMENT = \''.$data['comment'].'\', RENAME TO '.$data['name'];
		if($query = $this->db->query($sql)) {
			return true;
		} else {
			$this->error = $this->db->error();
			return false;
		}
	}

	public function get($name)
	{
		$sql = 'SHOW TABLE status FROM '.$this->db->database.' where Name=\''.$name.'\'';
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function delete($names)
	{
		$idsStr = '';
		if(is_array($names)) {
			$idsStr = implode(',', $names);
		} else {
			$idsStr = $names;
		}

		$sql = 'DROP TABLE '.$idsStr;
		$bool = $this->db->query($sql);
		if(!$bool) {
			$this->error = $this->db->error();
		}
		return $bool;
	}

	public function isExist($name)
	{
		$sql = 'SHOW TABLE status FROM '.$this->db->database.' where Name=\''.$name.'\'';
		$query = $this->db->query($sql);
		return count($query->result_array()) > 0;
	}
}
