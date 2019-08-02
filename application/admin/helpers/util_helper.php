<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-07-30 01:37:31
 * @Last Modified by: Raven
 * @Last Modified time: 2019-08-01 23:21:49
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
		return 22;
		$CI =& get_instance();
		$currentUser = $CI->getCurrentUser();
		if($field){
			return $currentUser[$field];
		}else{
			return $currentUser;
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
