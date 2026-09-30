<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator_model extends CI_Model {

    public function check_login($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        return $this->db->get('administrator');
    }
}