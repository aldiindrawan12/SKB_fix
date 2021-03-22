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

    public function getrutebyid($rute_id){
        $this->db->join("skb_customer", "skb_customer.customer_id = skb_rute.customer_id", 'left');
        return $this->db->get_where("skb_rute",array("skb_rute.rute_id"=>$rute_id))->row_array();
    }

    public function getjoid(){
        $this->db->select("Jo_id");
        return $this->db->get("skb_job_order")->result_array();
    }

    public function getsupirname($supir_id){
        return $this->db->get_where("skb_supir",array("supir_id"=>$supir_id))->row_array();
    }

    public function getakunbyname($akun_name){
        return $this->db->get_where("skb_akun",array("akun_name"=>$akun_name))->row_array();
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
        }else if($data["bon_jenis"]=="Pembayaran"){
            $bon_now = $supir["supir_kasbon"]-$data["bon_nominal"];
        }else{
            $bon_now = $supir["supir_kasbon"]+$data["bon_nominal"];
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

    public function insert_customer($data){
        return $this->db->insert("skb_customer", $data);
    }

    public function insert_supir($data){
        return $this->db->insert("skb_supir", $data);
    }

    public function insert_rute($data){
        return $this->db->insert("skb_rute", $data);
    }

    public function insert_truck($data){
        return $this->db->insert("skb_mobil", $data);
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

    public function deletecustomer($customer_id){
        $this->db->set("status_hapus","YES");
        $this->db->where("customer_id",$customer_id);
        return $this->db->update("skb_customer");
    }

    public function deleterute($rute_id){
        $this->db->set("rute_status_hapus","YES");
        $this->db->where("rute_id",$rute_id);
        return $this->db->update("skb_rute");
    }

    public function deleteakun($akun_id){
        $this->db->where("akun_id",$akun_id);
        return $this->db->delete("skb_akun");
    }

    public function update_supir($data){
        $this->db->set("supir_name",$data["supir_name"]);
        $this->db->set("supir_alamat",$data["supir_alamat"]);
        $this->db->set("supir_telp",$data["supir_telp"]);
        $this->db->set("supir_ktp",$data["supir_ktp"]);
        $this->db->set("supir_sim",$data["supir_sim"]);
        $this->db->set("supir_keterangan",$data["supir_keterangan"]);
        $this->db->where("supir_id",$data["supir_id"]);
        $this->db->update("skb_supir");
    }

    public function update_rute($data,$rute_id){
        $this->db->where("rute_id",$rute_id);
        $this->db->update("skb_rute",$data);
    }

    public function update_customer($data){
        $this->db->set("customer_name",$data["customer_name"]);
        $this->db->set("customer_alamat",$data["customer_alamat"]);
        $this->db->set("customer_kontak_person",$data["customer_kontak_person"]);
        $this->db->set("customer_telp",$data["customer_telp"]);
        $this->db->set("customer_bank",$data["customer_bank"]);
        $this->db->set("customer_rekening",$data["customer_rekening"]);
        $this->db->set("customer_AN",$data["customer_AN"]);
        $this->db->set("customer_keterangan",$data["customer_keterangan"]);
        $this->db->where("customer_id",$data["customer_id"]);
        $this->db->update("skb_customer");
    }

    public function update_truck($data){
        $this->db->set("mobil_berlaku",$data["mobil_berlaku"]);
        $this->db->set("mobil_pajak",$data["mobil_pajak"]);
        $this->db->set("mobil_keterangan",$data["mobil_keterangan"]);
        $this->db->where("mobil_no",$data["mobil_no"]);
        $this->db->update("skb_mobil");
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

    public function update_konfigurasi($akun_id,$data_konfigurasi){
        $data_konfigurasi=json_encode($data_konfigurasi);
        $this->db->set("akun_akses",$data_konfigurasi);
        $this->db->where("akun_id",$akun_id);
        $this->db->update("skb_akun");
    }

    // fungsi untuk form joborder
        public function getrutebycustomer($customer_id){
            $this->db->select("rute_muatan");
            return $this->db->get_where("skb_rute",array("customer_id"=>$customer_id,"rute_status_hapus"=>"NO"))->result_array();
        }
        public function getrutebymuatan($customer_id,$muatan){
            $data_where = array(
                "customer_id"=>$customer_id,
                "rute_muatan"=>$muatan,
                "rute_status_hapus"=>"NO"
            );
            $this->db->select("rute_dari");
            $this->db->where($data_where);
            return $this->db->get("skb_rute")->result_array();
        }
        public function getrutebydari($customer_id,$muatan,$rute_dari){
            $data_where = array(
                "customer_id"=>$customer_id,
                "rute_muatan"=>$muatan,
                "rute_dari"=>$rute_dari,
                "rute_status_hapus"=>"NO"
            );
            $this->db->select("rute_ke");
            $this->db->where($data_where);
            return $this->db->get("skb_rute")->result_array();
        }
        public function getmobilbyjenis($mobil_jenis){
            return $this->db->get_where("skb_mobil",array("mobil_jenis"=>$mobil_jenis,"status_jalan"=>"Tidak Jalan"))->result_array();
        }
        public function getrutefix($data){
            if($data["rute_tonase"]!=0){
                $data_where = array(
                    "customer_id"=>$data["customer_id"],
                    "rute_muatan"=>$data["muatan"],
                    "rute_dari"=>$data["rute_dari"],
                    "rute_ke"=>$data["rute_ke"],
                    "rute_status_hapus"=>"NO",
                    "rute_tonase"=>$data["rute_tonase"]
                );
            }else{
                $data_where = array(
                    "customer_id"=>$data["customer_id"],
                    "rute_muatan"=>$data["muatan"],
                    "rute_dari"=>$data["rute_dari"],
                    "rute_ke"=>$data["rute_ke"],
                    "rute_status_hapus"=>"NO",
                    "rute_tonase"=>"0"
                );
            }
            if($data["mobil_jenis"]=="Sedang(Engkel)"){
                $this->db->select("rute_uj_engkel,rute_gaji_engkel,rute_tonase,rute_gaji_engkel_rumusan");
            }else{
                $this->db->select("rute_uj_tronton,rute_gaji_tronton,rute_tonase,rute_gaji_tronton_rumusan");
            }
            $this->db->where($data_where);
            return $this->db->get("skb_rute")->row_array();
        }
        public function getrutetonase($data){
            $data_where = array(
                "customer_id"=>$data["customer_id"],
                "rute_muatan"=>$data["muatan"],
                "rute_dari"=>$data["rute_dari"],
                "rute_ke"=>$data["rute_ke"],
                "rute_status_hapus"=>"NO",
                "rute_tonase!="=>"0"
            );
            $this->db->where($data_where);
            return $this->db->get("skb_rute")->result_array();
        }
    // end fungsi untuk form joborder
}