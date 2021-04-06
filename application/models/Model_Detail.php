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
        return $this->db->get_where("skb_rute",array("rute_id"=>$rute_id))->row_array();
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
        return $this->db->get_where("skb_job_order",array("skb_job_order.supir_id"=>$supir_id))->result_array();
    }

    public function getjobbysupirbayar($supir_id){ //JO by supir upah lunas
        $this->db->where("status_upah","Sudah Dibayar");
        $this->db->where("upah!=","0");
        $this->db->join("skb_supir","skb_supir.supir_id=skb_job_order.supir_id","left");
        return $this->db->get_where("skb_job_order",array("skb_job_order.supir_id"=>$supir_id))->result_array();
    }

    public function getjobbysupirbelumbayar($supir_id){ //JO by supir updah belum lunas
        $this->db->where("status_upah","Belum Dibayar");
        $this->db->where("upah!=","0");
        $this->db->join("skb_supir","skb_supir.supir_id=skb_job_order.supir_id","left");
        return $this->db->get_where("skb_job_order",array("skb_job_order.supir_id"=>$supir_id))->result_array();
    }

    public function getinvoicebyjo($jo_id){ //invoice by JO
        $this->db->join("skb_job_order","skb_job_order.Jo_id=skb_invoice.jo_id","left");
        return $this->db->get_where("skb_invoice",array("skb_invoice.jo_id"=>$jo_id))->row_array();
    }

    public function update_upah($data){ //update upah saat bayar gaji/upah
        $supir_id = $data["supir_id"];
        $Jo_id = $data["Jo_id"];
        $upah = $data["upah"];
        $supir_kasbon = $data["supir_kasbon"];

        $grand_upah = $upah-$supir_kasbon;
        if($grand_upah < 0){
            $this->db->set("supir_kasbon",$grand_upah*(-1));
            $this->db->where("supir_id",$supir_id);
            $this->db->update("skb_supir");
        }else{
            $this->db->set("supir_kasbon",0);
            $this->db->where("supir_id",$supir_id);
            $this->db->update("skb_supir");
        }

        //update status upah pada jo id
        if($Jo_id != null){
        for($i=0;$i<count($Jo_id);$i++){
            $this->db->set("status_upah","Sudah Dibayar");
            $this->db->where("Jo_id",$Jo_id[$i]);
            $this->db->update("skb_job_order");
        }}
        //end update status upah pada jo id
    }
    
    public function updateinvoice($invoice_kode){ //update status bayar invoice jadi lunas
        $this->db->set("status_bayar","Lunas");
        $this->db->where("invoice_kode",$invoice_kode);
        $this->db->update("skb_invoice");
    }

    public function update_jo_dibatalkan($Jo_id,$supir_id,$mobil_no,$uj){
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
}
