<?php
// error_reporting(0);
class Model_Detail extends CI_model
{
    public function updatestatusjo($data,$supir,$mobil){ //update status jo saat sampai tujuan
        $this->db->set("tonase",$data["tonase"]);
        $this->db->set("bonus",$data["bonus"]);
        $this->db->set("keterangan",$data["keterangan"]);
        $this->db->set("status","Sampai Tujuan");
        $this->db->set("tanggal_bongkar",$data["tanggal_bongkar"]);
        $this->db->where("Jo_id",$data["Jo_id"]);
        $this->db->update("skb_job_order");

        $this->db->set("status_jalan","Tidak Jalan");
        $this->db->where("supir_id",$supir);
        $this->db->update("skb_supir");

        $this->db->set("status_jalan","Tidak Jalan");
        $this->db->where("mobil_no",str_replace("%20"," ",$mobil));
        $this->db->update("skb_mobil");
    }

    public function updateUJ($jo_id,$keterangan,$uj){ //update status jo saat sampai tujuan
        $this->db->set("uang_jalan_bayar",$uj);
        $this->db->set("keterangan",$keterangan);
        $this->db->where("Jo_id",$jo_id);
        $this->db->update("skb_job_order");
    }

    public function getbonbyid($bon_id){ //bon by ID
        $this->db->join("skb_supir","skb_supir.supir_id=skb_bon.supir_id","left");
        return $this->db->get_where("skb_bon",array("bon_id"=>$bon_id))->row_array();
    }

    public function getbonbysupir($supir_id){ //bon by Supir
        $this->db->join("skb_supir","skb_supir.supir_id=skb_bon.supir_id","left");
        return $this->db->get_where("skb_bon",array("skb_bon.supir_id"=>$supir_id))->result_array();
    }

    public function gettruckbyid($truck_id){ //truck by ID
        return $this->db->get_where("skb_mobil",array("mobil_no"=>$truck_id))->row_array();
    }

    public function getmerkbyid($merk_id){ //merk by ID
        return $this->db->get_where("skb_merk_kendaraan",array("merk_id"=>$merk_id))->row_array();
    }

    public function getrutebyid($rute_id){ //rute by ID
        $this->db->join("skb_customer","skb_customer.customer_id=skb_rute.customer_id","left");
        return $this->db->get_where("skb_rute",array("rute_id"=>$rute_id))->row_array();
    }

    public function getkosonganbyid($kosongan_id,$jo_id){ //kosongan by ID
        $this->db->join("skb_job_order","skb_job_order.kosongan_id=skb_kosongan.kosongan_id","left");
        if($jo_id!=0){
            $this->db->where("skb_job_order.Jo_id",$jo_id);
        }
        return $this->db->get_where("skb_kosongan",array("skb_kosongan.kosongan_id"=>$kosongan_id))->row_array();
    }

    public function getallmerk(){ //merk all
        return $this->db->get_where("skb_merk_kendaraan",array("status_hapus"=>"NO","Validasi"=>"ACC"))->result_array();
    }
    
    public function getinvoicebyid($invoice_id){ //invoice by ID
        $this->db->join("skb_invoice","skb_invoice.invoice_kode=skb_job_order.invoice_id","left");
        return $this->db->get_where("skb_job_order",array("invoice_id"=>$invoice_id))->result_array();
    }

    public function getjobbysupir($supir_id){ //JO by supir
        $this->db->where("status_upah","Belum Dibayar");
        $this->db->where("upah!=","0");
        $this->db->join("skb_supir","skb_supir.supir_id=skb_job_order.supir_id","left");
        return $this->db->get_where("skb_job_order",array("skb_job_order.supir_id"=>$supir_id,"skb_job_order.status"=>"Sampai Tujuan"))->result_array();
    }

    public function getpembayaranupah($supir_id){
        $this->db->join("skb_supir","skb_supir.supir_id=skb_pembayaran_upah.supir_id","left");
        return $this->db->get_where("skb_pembayaran_upah",array("skb_pembayaran_upah.supir_id"=>$supir_id))->result_array();
    }

    public function getpembayaranupahbyid($pembayaran_id){
        $this->db->join("skb_job_order","skb_job_order.pembayaran_upah_id=skb_pembayaran_upah.pembayaran_upah_id","left");
        return $this->db->get_where("skb_pembayaran_upah",array("skb_pembayaran_upah.pembayaran_upah_id"=>$pembayaran_id))->result_array();
    }

    public function getinvoicebyjo($jo_id){ //invoice by JO
        $this->db->join("skb_job_order","skb_job_order.Jo_id=skb_invoice.jo_id","left");
        return $this->db->get_where("skb_invoice",array("skb_invoice.jo_id"=>$jo_id))->row_array();
    }

