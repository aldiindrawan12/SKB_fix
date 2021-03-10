<?php
// error_reporting(0);
class Model_Form extends CI_model
{
    public function getcustomerbyname($customer_name){
        return $this->db->get_where("skb_customer",array("customer_name"=>str_replace("%20"," ",$customer_name)))->row_array();
    }

    public function getbonbysupir($supir_id){
        return $this->db->get_where("skb_supir",array("supir_id"=>$supir_id))->row_array();
    }

    public function getakunbyid($akun_id){
        $this->db->join("user", "user.akun_id = skb_akun.akun_id", 'left');
        return $this->db->get_where("skb_akun",array("skb_akun.akun_id"=>$akun_id))->row_array();
    }

    public function getjoid(){
        $this->db->select("Jo_id");
        return $this->db->get("skb_job_order")->result_array();
    }

    public function getbonid(){
        $this->db->select("bon_id");
        return $this->db->get("skb_bon")->result_array();
    }

    public function insert_JO($data){
        $this->db->set("status_jalan","Jalan");
        $this->db->where("supir_id",$data["supir_id"]);
        $this->db->update("skb_supir");

        $this->db->set("status_jalan","Jalan");
        $this->db->where("mobil_no",$data["mobil_no"]);
        $this->db->update("skb_mobil");

        return $this->db->insert("skb_job_order", $data);
    }

    public function insert_bon($data){
        $supir=$this->db->get_where("skb_supir",array("supir_id"=>$data["supir_id"]))->row_array();
        if($data["bon_jenis"]=="Pengajuan"){
            $bon_now = $supir["supir_kasbon"]+$data["bon_nominal"];
        }else{
            $bon_now = $supir["supir_kasbon"]-$data["bon_nominal"];
        }
        $this->db->set("supir_kasbon",$bon_now);
        $this->db->where("supir_id",$data["supir_id"]);
        $this->db->update("skb_supir");

        return $this->db->insert("skb_bon", $data);
    }

    public function insert_akun($data){
        return $this->db->insert("skb_akun", $data);
    }

    public function insert_user($data){
        return $this->db->insert("user", $data);
    }

    public function getakunbyname($akun_name){
        return $this->db->get_where("skb_akun",array("akun_name"=>$akun_name))->row_array();
    }

    public function insert_customer($data){
        return $this->db->insert("skb_customer", $data);
    }

    public function insert_customerMenu($data){
        return $this->db->insert("skb_customer", $data);
    }

    public function insert_supir($data){
        return $this->db->insert("skb_supir", $data);
    }

    public function insert_satuan($data){
        return $this->db->insert("skb_satuan", $data);
    }

    public function deletesupir($supir_id){
        $this->db->set("status_hapus","YES");
        $this->db->where("supir_id",$supir_id);
        return $this->db->update("skb_supir");
    }

    public function deletetruck($mobil_no){
        $this->db->set("status_hapus","YES");
        $this->db->where("mobil_no",$mobil_no);
        return $this->db->update("skb_mobil");
    }

    public function deletesatuan($satuan_id){
        $this->db->where("satuan_id",$satuan_id);
        return $this->db->delete("skb_satuan");
    }

    public function deleteakun($akun_id){
        $this->db->where("akun_id",$akun_id);
        return $this->db->delete("skb_akun");
    }

    public function getsupirname($supir_id){
        return $this->db->get_where("skb_supir",array("supir_id"=>$supir_id))->row_array();
    }

    public function update_supir($supir_id,$supir_name){
        $this->db->set("supir_name",$supir_name);
        $this->db->where("supir_id",$supir_id);
        $this->db->update("skb_supir");
    }

    public function update_akun($data){
        $user = $this->db->get_where("user",array("akun_id"=>$data["akun_id"]))->row_array();
        if($user){
            $this->db->set("username",$data["username"]);
            $this->db->set("password",$data["password"]);
            $this->db->where("akun_id",$data["akun_id"]);
            $this->db->update("user");
        }else{
            $data_user = array(
                "akun_id"=>$data["akun_id"],
                "username"=>$data["username"],
                "password"=>$data["password"]
            );
            $this->db->insert("user",$data_user);
        }

        $this->db->set("akun_name",$data["akun_name"]);
        $this->db->set("akun_role",$data["akun_role"]);
        $this->db->where("akun_id",$data["akun_id"]);
        $this->db->update("skb_akun");
    }

    public function insert_truck($data){
        return $this->db->insert("skb_mobil", $data);
    }


}