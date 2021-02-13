<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModels extends CI_Model {
    

    public function login($usr)
    {
        $username = $this->db->escape_str($usr);
        $this->db->where("email",$username)->select("*")->from("tm_users");
        return $this->db->get();
    }

    public function getUser($user_id)
    {
        $this->db->where("user_id", $user_id);
        return $this->db->get("tm_users");
    }
}

?>