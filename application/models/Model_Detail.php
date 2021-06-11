<?php
// error_reporting(0);
class Model_Detail extends CI_model
{
    public function change_tanggal($tanggal){
        if($tanggal==""){
            return "";
        }else{
            $tanggal_array = explode("-",$tanggal);
            return $tanggal_array[2]."-".$tanggal_array[1]."-".$tanggal_array[0];   
        }
    }

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

    public function getbonbysupirperiode($supir_id,$tanggal1,$tanggal2){ //bon by Supir


        $this->db->where("bon_tanggal BETWEEN CAST('".$this->change_tanggal($tanggal1)."' AS DATE) AND CAST('".$this->change_tanggal($tanggal2)."' AS DATE)");
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

    public function getjobbysupirbulan($supir_id,$tahun,$bulan){ //JO by supir
        if($bulan=="x" && $tahun=="x"){
            $bulan_kerja = "";
        }else if($bulan=="x"){
            $bulan_kerja = "'".$tahun."%'";
            $this->db->where("tanggal_muat like ".$bulan_kerja);
        }else if($tahun=="x"){
            $bulan_kerja = "'%-".$bulan."-%'";
            $this->db->where("tanggal_muat like ".$bulan_kerja);
        }else{
            $bulan_kerja = "'".$tahun."-".$bulan."-%'";
            $this->db->where("tanggal_muat like ".$bulan_kerja);
        }
        $this->db->where("pembayaran_upah_id","");
        $this->db->where("upah!=","0");
        $this->db->join("skb_customer","skb_customer.customer_id=skb_job_order.customer_id","left");
        $this->db->join("skb_supir","skb_supir.supir_id=skb_job_order.supir_id","left");
        return $this->db->get_where("skb_job_order",array("skb_job_order.supir_id"=>$supir_id,"skb_job_order.status"=>"Sampai Tujuan"))->result_array();
    }

    public function getpembayaranupah($supir_id){
        $this->db->join("skb_supir","skb_supir.supir_id=skb_pembayaran_upah.supir_id","left");
        return $this->db->get_where("skb_pembayaran_upah",array("skb_pembayaran_upah.supir_id"=>$supir_id))->result_array();
    }

    public function getjobypembayaranupah($upah_id){
        $this->db->select("Jo_id");
        return $this->db->get_where("skb_job_order",array("pembayaran_upah_id"=>$upah_id))->result_array();
    }

    public function getpembayaranupahbyid($pembayaran_id){
        $this->db->join("skb_job_order","skb_job_order.pembayaran_upah_id=skb_pembayaran_upah.pembayaran_upah_id","left");
        return $this->db->get_where("skb_pembayaran_upah",array("skb_pembayaran_upah.pembayaran_upah_id"=>$pembayaran_id))->result_array();
    }

    public function getinvoicebyjo($jo_id){ //invoice by JO
        $this->db->join("skb_job_order","skb_job_order.Jo_id=skb_invoice.jo_id","left");
        return $this->db->get_where("skb_invoice",array("skb_invoice.jo_id"=>$jo_id))->row_array();
    }

    public function insert_upah($data){ //update upah saat bayar gaji/upah
        $supir_id = $data["supir_id"];
        $supir = $this->db->get_where("skb_supir",array("supir_id"=>$supir_id))->row_array();
        $Jo_id = $data["Jo_id"];
        $gaji_grand_total = $data["gaji_grand_total"];
        $gaji_total = $data["gaji_total"];
        $kasbon = $data["kasbon"];
        $bonus = $data["bonus"];
        $pembayaran_upah_id = $data["pembayaran_upah_id"];

        //insert pembayaran upah 
        date_default_timezone_set('Asia/Jakarta');
        $data=array(
            "supir_id"=>$supir_id,
            "pembayaran_upah_id"=>$pembayaran_upah_id, 
            "pembayaran_upah_nominal"=>$gaji_total,
            "pembayaran_upah_bonus"=>$bonus,
            "pembayaran_upah_bon"=>$kasbon,
            "pembayaran_upah_total"=>$gaji_grand_total,
            "pembayaran_upah_tanggal"=>date("Y-m-d"),
            "pembayaran_upah_status"=>"Belum Lunas",
            "bulan_kerja"=>$data["bulan_kerja"],
            "user_upah"=>$_SESSION["user"]."(".date("d-m-Y H:i:s").")"
        );
        $this->db->insert("skb_pembayaran_upah",$data);
        //end insert pembayaran upah 
        //update status upah pada jo id
            if($Jo_id != null){
                for($i=0;$i<count($Jo_id);$i++){
                    $this->db->set("pembayaran_upah_id",$pembayaran_upah_id);
                    $this->db->where("Jo_id",$Jo_id[$i]);
                    $this->db->update("skb_job_order");
                }
            }
        //end update status upah pada jo id
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

        //insert kasbon 
            if($kasbon>0){
                $this->db->select("bon_id");
                $bon_id = $this->db->get("skb_bon")->result_array();
                $isi_bon_id = [];
                for($i=0;$i<count($bon_id);$i++){
                    $explode_bon = explode("-",$bon_id[$i]["bon_id"]);
                    if(count($explode_bon)>1){
                        if($explode_bon[2]==date("m") && $explode_bon[3]==date('Y')){
                            $isi_bon_id[] = $explode_bon[0];
                        }
                    }
                }
                if(count($isi_bon_id)==0){
                    $isi_bon_id[]=0;
                }
                date_default_timezone_set('Asia/Jakarta');
                $data_bon=array(
                    "bon_id"=>(max($isi_bon_id)+1)."-BON-".date("m")."-".date("Y"),
                    "supir_id"=>$supir_id,
                    "bon_jenis"=>"Potong Gaji",
                    "bon_nominal"=>$kasbon,
                    "bon_keterangan"=>"Potongan Kasbon Dari Pembayaran Gaji",
                    "pembayaran_upah_id"=>$data["pembayaran_upah_id"],
                    "bon_tanggal"=>date("Y-m-d"),
                    "user"=>$_SESSION["user"]."(".date("d-m-Y H:i:s").")"
                );
                $this->db->insert("skb_bon",$data_bon);
            }
        //end insert kasbon 
        $this->db->set("pembayaran_upah_status","Lunas");
        $this->db->where("pembayaran_upah_id",$data["pembayaran_upah_id"]);
        $this->db->update("skb_pembayaran_upah");
        //update status upah pada jo id
            if($Jo_id != null){
                for($i=0;$i<count($Jo_id);$i++){
                    $this->db->set("status_upah","Sudah Dibayar");
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
        $this->db->set("status","Dibatalkan");
        $this->db->set("user_closing",$_SESSION["user"]."(".date("d-m-Y H:i:s").")");
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

    function getGajiData($postData,$supir_id){
        $response = array();
    
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start']; // mulai display per page
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index untuk sorting
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name untuk sorting
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
    
        ## Search 
        $search_arr = array();
        $searchQuery = "";
        if($searchValue != ''){
            $search_arr[] = " (pembayaran_upah_id like '%".$searchValue."%')";
        }
        $search_arr[] = " skb_pembayaran_upah.supir_id=".$supir_id;
        if(count($search_arr) > 0){ //gabung kondisi where
            $searchQuery = implode(" and ",$search_arr);
        }
    
        ## Total record without filtering
        $this->db->select('count(*) as allcount');
        $this->db->where("supir_id",$supir_id);
        $records = $this->db->get('skb_pembayaran_upah')->result();
        $totalRecords = $records[0]->allcount;
    
        ## Total record with filtering
        $this->db->select('count(*) as allcount');
        if($searchQuery != ''){
            $this->db->where($searchQuery);
        }
        $this->db->join("skb_supir", "skb_supir.supir_id = skb_pembayaran_upah.supir_id", 'left');
        $records = $this->db->get('skb_pembayaran_upah')->result();
        $totalRecordwithFilter = $records[0]->allcount;
    
        ## data hasil record
        $this->db->select('*');
        if($searchQuery != ''){
            $this->db->where($searchQuery);
        }
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $this->db->join("skb_supir", "skb_supir.supir_id = skb_pembayaran_upah.supir_id", 'left');
        $records = $this->db->get('skb_pembayaran_upah')->result();
    
        $data = $records;
        ## Response
        $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
        );
    
        return $response; 
    }
}
