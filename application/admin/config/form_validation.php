<?php

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
		),

	),
);
