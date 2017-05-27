<?php
class Account extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    public function getAccountInfo($username){
        $query = $this->db->get_where('admin', array('username' => $username), 1);
        return $query->result();
    }
    public function verifyAccount($username, $password){
    	$pwd = password_hash($password, PASSWORD_BCRYPT);
    	
    }
    public function addAccount($username, $password, $email, $ip){
    	$pwd = password_hash($password, PASSWORD_BCRYPT);
    	$data = array(
    			'username' => $username,
    			'password' => $pwd,
    			'email' => $email,
    			'regip' => $ip,
    			'lastloginip' => $ip
    	);
    	
    	return $this->db->insert('admin', $data);
    }
}