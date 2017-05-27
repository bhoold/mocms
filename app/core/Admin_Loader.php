<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Loader extends CI_Loader {
    public function __construct()
    {
        parent::__construct();
        //echo APPPATH.'../assets/dist/';
        $this->_ci_view_paths = array(APPPATH.'../assets/dist/' => 1);
        //print_r($this->_ci_view_paths);
    }
}
