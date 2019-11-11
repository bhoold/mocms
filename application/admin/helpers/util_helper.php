<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-07-30 01:37:31
 * @Last Modified by: Raven
 * @Last Modified time: 2019-10-31 21:20:24
 */



if ( !function_exists('getUrl')) {
	/**
	 * 统一获取url
	 */
	function getUrl($type, $uri = '', $protocol = NULL) {
		switch($type) {

			case 'base':
				return config_item('base_url');
				break;

			case 'index':
				/**
				 * $uri = '/test/test2'; 以/开头第一个是控制器
				 * $uri = 'test'; 没有/开头自动加上当前控制器
				 */
				$CI =& get_instance();
				if($uri){
					if(strpos($uri, '/') !== 0){
						$uri = $CI->router->class.'/'.$uri;
					}
				}
				return site_url($uri, $protocol);
				break;

			case 'ws':
				return config_item('webSocketUrl');
				break;

			case 'flv':
				return config_item('flvUrl');
				break;
			case 'workmanSvr':
				return config_item('workmanServer');
				break;
		}
		return '';
	}
}


if ( ! function_exists('redirectEx'))
{
	/**
	 * 扩展redirect函数
	 */
	function redirectEx($uri = '', $method = 'auto', $code = NULL)
	{
		/**
		 * $uri = '/test/test2'; 以/开头第一个是控制器
		 * $uri = 'test'; 没有/开头自动加上当前控制器
		 */
		$CI =& get_instance();
		if($uri){
			if(strpos($uri, '/') !== 0){
				$uri = $CI->router->class.'/'.$uri;
			}
		}
		redirect($uri, $method, $code);
	}
}


if ( ! function_exists('password'))
{
	/**
	 * 加密密码
	 */
	function password($pass) {
		return md5(substr(md5(trim($pass)), 3, 26));
	}
}


if ( ! function_exists('getCurUser'))
{
	/**
	 * 获取当前登录用户的信息
	 */
	function getCurUser($field = '') {
		$loginInfo = array(
			'identity',
			'username',
			'email',
			'user_id',
			'old_last_login',
			'last_check'
		); //字段

		$CI =& get_instance();
		$loginInfo = $CI->session->userdata;
		if($field) {
			if($loginInfo[$field]) {
				return $loginInfo[$field];
			} else {
				return '';
			}
		} else {
			return $loginInfo;
		}

	}
}


if ( ! function_exists('getLibRds'))
{
	/**
	 * 获取第三方redis实例
	 */
	function getLibRds() {
		$CI =& get_instance();
		$CI->load->library('libRedis');
		return $CI->myredis->instance();
	}
}


if ( ! function_exists('setPageMsg'))
{
	/**
	 * 设置页面消息
	 *
	 * @return void
	 */
	function setPageMsg($msg, $type = 'info') {
		$CI =& get_instance();
		$CI->session->set_flashdata(array(
			'messageType' => $type,
			'message' => $msg
		));
	}

}


if ( ! function_exists('getPageMsg'))
{
	/**
	 * 获取页面消息
	 *
	 * @return void
	 */
	function getPageMsg() {
		$CI =& get_instance();
		$type = $CI->session->flashdata('messageType');
		$message = $CI->session->flashdata('message');
		if($type) {
			return array(
				'type' => $type,
				'message' => $message,
			);
		} else {
			return $message;
		}
	}

}


if ( ! function_exists('getMenuName'))
{
	/**
	 * 根据路径获取菜单名
	 *
	 * @return void
	 */
	function getMenuName($path, $menu = null) {
		if($path[0] == '/') {
			$path = substr($path, 1);
		}
		$name = $path;
		if(!$menu){
			$CI =& get_instance();
			$CI->config->load('app'.DIRECTORY_SEPARATOR.'menu', TRUE);
			$menu = $CI->config->item('app'.DIRECTORY_SEPARATOR.'menu');
		}
		foreach ($menu as $rootMenu) {
			if(isset($rootMenu['link']) && $rootMenu['link'] == '/'.$path) {
				$name = $rootMenu['title'];
			} elseif (isset($rootMenu['child']) && $rootMenu['child']) {
				$name = getMenuName($path, $rootMenu['child']);
			}
			if($name != $path) {
				break;
			}
		}
		if($name == $path) {
			$arr = explode('/', $path);
			if(count($arr) == 2 && $arr[1] == 'index') {
				$name = getMenuName($arr[0], $menu);
				if($name == $arr[0]) {
					$name == $path;
				}
			}
		}
		return $name;
	}

}

