<?php
// error_reporting(0);
class Model_Home extends CI_model
{
    //function get
        public function gettruck() //all truck
        {
            return $this->db->get_where("skb_mobil",array("status_hapus"=>"NO","validasi"=>"ACC"))->result_array();
        }

        public function getmerk() //all truck
        {
            // ,"validasi"=>"ACC","validasi_edit"=>"ACC","validasi_delete"=>"ACC"
            return $this->db->get_where("skb_merk_kendaraan",array("status_hapus"=>"NO"))->result_array();
        }

        public function getmobilbyid($mobil_no) //mobil by ID
        {
            return $this->db->get_where("skb_mobil",array("mobil_no"=>$mobil_no))->row_array();
        }

        public function getcustomer() //all customer
        {
            return $this->db->get_where("skb_customer",array("validasi"=>"ACC","status_hapus"=>"NO","validasi"=>"ACC","validasi_edit"=>"ACC","validasi_delete"=>"ACC"))->result_array();
        }

        public function getcustomerbyid($customer_id) //customer by ID
        {
            return $this->db->get_where("skb_customer",array("customer_id"=>$customer_id))->row_array();
        }

        public function getsupir() //all supir
        {
            return $this->db->get_where("skb_supir",array("status_hapus"=>"NO","status_aktif"=>"Aktif","validasi"=>"ACC","validasi_edit"=>"ACC","validasi_delete"=>"ACC"))->result_array();
        }

        public function getkosongan() //all kosongan
        {
            return $this->db->get_where("skb_kosongan",array("status_hapus"=>"NO","validasi"=>"ACC","validasi_edit"=>"ACC","validasi_delete"=>"ACC"))->result_array();
        }

        public function getkosonganbyid($kosongan_id) //kosongan by id
        {
            return $this->db->get_where("skb_kosongan",array("status_hapus"=>"NO","kosongan_id"=>$kosongan_id))->row_array();
        }

        public function getsupirbyid($supir_id) //supir by id
        {
            return $this->db->get_where("skb_supir",array("supir_id"=>$supir_id))->row_array();
        }

        public function getjo() //all JO
        {
            return $this->db->get("skb_job_order")->result_array();
        }

        public function getjobyid($jo_id) //JO by ID
        {
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_job_order.customer_id", 'left');
            return $this->db->get_where("skb_job_order",array("Jo_id"=>$jo_id))->row_array();
        }
        public function getjobyidkonfirmasi($jo_id) //JO by ID
        {
            $this->db->join("skb_mobil", "skb_mobil.mobil_no = skb_job_order.mobil_no", 'left');
            $this->db->join("skb_supir", "skb_supir.supir_id = skb_job_order.supir_id", 'left');
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_job_order.customer_id", 'left');
            return $this->db->get_where("skb_job_order",array("Jo_id"=>$jo_id))->row_array();
        }
    //end funcction get

