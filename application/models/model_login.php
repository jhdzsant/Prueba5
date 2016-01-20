<?php
/**
 * Created by PhpStorm.
 * User: manegow
 * Date: 1/19/16
 * Time: 10:56 AM
 */

class Login_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function loginUser($userID,$password){
        $this->db->where("userID", $userID);
        $this->db->where("password", $password);
        $query = $this->db->get("Usuarios");
        if($query->num_rows() == 1){
            return true;
        }else{
            return false;
        }
    }
}