<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-08-27 20:20:52
 * @Last Modified by: Raven
 * @Last Modified time: 2019-09-17 18:09:34
 */


$config = array(
	'image' => array(
		'exts' => 'jpg|png|gif|bmp|jpeg', //文件后缀名
		'accept' => 'images', //文件类型
		'acceptMime' => 'image/*', //选择框文件类型过滤
		'size' => 0, //文件最大尺寸(KB), 0不限制
		'path' => 'uploads', //上传目录
	),
	'file' => array(
		'exts' => '*', //文件后缀名
		'accept' => 'file', //文件类型
		'acceptMime' => '*/*', //选择框文件类型过滤
		'size' => 0, //文件最大尺寸(KB), 0不限制
		'path' => 'Uploads', //上传目录
	),





);
