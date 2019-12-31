
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-08-27 15:20:22
 * @Last Modified by: Raven
 * @Last Modified time: 2019-08-27 20:04:30
 */

$config = array(
	'menus/add' => array(
		array(
			'field' => 'title',
			'label' => '名称',
			'rules' => 'trim|required',
			'errors' => array('required' => '请输入%s.')
		),

	),
	'menus/edit' => array(
		array(
			'field' => 'title',
			'label' => '名称',
			'rules' => 'trim|required',
			'errors' => array('required' => '请输入%s.')
		),
	),
	'menusItem/add' => array(
		array(
			'field' => 'title',
			'label' => '名称',
			'rules' => 'trim|required',
			'errors' => array('required' => '请输入%s.')
		),
		array(
			'field' => 'parent',
			'label' => '父级',
			'rules' => 'trim|required',
			'errors' => array('required' => '请选择%s.')
		),
	),
	'menusItem/edit' => array(
		array(
			'field' => 'title',
			'label' => '名称',
			'rules' => 'trim|required',
			'errors' => array('required' => '请输入%s.')
		),
		array(
			'field' => 'parent',
			'label' => '父级',
			'rules' => 'trim|required',
			'errors' => array('required' => '请选择%s.')
		),
	),
	'tableModel/add' => array(
		array(
			'field' => 'title',
			'label' => '表名',
			'rules' => 'trim|required',
			'errors' => array('required' => '请输入%s.')
		),
		array(
			'field' => 'fields',
			'label' => '字段',
			'rules' => 'trim|required',
			'errors' => array('required' => '请输入%s.')
		)
	),
	'tableModel/edit' => array(
		array(
			'field' => 'title',
			'label' => '表名',
			'rules' => 'trim|required',
			'errors' => array('required' => '请输入%s.')
		),
		array(
			'field' => 'fields',
			'label' => '字段',
			'rules' => 'trim|required',
			'errors' => array('required' => '请输入%s.')
		)
	),
	'dbtable/add' => array(
		array(
			'field' => 'name',
			'label' => '表名',
			'rules' => 'trim|required',
			'errors' => array('required' => '请输入%s.')
		),
		array(
			'field' => 'comment',
			'label' => '描述',
			'rules' => 'trim|required',
			'errors' => array('required' => '请输入%s.')
		)
	),
	'dbtable/edit' => array(
		array(
			'field' => 'name',
			'label' => '表名',
			'rules' => 'trim|required',
			'errors' => array('required' => '请输入%s.')
		),
		array(
			'field' => 'comment',
			'label' => '描述',
			'rules' => 'trim|required',
			'errors' => array('required' => '请输入%s.')
		)
	),
	'dbfield/add' => array(
		array(
			'field' => 'name',
			'label' => '字段名',
			'rules' => 'trim|required',
			'errors' => array('required' => '请输入%s.')
		),
		array(
			'field' => 'comment',
			'label' => '描述',
			'rules' => 'trim|required',
			'errors' => array('required' => '请输入%s.')
		),
		array(
			'field' => 'type',
			'label' => '类型',
			'rules' => 'trim|required',
			'errors' => array('required' => '请输入%s.')
		)
	),
);