     //function-fiunction datatable truck
        function getTruckData($postData){
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
                $search_arr[] = " (mobil_no like '%".$searchValue."%' or 
                    mobil_merk like '%".$searchValue."%' or 
                    mobil_type like '%".$searchValue."%' or 
                    mobil_tahun like '%".$searchValue."%' or 
                    mobil_stnk like '%".$searchValue."%' or 
                    mobil_bpkb like '%".$searchValue."%' or 
                    mobil_no_rangka like '%".$searchValue."%' or 
                    mobil_no_mesin like '%".$searchValue."%' or 
                    mobil_jenis like '%".$searchValue."%') ";
            }
            $search_arr[] = " status_hapus='NO' ";

            if(count($search_arr) > 0){ //gabung kondisi where
                $searchQuery = implode(" and ",$search_arr);
            }
        
            ## Total record without filtering
            $this->db->select('count(*) as allcount');
            $this->db->where("status_hapus","NO");
            $records = $this->db->get('skb_mobil')->result();
            $totalRecords = $records[0]->allcount;
        
            ## Total record with filtering
            $this->db->select('count(*) as allcount');
            if($searchQuery != ''){
                $this->db->where($searchQuery);
            }
            $records = $this->db->get('skb_mobil')->result();
            $totalRecordwithFilter = $records[0]->allcount;
        
            ## data hasil record
            $this->db->select('*');
            if($searchQuery != ''){
                $this->db->where($searchQuery);
            }
            $this->db->order_by($columnName, $columnSortOrder);
            $this->db->limit($rowperpage, $start);
            $records = $this->db->get('skb_mobil')->result();
        
            $data = array();
            $n = 1;
            foreach($records as $record ){
                $data[] = array( 
                    "no"=>$n,
                    "mobil_no"=>$record->mobil_no,
                    "mobil_merk"=>$record->mobil_merk,
                    "mobil_type"=>$record->mobil_type,
                    "mobil_dump"=>$record->mobil_dump,
                    "mobil_tahun"=>$record->mobil_tahun,
                    "mobil_no_rangka"=>$record->mobil_no_rangka,
                    "mobil_no_mesin"=>$record->mobil_no_mesin,
                    "mobil_bpkb"=>$record->mobil_bpkb,
                    "mobil_stnk"=>$record->mobil_stnk,
                    "mobil_jenis"=>$record->mobil_jenis,
                    "validasi"=>$record->validasi,
                    "validasi_edit"=>$record->validasi_edit,
                    "validasi_delete"=>$record->validasi_delete,
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
     //akhir function-fiunction datatable truck

     //function-fiunction datatable JO
        function getJOData($postData,$status){
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
                    asal like '%".$searchValue."%' or 
                    tujuan like '%".$searchValue."%' or 
                    muatan like '%".$searchValue."%') ";
            }
            if($status!="x"){
                $search_arr[] = " status='".$status."' ";
            }
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
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_job_order.customer_id", 'left');
            $this->db->join("skb_supir", "skb_supir.supir_id = skb_job_order.supir_id", 'left');
            $this->db->join("skb_mobil", "skb_mobil.mobil_no = skb_job_order.mobil_no", 'left');
            $records = $this->db->get('skb_job_order')->result();
            $totalRecordwithFilter = $records[0]->allcount;
        
            ## data hasil record
            $this->db->select('*');
            if($searchQuery != ''){
                $this->db->where($searchQuery);
            }
            $this->db->order_by($columnName, $columnSortOrder);
            $this->db->limit($rowperpage, $start);
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_job_order.customer_id", 'left');
            $this->db->join("skb_supir", "skb_supir.supir_id = skb_job_order.supir_id", 'left');
            $this->db->join("skb_mobil", "skb_mobil.mobil_no = skb_job_order.mobil_no", 'left');
            $records = $this->db->get('skb_job_order')->result();
        
            $data = array();
            $n = 1;
            foreach($records as $record ){
                $data[] = array( 
                    "no"=>$n,
                    "Jo_id"=>$record->Jo_id,
                    "supir_name"=>$record->supir_name,
                    "mobil_no"=>$record->mobil_no,
                    "mobil_jenis"=>$record->mobil_jenis,
                    "customer_name"=>$record->customer_name,
                    "asal"=>$record->asal,
                    "tujuan"=>$record->tujuan,
                    "muatan"=>$record->muatan,
                    "tanggal_surat"=>$record->tanggal_surat,
                    "status"=>$record->status,
                    "uang_total"=>$record->uang_total,
                    "biaya_lain"=>$record->biaya_lain,
                    "sisa_uj"=>$record->uang_total-$record->uang_jalan_bayar
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

     //function-fiunction datatable JO laporan
        public function count_all_JO_report($tanggal,$bulan,$tahun,$status)
        {
            $this->db->join("skb_supir", "skb_supir.supir_id = skb_job_order.supir_id", 'left');
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_job_order.customer_id", 'left');
            return $this->db->count_all_results("skb_job_order");
        }

        public function filter_JO_report($order_field, $order_ascdesc,$tanggal,$bulan,$tahun,$status)
        {
            $like=$tahun."-".$bulan."-".$tanggal;
            if($like != "--"){
                if ($tanggal != "x" && $bulan=="x" && $tahun=="x") {
                    $this->db->like("tanggal_surat", "-".$tanggal);
                }
                if ($tanggal == "x" && $bulan!="x" && $tahun=="x") {
                    $this->db->like("tanggal_surat", "-".$bulan."-");
                }
                if ($tanggal == "x" && $bulan=="x" && $tahun!="x") {
                    $this->db->like("tanggal_surat", $tahun."-");
                }
                if ($tanggal != "x" && $bulan=="x" && $tahun!="x") {
                    $this->db->like("tanggal_surat", $tahun."-__-".$tanggal);
                }
                if ($tanggal == "x" && $bulan!="x" && $tahun!="x") {
                    $this->db->like("tanggal_surat", $tahun."-".$bulan."-");
                }
                if ($tanggal != "x" && $bulan!="x" && $tahun=="x") {
                    $this->db->like("tanggal_surat", "-".$bulan."-".$tanggal);
                }
                if ($tanggal != "x" && $bulan!="x" && $tahun!="x") {
                    $this->db->like("tanggal_surat", $tahun."-".$bulan."-".$tanggal);
                }
            }
            if($status!="x"){
                $this->db->where("status",$status);
            }
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->join("skb_supir", "skb_supir.supir_id = skb_job_order.supir_id", 'left');
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_job_order.customer_id", 'left');
            $hasil = $this->db->get('skb_job_order')->result_array();
            $hasil_fix = [];
            for($i=0;$i<count($hasil);$i++){
                if(($hasil[$i]["parent_Jo_id"]=="x" || $hasil[$i]["parent_Jo_id"]=="y") && $hasil[$i]["status"]!="Dibatalkan"){
                    $hasil_fix[] = $hasil[$i];
                }
            }
            return $hasil_fix;
        }

        public function count_filter_JO_report($tanggal,$bulan,$tahun,$status)
        {   
            $like=$tahun."-".$bulan."-".$tanggal;
            if($like != "--"){
                if ($tanggal != "x" && $bulan=="x" && $tahun=="x") {
                    $this->db->like("tanggal_surat", "-".$tanggal);
                }
                if ($tanggal == "x" && $bulan!="x" && $tahun=="x") {
                    $this->db->like("tanggal_surat", "-".$bulan."-");
                }
                if ($tanggal == "x" && $bulan=="x" && $tahun!="x") {
                    $this->db->like("tanggal_surat", $tahun."-");
                }
                if ($tanggal != "x" && $bulan=="x" && $tahun!="x") {
                    $this->db->like("tanggal_surat", $tahun."-__-".$tanggal);
                }
                if ($tanggal == "x" && $bulan!="x" && $tahun!="x") {
                    $this->db->like("tanggal_surat", $tahun."-".$bulan."-");
                }
                if ($tanggal != "x" && $bulan!="x" && $tahun=="x") {
                    $this->db->like("tanggal_surat", "-".$bulan."-".$tanggal);
                }
                if ($tanggal != "x" && $bulan!="x" && $tahun!="x") {
                    $this->db->like("tanggal_surat", $tahun."-".$bulan."-".$tanggal);
                }
            }
            if($status!="x"){
                $this->db->where("status",$status);
            }
            $this->db->join("skb_supir", "skb_supir.supir_id = skb_job_order.supir_id", 'left');
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_job_order.customer_id", 'left');
            $hasil_data = $this->db->get('skb_job_order')->result_array();
            $hasil_fix = 0;
            for($i=0;$i<count($hasil_data);$i++){
                if(($hasil_data[$i]["parent_Jo_id"]=="x" || $hasil_data[$i]["parent_Jo_id"]=="y") && $hasil_data[$i]["status"]!="Dibatalkan"){
                    $hasil_fix +=1;
                }
            }
            return $hasil_fix;
        }
    //akhir function-fiunction datatable JO laporan


     //function-fiunction datatable bon
        public function count_all_bon()
        {
            $this->db->join("skb_supir", "skb_supir.supir_id = skb_bon.supir_id", 'left');
            return $this->db->count_all_results("skb_bon");
        }

        public function filter_bon($search, $limit, $start, $order_field, $order_ascdesc)
        {
            $this->db->like('bon_id', $search);
            $this->db->or_like('supir_name', $search);
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            $this->db->join("skb_supir", "skb_supir.supir_id = skb_bon.supir_id", 'left');
            return $this->db->get('skb_bon')->result_array();
        }

        public function count_filter_bon($search)
        {
            $this->db->like('bon_id', $search);
            $this->db->or_like('supir_name', $search);
            $this->db->join("skb_supir", "skb_supir.supir_id = skb_bon.supir_id", 'left');
            return $this->db->get('skb_bon')->num_rows();
        }
     //akhir function-fiunction datatable bon


    //  Function Customer
        public function count_all_customer($asal)
        {
            $this->db->where("status_hapus","NO");
            if($asal=="viewcustomerinvoice"){
                $this->db->where("validasi","ACC");
            }
            return $this->db->count_all_results("skb_customer");
        }

        public function filter_customer($asal,$search, $limit, $start, $order_field, $order_ascdesc)
        {
            // $this->db->like('customer_id', $search);
            $this->db->where("status_hapus","NO");
            $this->db->like('customer_name', $search);
            if($asal=="viewcustomerinvoice"){
                $this->db->where("validasi","ACC");
            }
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            return $this->db->get('skb_customer')->result_array();
        }

        public function count_filter_customer($asal,$search)
        {
            // $this->db->like('customer_id', $search);
            $this->db->where("status_hapus","NO");
            $this->db->like('customer_name', $search);
            if($asal=="viewcustomerinvoice"){
                $this->db->where("validasi","ACC");
            }
            return $this->db->get('skb_customer')->num_rows();
        }
    //  end Function Customer

    //  Function Supir
        public function count_all_supir($asal)
        {
            $this->db->where("status_hapus","NO");
            if($asal!="viewsupir"){
                $this->db->where("validasi","ACC");
            }
            return $this->db->count_all_results("skb_supir");
        }

        public function filter_supir($asal,$search, $limit, $start, $order_field, $order_ascdesc)
        {
            $this->db->where('(supir_name like "%'.$search.'%" or supir_panggilan like "%'.$search.'%")');
            $this->db->where("status_hapus","NO");
            if($asal!="viewsupir"){
                $this->db->where("validasi","ACC");
            }
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            return $this->db->get('skb_supir')->result_array();
        }

        public function count_filter_supir($asal,$search)
        {
            $this->db->where('(supir_name like "%'.$search.'%" or supir_panggilan like "%'.$search.'%")');
            $this->db->where("status_hapus","NO");
            if($asal!="viewsupir"){
                $this->db->where("validasi","ACC");
            }
            return $this->db->get('skb_supir')->num_rows();
        }
    //  end Function Supir

    // Function Invoice
        public function count_all_invoice()
        {
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_invoice.customer_id", 'left');
            return $this->db->count_all_results("skb_invoice");
        }
    
        public function filter_invoice($search, $order_field, $order_ascdesc,$status)
        {
            if($search!=""){
                $this->db->like('invoice_kode', $search);
                $this->db->or_like('jo_id', $search);
                $this->db->or_like('customer_name', $search);
                $this->db->or_like('tanggal_invoice', $search);
                $this->db->or_like('batas_pembayaran', $search);
                $this->db->or_like('grand_total', $search);
            }
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_invoice.customer_id", 'left');
            $hasil = $this->db->get('skb_invoice')->result_array();

            if($status!="x"){
                $hasil_fix = [];
                for($i=0;$i<count($hasil);$i++){
                    if($hasil[$i]["status_bayar"]==$status){
                        $hasil_fix[] = $hasil[$i];
                    }
                }
                return $hasil_fix;
            }else{
                return $hasil;
            }
        }
    
        public function count_filter_invoice($search,$status)
        {
            if($search!=""){
                $this->db->like('invoice_kode', $search);
                $this->db->or_like('jo_id', $search);
                $this->db->or_like('customer_name', $search);
                $this->db->or_like('tanggal_invoice', $search);
                $this->db->or_like('batas_pembayaran', $search);
                $this->db->or_like('grand_total', $search);
            }
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_invoice.customer_id", 'left');
            $hasil = $this->db->get('skb_invoice')->num_rows();

            if($search!=""){
                $this->db->like('invoice_kode', $search);
                $this->db->or_like('jo_id', $search);
                $this->db->or_like('customer_name', $search);
                $this->db->or_like('tanggal_invoice', $search);
                $this->db->or_like('batas_pembayaran', $search);
                $this->db->or_like('grand_total', $search);
            }
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_invoice.customer_id", 'left');
            $hasil_data = $this->db->get('skb_invoice')->result_array();

            if($status!="x"){
                // $this->db->where("status_bayar",$status);
                $hasil_fix = 0;
                for($i=0;$i<count($hasil_data);$i++){
                    if($hasil_data[$i]["status_bayar"]==$status){
                        $hasil_fix +=1;
                    }
                }
                return $hasil_fix;
            }else{
                return $hasil;
            }
        }
    // end Function Invoice
    
    // Function Invoice Belum Lunas
        public function count_all_invoice_belum_lunas($customer_id)
        {
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_invoice.customer_id", 'left');
     
            return $this->db->count_all_results("skb_invoice");
        }
    
        public function filter_invoice_belum_lunas($search, $limit, $start, $order_field, $order_ascdesc,$customer_id)
        {
            if($customer_id!="x"){
                $this->db->where("skb_invoice.customer_id",$customer_id);
            }
            $this->db->where("status_bayar","Belum Lunas");
            $this->db->like('invoice_kode', $search);
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);

            $this->db->join("skb_customer", "skb_customer.customer_id = skb_invoice.customer_id", 'left');
            return $this->db->get('skb_invoice')->result_array();
        }
    
        public function count_filter_invoice_belum_lunas($search,$customer_id)
        {
            if($customer_id!="x"){
                $this->db->where("skb_invoice.customer_id",$customer_id);
            }
            $this->db->where("status_bayar","Belum Lunas");
            $this->db->like('invoice_kode', $search);
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_invoice.customer_id", 'left');
            return $this->db->get('skb_invoice')->num_rows();
        }
    // end Function Invoice Belum Lunas

    // Function InvoiceLunas
        public function count_all_invoice_lunas($customer_id)
        {
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_invoice.customer_id", 'left');
     
            return $this->db->count_all_results("skb_invoice");
        }
    
        public function filter_invoice_lunas($search, $limit, $start, $order_field, $order_ascdesc,$customer_id)
        {
            if($customer_id!="x"){
                $this->db->where("skb_invoice.customer_id",$customer_id);
            }
            $this->db->where("status_bayar","Lunas");
            $this->db->like('invoice_kode', $search);
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);

            $this->db->join("skb_customer", "skb_customer.customer_id = skb_invoice.customer_id", 'left');
            return $this->db->get('skb_invoice')->result_array();
        }
    
        public function count_filter_invoice_lunas($search,$customer_id)
        {
            if($customer_id!="x"){
                $this->db->where("skb_invoice.customer_id",$customer_id);
            }
            $this->db->where("status_bayar","Lunas");
            $this->db->like('invoice_kode', $search);
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_invoice.customer_id", 'left');
            return $this->db->get('skb_invoice')->num_rows();
        }
    // end Function InvoiceLunas
    
    //  Function Akun
        public function count_all_akun()
        {
            return $this->db->count_all_results("skb_akun");
        }

        public function filter_akun($search, $limit, $start, $order_field, $order_ascdesc)
        {
            $this->db->like('akun_id', $search);
            $this->db->or_like('akun_name', $search);
            $this->db->or_like('akun_role', $search);
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            return $this->db->get('skb_akun')->result_array();
        }

        public function count_filter_akun($search)
        {
            $this->db->like('akun_id', $search);
            $this->db->or_like('akun_name', $search);
            $this->db->or_like('akun_role', $search);
            return $this->db->get('skb_akun')->num_rows();
        }
    //  end Function Akun

    // Function rute
        function getRuteData($postData,$asal,$customer){
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
                $search_arr[] = " (rute_id like '%".$searchValue."%' or 
                    rute_dari like '%".$searchValue."%' or 
                    rute_muatan like '%".$searchValue."%' or 
                    rute_ke like '%".$searchValue."%') ";
            }
            $search_arr[] = " rute_status_hapus='NO' ";
            if($asal=="addjo"){
                $search_arr[] = "validasi_rute = 'ACC'";
                $search_arr[] = "validasi_rute_edit = 'ACC'";
                $search_arr[] = "validasi_rute_delete = 'ACC'";
            }

            if(count($search_arr) > 0){ //gabung kondisi where
                $searchQuery = implode(" and ",$search_arr);
            }
        
            ## Total record without filtering
            $this->db->select('count(*) as allcount');
            $this->db->where("rute_status_hapus","NO");
            $records = $this->db->get('skb_rute')->result();
            $totalRecords = $records[0]->allcount;
        
            ## Total record with filtering
            $this->db->select('count(*) as allcount');
            if($searchQuery != ''){
                $this->db->where($searchQuery);
            }
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_rute.customer_id", 'left');
            if($customer!="x"){
                $this->db->where("skb_customer.customer_id",$customer);
            }
            $records = $this->db->get('skb_rute')->result();
            $totalRecordwithFilter = $records[0]->allcount;
        
            ## data hasil record
            $this->db->select('*');
            if($searchQuery != ''){
                $this->db->where($searchQuery);
            }
            $this->db->order_by($columnName, $columnSortOrder);
            $this->db->limit($rowperpage, $start);
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_rute.customer_id", 'left');
            if($customer!="x"){
                $this->db->where("skb_customer.customer_id",$customer);
            }
            $records = $this->db->get('skb_rute')->result();
        
            $data = array();
            $n = 1;
            foreach($records as $record ){
                $data[] = array( 
                    "no"=>$n,
                    "rute_id"=>$record->rute_id,
                    "customer_name"=>$record->customer_name,
                    "rute_ke"=>$record->rute_ke,
                    "jenis_mobil"=>$record->jenis_mobil,
                    "rute_dari"=>$record->rute_dari,
                    "rute_tagihan"=>$record->rute_tagihan,
                    "rute_muatan"=>$record->rute_muatan,
                    "rute_uj_engkel"=>$record->rute_uj_engkel,
                    "rute_gaji_engkel"=>$record->rute_gaji_engkel,
                    "validasi_rute"=>$record->validasi_rute,
                    "validasi_rute_edit"=>$record->validasi_rute_edit,
                    "validasi_rute_delete"=>$record->validasi_rute_delete,
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
    // end Function rute

    //function-fiunction datatable JO
        public function count_all_konfirmasi_JO()
        {
            $this->db->where("status","Dalam Perjalanan");
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_job_order.customer_id", 'left');
            return $this->db->count_all_results("skb_job_order");
        }

        public function filter_konfirmasi_JO($search, $order_field, $order_ascdesc)
        {
            if($search!=""){
                $this->db->like('JO_id', $search);
                $this->db->or_like('muatan', $search);
                $this->db->or_like('asal', $search);
                $this->db->or_like('tujuan', $search);
            }
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_job_order.customer_id", 'left');
            $hasil = $this->db->get('skb_job_order')->result_array();
            $hasil_fix = [];
            for($i=0;$i<count($hasil);$i++){
                if($hasil[$i]["status"]=="Dalam Perjalanan" && ($hasil[$i]["parent_Jo_id"]=="x" || $hasil[$i]["parent_Jo_id"]=="y")){
                    $hasil_fix[] = $hasil[$i];
                }
            }
            return $hasil_fix;
        }

        public function count_filter_konfirmasi_JO($search)
        {   
            if($search!=""){
                $this->db->like('JO_id', $search);
                $this->db->or_like('muatan', $search);
                $this->db->or_like('asal', $search);
                $this->db->or_like('tujuan', $search);
            }
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_job_order.customer_id", 'left');
            $hasil_data = $this->db->get('skb_job_order')->result_array();
            $hasil_fix = 0;
            for($i=0;$i<count($hasil_data);$i++){
                if($hasil_data[$i]["status"]=="Dalam Perjalanan" && ($hasil_data[$i]["parent_Jo_id"]=="x" || $hasil_data[$i]["parent_Jo_id"]=="y")){
                    $hasil_fix +=1;
                }
            }
            return $hasil_fix;

        }
    //akhir function-fiunction datatable JO

    //function-fiunction datatable merk
        function getMerkData($postData,$asal){
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
                $search_arr[] = " (merk_type like '%".$searchValue."%' or 
                    merk_nama like '%".$searchValue."%' or 
                    merk_jenis like '%".$searchValue."%') ";
            }
            $search_arr[] = " status_hapus='NO' ";
            if($asal=="addtruck"){
                $search_arr[] = " validasi='ACC' ";
                $search_arr[] = " validasi_edit='ACC' ";
                $search_arr[] = " validasi_delete='ACC' ";
            }

            if(count($search_arr) > 0){ //gabung kondisi where
                $searchQuery = implode(" and ",$search_arr);
            }
        
            ## Total record without filtering
            $this->db->select('count(*) as allcount');
            $this->db->where("status_hapus","NO");
            if($asal=="addtruck"){
                $this->db->where("validasi","ACC");
                $this->db->where("validasi_edit","ACC");
                $this->db->where("validasi_delete","ACC");
            }
            $records = $this->db->get('skb_merk_kendaraan')->result();
            $totalRecords = $records[0]->allcount;
        
            ## Total record with filtering
            $this->db->select('count(*) as allcount');
            if($searchQuery != ''){
                $this->db->where($searchQuery);
            }
            $records = $this->db->get('skb_merk_kendaraan')->result();
            $totalRecordwithFilter = $records[0]->allcount;
        
            ## data hasil record
            $this->db->select('*');
            if($searchQuery != ''){
                $this->db->where($searchQuery);
            }
            $this->db->order_by($columnName, $columnSortOrder);
            $this->db->limit($rowperpage, $start);
            $records = $this->db->get('skb_merk_kendaraan')->result();
        
            $data = array();
            $n = 1;
            foreach($records as $record ){
                $data[] = array( 
                    "no"=>$n,
                    "merk_id"=>$record->merk_id,
                    "merk_nama"=>$record->merk_nama,
                    "merk_type"=>$record->merk_type,
                    "merk_dump"=>$record->merk_dump,
                    "merk_jenis"=>$record->merk_jenis,
                    "validasi"=>$record->validasi,
                    "validasi_edit"=>$record->validasi_edit,
                    "validasi_delete"=>$record->validasi_delete,
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
    //akhir function-fiunction datatable merk
}