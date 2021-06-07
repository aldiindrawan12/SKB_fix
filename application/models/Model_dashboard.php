<?php
// error_reporting(0);
class Model_Dashboard extends CI_model
{
     //function-fiunction datatable truck dashboard
        public function count_all_truck($fungsi)
        {
            $this->db->where("status_hapus","NO");
            if($_SESSION["role"]=="Supervisor"){
                $this->db->where("validasi","Pending");
            }else{
                $this->db->where("validasi","ACC");
            }
            return $this->db->count_all_results("skb_mobil");
        }

        public function filter_truck($fungsi,$search, $order_field, $order_ascdesc)
        {
            if($search!=""){
                $this->db->like('mobil_no', $search);
                $this->db->or_like('mobil_jenis', $search);
                $this->db->or_like('mobil_merk', $search);
                $this->db->or_like('mobil_type', $search);
                $this->db->or_like('mobil_tahun', $search);
            }
            $this->db->order_by($order_field, $order_ascdesc);
            $hasil = $this->db->get('skb_mobil')->result_array();
            $hasil_fix = [];
            for($i=0;$i<count($hasil);$i++){
                if($fungsi=="nopol"){
                    $tanggal = $hasil[$i]["mobil_berlaku"];
                }else if($fungsi=="kir"){
                    $tanggal = $hasil[$i]["mobil_berlaku_kir"];
                }else if($fungsi=="stnk"){
                    $tanggal = $hasil[$i]["mobil_pajak"];
                }else if($fungsi=="ijin"){
                    $tanggal = $hasil[$i]["mobil_berlaku_ijin_bongkar"];
                }else{
                    $tanggal = "0000-00-00";
                }
                $tanggal_now = date("Y-m-d");
                $tgl1 = new DateTime($tanggal_now);
                $tgl2 = new DateTime($tanggal);
                $d = $tgl2->diff($tgl1)->days + 1;
                if($fungsi=="tidak_jalan"){
                        if($hasil[$i]["status_hapus"]=="NO" && $hasil[$i]["status_jalan"]=="Tidak Jalan" && $hasil[$i]["validasi"]=="ACC"){
                            $hasil_fix[] = $hasil[$i];
                        }
                }else{
                        if($hasil[$i]["status_hapus"]=="NO" && ($tanggal_now>$tanggal || $d<31) && $tanggal!=null  && $hasil[$i]["validasi"]=="ACC"){
                            $hasil_fix[] = $hasil[$i];
                        }
                }
            }
            return $hasil_fix;   
        }

        public function count_filter_truck($fungsi,$search)
        {
            if($search!=""){
                $this->db->like('mobil_no', $search);
                $this->db->or_like('mobil_jenis', $search);
                $this->db->or_like('mobil_merk', $search);
                $this->db->or_like('mobil_type', $search);
                $this->db->or_like('mobil_tahun', $search);
            }
            $hasil_data = $this->db->get('skb_mobil')->result_array();
                $hasil_fix = 0;
                for($i=0;$i<count($hasil_data);$i++){
                    if($fungsi=="nopol"){
                        $tanggal = $hasil_data[$i]["mobil_berlaku"];
                    }else if($fungsi=="kir"){
                        $tanggal = $hasil_data[$i]["mobil_berlaku_kir"];
                    }else if($fungsi=="stnk"){
                        $tanggal = $hasil_data[$i]["mobil_pajak"];
                    }else if($fungsi=="ijin"){
                        $tanggal = $hasil_data[$i]["mobil_berlaku_ijin_bongkar"];
                    }else{
                        $tanggal = "0000-00-00";
                    }
                    $tanggal_now = date("Y-m-d");
                    $tgl1 = new DateTime($tanggal_now);
                    $tgl2 = new DateTime($tanggal);
                    $d = $tgl2->diff($tgl1)->days + 1;
                    if($fungsi="tidak_jalan"){
                            if($hasil_data[$i]["status_hapus"]=="NO" && $hasil_data[$i]["status_jalan"]=="Tidak Jalan" && $hasil_data[$i]["validasi"]=="ACC"){
                                $hasil_fix +=1;
                            }
                    }else{
                            if($hasil_data[$i]["status_hapus"]=="NO"  && ($tanggal_now>$tanggal || $d<31) && $tanggal!=null && $hasil_data[$i]["validasi"]=="ACC"){
                                $hasil_fix +=1;
                            }
                    }
                }
                return $hasil_fix;
        }
    //akhir function-fiunction datatable truck dashboard
    //  Function Supir
        public function count_all_supir($fungsi)
        {
            $this->db->where("status_hapus","NO");
            if($_SESSION["role"]=="Supervisor"){
                $this->db->where("validasi","Pending");
            }else{
                $this->db->where("validasi","ACC");
            }
            return $this->db->count_all_results("skb_supir");
        }

