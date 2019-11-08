<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 后台Loader
 */
class MY_Loader extends CI_Loader {

	public function __construct()
	{
		parent::__construct();



	}


	/**
	 * 重载view方法
	 */
	public function viewEx($view = '', $vars = array(), $return = FALSE)
	{
		/**
		 * $view = '/test'; 以/开头则只去掉第一个/
		 * $view = 'test'; 没有/开头则前面加上控制器名称
		 */
		$CI =& get_instance();
		if($view) {
			if(DIRECTORY_SEPARATOR !== '/') {
				$view = str_replace('/', DIRECTORY_SEPARATOR, $view);
			}
			if(strpos($view, DIRECTORY_SEPARATOR) === 0) {//以/开头
				$view = substr($view, 1);
			} else {
				$view = lcfirst($CI->router->class).DIRECTORY_SEPARATOR.$view;
			}
		} else {
			$view = lcfirst($CI->router->class).DIRECTORY_SEPARATOR.$CI->router->method;
		}

		if(!$vars) {
			$vars = $CI->getData();
		}

		parent::view($view, $vars, $return);
	}


	/**
	 * 重载model方法
	 */
	public function modelEx($model, $name = '', $db_conn = FALSE)
	{
		if(is_string($model) && $name === '') {
			$model = lcfirst($model);
		}

		parent::model($model, $name, $db_conn);
	}


}
