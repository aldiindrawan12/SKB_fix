<?php
// error_reporting(0);
class Model_Login extends CI_model
{
    public function getuserbyusername($username){
        $this->db->join("skb_akun","skb_akun.akun_id=user.akun_id",'left');
        return $this->db->get_where("user",array("username"=>$username))->row_array();
    }

    public function getakunbyid($akun_id){
        return $this->db->get_where("skb_akun",array("akun_id"=>$akun_id))->row_array();
    }

}