        public function filter_supir($fungsi,$search, $order_field, $order_ascdesc)
        {
            $this->db->like('supir_name', $search);
            $this->db->where("status_hapus","NO");
            $this->db->order_by($order_field, $order_ascdesc);
            $hasil = $this->db->get('skb_supir')->result_array();
            $hasil_fix = [];
            for($i=0;$i<count($hasil);$i++){
                if($fungsi=="sim"){
                    $tanggal = $hasil[$i]["supir_tgl_sim"];
                }else{
                    $tanggal = "0000-00-00";
                }
                $tanggal_now = date("Y-m-d");
                $tgl1 = new DateTime($tanggal_now);
                $tgl2 = new DateTime($tanggal);
                $d = $tgl2->diff($tgl1)->days + 1;
                if($fungsi=="tidak_jalan"){
                        if($hasil[$i]["status_hapus"]=="NO" && $hasil[$i]["status_jalan"]=="Tidak Jalan" && $hasil[$i]["validasi"]=="ACC"){
                            $hasil_fix[] = $hasil[$i];
                        }
                }else{
                        if($hasil[$i]["status_hapus"]=="NO" && ($tanggal_now>$tanggal || $d<31) && $tanggal!=null  && $hasil[$i]["validasi"]=="ACC"){
                            $hasil_fix[] = $hasil[$i];
                        }
                }
            }
            return $hasil_fix;   
        }

        public function count_filter_supir($fungsi,$search)
        {
            $this->db->like('supir_name', $search);
            $this->db->where("status_hapus","NO");
            $hasil_data = $this->db->get('skb_supir')->result_array();
            $hasil_fix = 0;
            for($i=0;$i<count($hasil_data);$i++){
                if($fungsi=="sim"){
                    $tanggal = $hasil_data[$i]["supir_tgl_sim"];
                }else{
                    $tanggal = "0000-00-00";
                }
                $tanggal_now = date("Y-m-d");
                $tgl1 = new DateTime($tanggal_now);
                $tgl2 = new DateTime($tanggal);
                $d = $tgl2->diff($tgl1)->days + 1;
                if($fungsi="tidak_jalan"){
                        if($hasil_data[$i]["status_hapus"]=="NO" && $hasil_data[$i]["status_jalan"]=="Tidak Jalan" && $hasil_data[$i]["validasi"]=="ACC"){
                            $hasil_fix +=1;
                        }
                }else{
                        if($hasil_data[$i]["status_hapus"]=="NO"  && ($tanggal_now>$tanggal || $d<31) && $tanggal!=null && $hasil_data[$i]["validasi"]=="ACC"){
                            $hasil_fix +=1;
                        }
                }
            }
            return $hasil_fix;
            
        }
    //  end Function Supir
    // Function Invoice Jatuh Tempo
        public function count_all_invoice_jatuh_tempo()
        {
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_invoice.customer_id", 'left');
            return $this->db->count_all_results("skb_invoice");
        }

