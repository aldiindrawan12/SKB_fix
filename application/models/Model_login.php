<?php
// error_reporting(0);
class Model_Login extends CI_model
{
    public function getuserbyusername($username){
        $this->db->join("skb_akun","skb_akun.akun_id=user.akun_id",left);
        return $this->db->get_where("user",array("username"=>$username))->row_array();
    }

}