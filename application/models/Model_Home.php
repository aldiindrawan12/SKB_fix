<?php
// error_reporting(0);
class Model_Home extends CI_model
{
    public function gettruck() //all truck
    {
        return $this->db->get_where("skb_mobil",array("status_hapus"=>"NO"))->result_array();
    }

    // public function getallsatuan() //all satuan
    // {
    //     return $this->db->get("skb_satuan")->result_array();
    // }

    public function getmobilbyid($mobil_no) //mobil by ID
    {
        return $this->db->get_where("skb_mobil",array("mobil_no"=>$mobil_no))->row_array();
    }

    public function getcustomer() //all customer
    {
        return $this->db->get("skb_customer")->result_array();
    }

    public function getcustomerbyid($customer_id) //customer by ID
    {
        return $this->db->get_where("skb_customer",array("customer_id"=>$customer_id))->row_array();
    }

    public function getsupir() //all supir
    {
        return $this->db->get_where("skb_supir",array("status_hapus"=>"NO"))->result_array();
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
        return $this->db->get_where("skb_job_order",array("Jo_id"=>$jo_id))->row_array();
    }

     //function-fiunction datatable truck
        public function count_all_truck()
        {
            $this->db->where("status_hapus","NO");
            return $this->db->count_all_results("skb_mobil");
        }

        public function filter_truck($search, $limit, $start, $order_field, $order_ascdesc)
        {
            $this->db->like('mobil_no', $search);
            // $this->db->or_like('mobil_jenis', $search);
            $this->db->where("status_hapus","NO");
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            return $this->db->get('skb_mobil')->result_array();
        }

        public function count_filter_truck($search)
        {
            $this->db->like('mobil_no', $search);
            // $this->db->or_like('mobil_jenis', $search);
            $this->db->where("status_hapus","NO");
            return $this->db->get('skb_mobil')->num_rows();
        }
     //akhir function-fiunction datatable truck

     //function-fiunction datatable JO
        public function count_all_JO($status)
        {
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_job_order.customer_id", 'left');
            return $this->db->count_all_results("skb_job_order");
        }

        public function filter_JO($search, $order_field, $order_ascdesc,$status)
        {
            if($search!=""){
                $this->db->like('JO_id', $search);
                $this->db->or_like('customer_name', $search);
                $this->db->or_like('muatan', $search);
                $this->db->or_like('asal', $search);
                $this->db->or_like('tujuan', $search);
            }
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_job_order.customer_id", 'left');
            $hasil = $this->db->get('skb_job_order')->result_array();
            if($status!="x"){
                $hasil_fix = [];
                for($i=0;$i<count($hasil);$i++){
                    if($hasil[$i]["status"]==$status){
                        $hasil_fix[] = $hasil[$i];
                    }
                }
                return $hasil_fix;
            }else{
                return $hasil;
            }
        }