        public function filter_invoice_jatuh_tempo($search, $order_field, $order_ascdesc)
        {
            if($search!=""){
                $this->db->like('invoice_kode', $search);
                $this->db->or_like('customer_name', $search);
            }
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_invoice.customer_id", 'left');
            $hasil = $this->db->get('skb_invoice')->result_array();
            $hasil_fix = [];
            for($i=0;$i<count($hasil);$i++){
                $tgl_invoice = $hasil[$i]["tanggal_invoice"];
                $tanggal = date('Y-m-d', strtotime('+'.$hasil[$i]["batas_pembayaran"].' days', strtotime($tgl_invoice)));
                $tanggal_now = date("Y-m-d");
                $tgl1 = new DateTime($tgl_invoice);
                $tgl2 = new DateTime($tanggal);
                $d = $tgl2->diff($tgl1)->days + 1;
                if($hasil[$i]["status_bayar"]=="Belum Lunas" && $tanggal_now>$tanggal){
                    $hasil_fix[] = $hasil[$i];
                }
            }
            return $hasil_fix;  
        }

        public function count_filter_invoice_jatuh_tempo($search)
        {
            $this->db->where("status_bayar","Belum Lunas");
            $this->db->like('invoice_kode', $search);
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_invoice.customer_id", 'left');
            $hasil_data = $this->db->get('skb_invoice')->result_array();
            $hasil_fix = 0;
            for($i=0;$i<count($hasil_data);$i++){
                $tgl_invoice = $hasil_data[$i]["tanggal_invoice"];
                $tanggal = date('Y-m-d', strtotime('+'.$hasil_data[$i]["batas_pembayaran"].' days', strtotime($tgl_invoice)));
                $tanggal_now = date("Y-m-d");
                $tgl1 = new DateTime($tgl_invoice);
                $tgl2 = new DateTime($tanggal);
                $d = $tgl2->diff($tgl1)->days + 1;
                if($hasil_data[$i]["status_bayar"]=="Belum Lunas" && $tanggal_now>$tanggal){
                    $hasil_fix +=1;
                }
            }
            return $hasil_fix;
        }
    // end Function Invoice Jatuh Tempo
    //function-fiunction datatable JO
    function getJoNoInvoice($postData){
        $tanggal_now = date("Y-m-d");
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
            $search_arr[] = " (Jo_id like '%".$searchValue."%' or 
                muatan like '%".$searchValue."%' or 
                asal like '%".$searchValue."%' or 
                tujuan like'%".$searchValue."%') ";
        }
        $search_arr[] = " status='Sampai Tujuan' ";
        $search_arr[] = " invoice_id='' ";

        if(count($search_arr) > 0){ //gabung kondisi where
            $searchQuery = implode(" and ",$search_arr);
        }
    
        ## Total record without filtering
        $this->db->select('count(*) as allcount');
        $records = $this->db->get('skb_job_order')->result();
        $totalRecords = $records[0]->allcount;
    
        ## Total record with filtering
        $this->db->select('count(*) as allcount');
        if($searchQuery != ''){
            $this->db->where($searchQuery);
        }
        $records = $this->db->get('skb_job_order')->result();
        $totalRecordwithFilter = $records[0]->allcount;
    
        ## data hasil record
        $this->db->select('*');
        $this->db->join("skb_customer", "skb_customer.customer_id = skb_job_order.customer_id", 'left');
        if($searchQuery != ''){
            $this->db->where($searchQuery);
        }
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('skb_job_order')->result();
    
        $data = array();
        $n = 1;
        foreach($records as $record ){
            $data[] = array(
                "no"=>$n,
                "Jo_id"=>$record->Jo_id,
                "customer_name"=>$record->customer_name,
                "muatan"=>$record->muatan,
                "asal"=>$record->asal,
                "tujuan"=>$record->tujuan,
                "tanggal_surat"=>$record->tanggal_surat,
                "status"=>$record->status
            ); 
            $n++;
        }
        ## Response
        $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
        );
    
        return $response; 
    }
    //akhir function-fiunction datatable JO
    public function generate_selisih_tanggal($tanggal){
        $tanggal_now = date("Y-m-d");
        $tgl1 = new DateTime($tanggal_now);
        $tgl2 = new DateTime($tanggal);
        $d = $tgl2->diff($tgl1)->days + 1;
        echo $d;
    }
}