    public function update_upah($data){ //update upah saat bayar gaji/upah
        $supir_id = $data["supir_id"];
        $supir = $this->db->get_where("skb_supir",array("supir_id"=>$supir_id))->row_array();
        $Jo_id = $data["Jo_id"];
        $gaji_grand_total = $data["gaji_grand_total"];
        $gaji_total = $data["gaji_total"];
        $kasbon = $data["kasbon"];
        $bonus = $data["bonus"];
        //set kasbon supir
            $this->db->set("supir_kasbon",$supir["supir_kasbon"]-$kasbon);
            $this->db->where("supir_id",$supir_id);
            $this->db->update("skb_supir");
        //end set kasbon supir

        //insert pembayaran upah 
        $this->db->select("pembayaran_upah_id");
        $pembayaran_upah_id = $this->db->get("skb_pembayaran_upah")->result_array();
        $isi_pembayaran_upah_id = [];
        if($pembayaran_upah_id){
            for($i=0;$i<count($pembayaran_upah_id);$i++){
                $isi_pembayaran_upah_id[] = $pembayaran_upah_id[$i]["pembayaran_upah_id"];
            }
        }else{
            $isi_pembayaran_upah_id[] = 0;
        }
        date_default_timezone_set('Asia/Jakarta');
        $data=array(
            "supir_id"=>$supir_id,
            "pembayaran_upah_nominal"=>$gaji_total,
            "pembayaran_upah_bonus"=>$bonus,
            "pembayaran_upah_bon"=>$kasbon,
            "pembayaran_upah_total"=>$gaji_grand_total,
            "pembayaran_upah_tanggal"=>date("Y-m-d"),
            "user_upah"=>$_SESSION["user"]
        );
        $this->db->insert("skb_pembayaran_upah",$data);
        //end insert pembayaran upah 
        
        //insert kasbon 
            if($kasbon>0){
                $this->db->select("bon_id");
                $bon_id = $this->db->get("skb_bon")->result_array();
                $isi_bon_id = [];
                for($i=0;$i<count($bon_id);$i++){
                    $isi_bon_id[] = $bon_id[$i]["bon_id"];
                }
                date_default_timezone_set('Asia/Jakarta');
                $data=array(
                    "bon_id"=>max($isi_bon_id)+1,
                    "supir_id"=>$supir_id,
                    "bon_jenis"=>"Potong Gaji",
                    "bon_nominal"=>$kasbon,
                    "bon_keterangan"=>"Potongan Kasbon Dari Pembayaran Gaji",
                    "bon_tanggal"=>date("Y-m-d H:i:s")
                );
                $this->db->insert("skb_bon",$data);
            }
        //end insert kasbon 

        //update status upah pada jo id
            if($Jo_id != null){
                for($i=0;$i<count($Jo_id);$i++){
                    $this->db->set("status_upah","Sudah Dibayar");
                    $this->db->set("pembayaran_upah_id",max($isi_pembayaran_upah_id)+1);
                    $this->db->where("Jo_id",$Jo_id[$i]);
                    $this->db->update("skb_job_order");
                }
            }
        //end update status upah pada jo id
    }
    
    public function updateinvoice($invoice_kode){ //update status bayar invoice jadi lunas
        $this->db->set("status_bayar","Lunas");
        $this->db->where("invoice_kode",$invoice_kode);
        $this->db->update("skb_invoice");
    }

    public function update_jo_dibatalkan($Jo_id,$supir_id,$mobil_no,$uj){
        $child_jo = $this->db->get_where("skb_job_order",array("parent_Jo_id"=>$Jo_id));
        for($i=0;$i<count($child_jo);$i++){
            $this->db->set("status","Dibatalkan");
            $this->db->where("Jo_id",$child_jo[$i]["Jo_id"]);
            $this->db->update("skb_job_order");
        }

        $this->db->set("status","Dibatalkan");
        $this->db->where("Jo_id",$Jo_id);
        $this->db->update("skb_job_order");

        $this->db->set("status_jalan","Tidak Jalan");
        $this->db->where("supir_id",$supir_id);
        $this->db->update("skb_supir");

        $this->db->set("status_jalan","Tidak Jalan");
        $this->db->where("mobil_no",str_replace("%20"," ",$mobil_no));
        $this->db->update("skb_mobil");
    }

    //fungsi untuk update supir dan mobil JO
    public function getsupir(){
        return $this->db->get_where("skb_supir",array("status_jalan"=>"Tidak Jalan","status_hapus"=>"NO","status_aktif"=>"Aktif","validasi"=>"ACC"))->result_array();
    }
    public function getmobil($mobil_jenis){
        return $this->db->get_where("skb_mobil",array("status_jalan"=>"Tidak Jalan","status_hapus"=>"NO","validasi"=>"ACC","mobil_jenis"=>$mobil_jenis))->result_array();
    }
    public function updatesupirjo($jo_id,$supir_id,$supir_id_old){
        $this->db->where("Jo_id",$jo_id);
        $this->db->set("supir_id",$supir_id);
        $this->db->update("skb_job_order");

        $this->db->where("supir_id",$supir_id);
        $this->db->set("status_jalan","Jalan");
        $this->db->update("skb_supir");

        $this->db->where("supir_id",$supir_id_old);
        $this->db->set("status_jalan","Tidak Jalan");
        $this->db->update("skb_supir");
    }

    public function updatemobiljo($jo_id,$mobil_no,$mobil_no_old){
        $this->db->where("Jo_id",$jo_id);
        $this->db->set("mobil_no",$mobil_no);
        $this->db->update("skb_job_order");

        $this->db->where("mobil_no",$mobil_no);
        $this->db->set("status_jalan","Jalan");
        $this->db->update("skb_mobil");

        $this->db->where("mobil_no",$mobil_no_old);
        $this->db->set("status_jalan","Tidak Jalan");
        $this->db->update("skb_mobil");
    }
    //end fungsi untuk update supir dan mobil JO
}