        public function count_filter_JO($search,$status)
        {   
            if($search!=""){
                $this->db->like('JO_id', $search);
                $this->db->or_like('customer_name', $search);
                $this->db->or_like('muatan', $search);
                $this->db->or_like('asal', $search);
                $this->db->or_like('tujuan', $search);
            }
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_job_order.customer_id", 'left');
            $hasil_data = $this->db->get('skb_job_order')->result_array();

            if($search!=""){
                $this->db->like('JO_id', $search);
                $this->db->or_like('customer_name', $search);
                $this->db->or_like('muatan', $search);
                $this->db->or_like('asal', $search);
                $this->db->or_like('tujuan', $search);
            }
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_job_order.customer_id", 'left');
            $hasil = $this->db->get('skb_job_order')->num_rows();

            if($status!="x"){
                $hasil_fix = 0;
                for($i=0;$i<count($hasil_data);$i++){
                    if($hasil_data[$i]["status"]==$status){
                        $hasil_fix +=1;
                    }
                }
                return $hasil_fix;
            }else{
                return $hasil;
            }
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
            // $this->db->limit($limit, $start);
            $this->db->join("skb_supir", "skb_supir.supir_id = skb_job_order.supir_id", 'left');
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_job_order.customer_id", 'left');
            return $this->db->get('skb_job_order')->result_array();
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
            return $this->db->get('skb_job_order')->num_rows();
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
        public function count_all_customer()
        {
            $this->db->where("status_hapus","NO");
            return $this->db->count_all_results("skb_customer");
        }

        public function filter_customer($search, $limit, $start, $order_field, $order_ascdesc)
        {
            // $this->db->like('customer_id', $search);
            $this->db->where("status_hapus","NO");
            $this->db->like('customer_name', $search);
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            return $this->db->get('skb_customer')->result_array();
        }

        public function count_filter_customer($search)
        {
            // $this->db->like('customer_id', $search);
            $this->db->where("status_hapus","NO");
            $this->db->like('customer_name', $search);
            return $this->db->get('skb_customer')->num_rows();
        }
    //  end Function Customer

    //  Function Supir
        public function count_all_supir()
        {
            $this->db->where("status_hapus","NO");
            return $this->db->count_all_results("skb_supir");
        }

        public function filter_supir($search, $limit, $start, $order_field, $order_ascdesc)
        {
            // $this->db->like('supir_id', $search);
            $this->db->like('supir_name', $search);
            $this->db->where("status_hapus","NO");
            // $this->db->or_like('status_jalan', $search);
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            return $this->db->get('skb_supir')->result_array();
        }

        public function count_filter_supir($search)
        {
            // $this->db->like('supir_id', $search);
            $this->db->like('supir_name', $search);
            $this->db->where("status_hapus","NO");
            // $this->db->or_like('status_jalan', $search);
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
        public function count_all_rute()
        {
            $this->db->where("skb_rute.rute_status_hapus","No");
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_rute.customer_id", 'left');
            return $this->db->count_all_results("skb_rute");
        }

        public function filter_rute($search, $order_field, $order_ascdesc)
        {
            if($search!=""){
                $this->db->like('rute_id', $search);
                $this->db->or_like('customer_name', $search);
                $this->db->or_like('rute_dari', $search);
                $this->db->or_like('rute_ke', $search);
                $this->db->or_like('rute_muatan', $search);
            }
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_rute.customer_id", 'left');
            $hasil = $this->db->get('skb_rute')->result_array();
            $hasil_fix = [];
            for($i=0;$i<count($hasil);$i++){
                if($hasil[$i]["rute_status_hapus"]=="NO"){
                    $hasil_fix[] = $hasil[$i];
                }
            }
            return $hasil_fix;
        }

        public function count_filter_rute($search)
        {
            if($search!=""){
                $this->db->like('rute_id', $search);
                $this->db->or_like('customer_name', $search);
                $this->db->or_like('rute_dari', $search);
                $this->db->or_like('rute_ke', $search);
                $this->db->or_like('rute_muatan', $search);
            }
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_rute.customer_id", 'left');
            $hasil_data = $this->db->get('skb_rute')->result_array();
                $hasil_fix = 0;
                for($i=0;$i<count($hasil_data);$i++){
                    if($hasil_data[$i]["rute_status_hapus"]=="NO"){
                        $hasil_fix +=1;
                    }
                }
                return $hasil_fix;           
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
                $this->db->or_like('customer_name', $search);
                $this->db->or_like('muatan', $search);
                $this->db->or_like('asal', $search);
                $this->db->or_like('tujuan', $search);
            }
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_job_order.customer_id", 'left');
            $hasil = $this->db->get('skb_job_order')->result_array();
            $hasil_fix = [];
            for($i=0;$i<count($hasil);$i++){
                if($hasil[$i]["status"]=="Dalam Perjalanan"){
                    $hasil_fix[] = $hasil[$i];
                }
            }
            return $hasil_fix;
        }

        public function count_filter_konfirmasi_JO($search)
        {   
            if($search!=""){
                $this->db->like('JO_id', $search);
                $this->db->or_like('customer_name', $search);
                $this->db->or_like('muatan', $search);
                $this->db->or_like('asal', $search);
                $this->db->or_like('tujuan', $search);
            }
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_job_order.customer_id", 'left');
            $hasil_data = $this->db->get('skb_job_order')->result_array();
            $hasil_fix = 0;
            for($i=0;$i<count($hasil_data);$i++){
                if($hasil_data[$i]["status"]=="Dalam Perjalanan"){
                    $hasil_fix +=1;
                }
            }
            return $hasil_fix;

        }
    //akhir function-fiunction datatable JO
}