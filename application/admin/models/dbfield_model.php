<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-11-05 01:47:34
 * @Last Modified by: Raven
 * @Last Modified time: 2019-11-10 01:11:46
 */


class dbfield_model extends CI_Model {

	public function list($tableName)
	{

		$sql = 'SHOW COLUMNS FROM '.$tableName;
		$query = $this->db->query($sql);
		$list = $query->result_array();
		return $list;

	}

	public function create($tableName, $data)
	{

		$length = '';
		if($data['length']) {
			$length = '('.$data['length'].')';
		}
		$sqlStart = <<<EOT
		ALTER TABLE `$tableName`
		ADD COLUMN `{$data['name']}` {$data['type']}{$length}
		EOT;

		if($data['value']) {
			$sqlEnd .= ' DEFAULT '.$data['value'].' COMMENT \''.$data['comment'].'\'';
		} else {
			$sqlEnd .= ' COMMENT \''.$data['comment'].'\'';
		}

		if($data['other']) {
			if($data['other']['nn']) {
				$sqlStart .= ' NOT NULL';
			}
			if($data['other']['uq']) {
				$sqlStart .= ' NOT NULL';
			}



			if($data['other']['pk']) {
				if(!$query = $this->db->query('SHOW KEYS FROM '.$tableName.' where Key_name = \'PRIMARY\';')) {
					$this->error = $this->db->error();
					return false;
				}

				$keys = array();
				foreach ($query->result_array() as $row) {
					$keys[] = $row['Key_name'];
				}

				$keys[] = $data['other']['pk'];
				foreach ($keys as $index => $key) {
					if($index === 0) {
						$sql .= ', DROP PRIMARY KEY, ADD PRIMARY KEY (';
					}
					$sql .= '`'.$key.'`,';
					if(count($keys) === $index + 1) {
						$sql = rtrim($sql, ',');
						$sql .= ')';
					}
				}
			}

			if($data['other']['uq']) {
				$sqlStart .= ' NOT NULL';
			}

		}

		$sql .= ';';

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

	public function isExist($tableName, $name)
	{
		return $this->db->field_exists($name, $tableName);
	}

	public function isExistTable($name)
	{
		$sql = 'SHOW TABLE status FROM '.$this->db->database.' where Name=\''.$name.'\'';
		$query = $this->db->query($sql);
		return count($query->result_array()) > 0;
	}
}
