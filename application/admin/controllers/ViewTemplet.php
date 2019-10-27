<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-08-10 14:36:31
 * @Last Modified by: Raven
 * @Last Modified time: 2019-08-11 02:52:49
 */


class ViewTemplet extends MY_Controller {

	public function list() {

		$this->_data['page_title'] = '页面模板：列表';

		$this->_data['tooles_btns'] = array(
			'left' => array(
				array(
					array(
						'text' => '新建',
						'action' => 'add',
						'domClass' => 'layui-btn-primary'
					),
					array(
						'text' => '编辑',
						'action' => 'edit'
					),
					array(
						'text' => '删除',
						'action' => 'del'
					)
				)
			),
			'right' => array(
				array(
					array(
						'text' => '设置',
						'action' => 'setup'
					)
				)
			)
		);

		$this->_data['index_filter'] = array(
			array(
				'pattern' => 'like', //where,like
				'label' => '文件名',
				'name' => 'title',
				'value' => '',
				//'operator' => '='
			)
		);

		$this->_data['index_tableField'] = array(
			array(
				'text' => '文件名',
				'field' => 'title',
				'width' => '200'
			),
			array(
				'text' => '大小',
				'field' => 'size',
				'width' => '150'
			),
			array(
				'text' => '所在目录',
				'field' => 'dir',
				'width' => '100'
			),
			array(
				'text' => '创建时间',
				'field' => 'createtime',
				'width' => '180'
			),
			array(
				'text' => '修改时间',
				'field' => 'modifytime',
				'width' => '180'
			),
			array(
				'text' => '文件MD5',
				'field' => 'md5',
				'width' => '300'
			),

		);

		//todo: 过滤.\..\防止被利用
		$dir = $this->input->get('dir');
		$isRoot = FALSE;
		$isError = FALSE;
		if(!$dir) {
			$path = VIEWPATH;
			$isRoot = TRUE;
		} else {
			$path = VIEWPATH.$dir;
		}
		if(!$isRoot) {
			$path = realpath($path);
			if(strpos($path, VIEWPATH) === FALSE) {
				$isError = TRUE;
			}
		}

		if($isError) {
			setPageMsg('目录错误!', 'error');
		} else {

			function getDirs($path, &$dirList) {
				$list = scandir($path);
				foreach($list as $item) {
					if($item != '.' && $item != '..') {
						//$path = $path.DIRECTORY_SEPARATOR;
						$parentDir = str_replace(VIEWPATH, '', $path);

						if(is_dir($path.DIRECTORY_SEPARATOR.$item)) {
							$newDir = array(
								'title' => $item,
								'href' => current_url().'?dir='.$parentDir.DIRECTORY_SEPARATOR.$item,
								'id' => 2,
								'children' => array()
							);
							getDirs($path.DIRECTORY_SEPARATOR.$item, $newDir['children']);
							$dirList[] = $newDir;
						}
					}
				}
			}
			function getFiles($path, &$fileList) {
				$list = scandir($path);
				foreach($list as $item) {
					if($item != '.' && $item != '..') {
						//$path = $path.DIRECTORY_SEPARATOR;
						$parentDir = str_replace(VIEWPATH, '', $path);

						if(is_dir($path.DIRECTORY_SEPARATOR.$item)) {
						} else {
							$size = filesize($path.DIRECTORY_SEPARATOR.$item);
							$createtime = date("Y/m/d H:i:s", filectime($path.DIRECTORY_SEPARATOR.$item));
							$modifytime = date("Y/m/d H:i:s", filemtime($path.DIRECTORY_SEPARATOR.$item));
							//$md5 = hash_file('md5', $path.$item);
							$md5 = md5_file($path.DIRECTORY_SEPARATOR.$item);
							$fileList[] = array(
								'title' => $item,
								'size' => $size.'bytes',
								'dir' => $parentDir ? DIRECTORY_SEPARATOR.$parentDir : DIRECTORY_SEPARATOR,
								'createtime' => $createtime,
								'modifytime' => $modifytime,
								'md5' => $md5
							);
						}

					}
				}
			}

			$dirList = array();
			$fileList = array();
			getDirs(VIEWPATH, $dirList);
			getFiles($path, $fileList);

			$this->_data['dirList'] = $dirList;

			$this->_data['index_list'] = $fileList;

		}

		$this->_disposeMessage();

		$this->load->viewEx();
	}
}
