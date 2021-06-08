<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    //construck
        public function __construct()
        {
            parent::__construct();
            $this->load->model('model_home');//load model
            $this->load->model('model_form');//load model
        }
    //end construck

    //fungsi untuk JO
        public function index()
        {
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["page"] = "JO_page";
            $data["collapse_group"] = "Perintah_Kerja";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[1]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/joborder');
            $this->load->view('footer');
        }

        public function konfirmasi_jo()
        {
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["page"] = "Konfirmasi_JO_page";
            $data["collapse_group"] = "Perintah_Kerja";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[2]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/konfirmasi_jo');
            $this->load->view('footer');
        }

        public function view_konfirmasi_JO(){
            $status = "Dalam Perjalanan";
            $postData = $this->input->post();
            $data = $this->model_home->getJOData($postData,$status);
            echo json_encode($data);
        }

        public function view_JO(){
            $status = $this->input->post('status_JO');
            $postData = $this->input->post();
            $data = $this->model_home->getJOData($postData,$status);
            echo json_encode($data);
        }
        public function view_JO_report(){
            $tanggal = $this->input->post('tanggal');
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            $status = $this->input->post('status_JO');
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            $sql_total = $this->model_home->count_all_JO_report($tanggal,$bulan,$tahun,$status);
            $sql_data = $this->model_home->filter_JO_report($order_field, $order_ascdesc,$tanggal,$bulan,$tahun,$status);
            $sql_filter = $this->model_home->count_filter_JO_report($tanggal,$bulan,$tahun,$status);
            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
            );

            header('Content-Type: application/json');
            echo json_encode($callback);
        }
    //end fungsi untuk JO

    // Customer
        public function view_Customer($asal){
            $search = $_POST['search']['value'];
            $limit = $_POST['length'];
            $start = $_POST['start'];
            
            // $tanggal,$bulan,$tahun
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            $sql_total = $this->model_home->count_all_Customer($asal);
            $sql_data = $this->model_home->filter_Customer($asal,$search, $limit, $start, $order_field, $order_ascdesc);
            $sql_filter = $this->model_home->count_filter_Customer($asal,$search);
            $data = array();
            for($i=0;$i<count($sql_data);$i++){
                array_push($data, $sql_data[$i]);
            }
            $no = $start + 1;
            for($i=0;$i<count($data);$i++){
                $data[$i]['nomor'] = $no;   
                $no++;
            }
            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $data
            );

            header('Content-Type: application/json');
            echo json_encode($callback);
        }
        public function customer()
        {
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["page"] = "Customer_page";
            $data["collapse_group"] = "Master_Data";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[0]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/customer');
            $this->load->view('footer');
        }
    // end Customer

    // Supir
        public function view_Supir($asal){
            $search = $_POST['search']['value'];
            $limit = $_POST['length'];
            $start = $_POST['start'];
            
            // $tanggal,$bulan,$tahun
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            $sql_total = $this->model_home->count_all_supir($asal);
            $sql_data = $this->model_home->filter_supir($asal,$search, $limit, $start, $order_field, $order_ascdesc);
            $sql_filter = $this->model_home->count_filter_supir($asal,$search);

            $data = array();
            for($i=0;$i<count($sql_data);$i++){
                array_push($data, $sql_data[$i]);
            }
            $no = $start + 1;
            for($i=0;$i<count($data);$i++){
                $tanggal = $data[$i]["supir_tgl_sim"];
                $tanggal_now = date("Y-m-d");
                $tgl1 = new DateTime($tanggal_now);
                $tgl2 = new DateTime($tanggal);
                $d = $tgl2->diff($tgl1)->days + 1;
                if($tanggal_now<$tanggal){
                    $data[$i]['sisa'] = "-".$d." hari";   
                }else{
                    $data[$i]['sisa'] = "+".$d." hari";   
                }
                $data[$i]['no'] = $no;   
                $no++;
            }

            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $data
            );

            header('Content-Type: application/json');
            echo json_encode($callback);
        }
        public function penggajian()
        {
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["page"] = "Supir_page";
            $data["collapse_group"] = "Master_Data";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[0]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/penggajian');
            $this->load->view('footer');
        }      
    //end supir

    //gaji supir
        public function gaji()
        {
            if(!$_SESSION["user"]){
                $this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["page"] = "Gaji_page";
            $data["collapse_group"] = "Penggajian";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[6]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/gaji');
            $this->load->view('footer');
        }      
    //end gaji supir

    //gaji report supir
        public function report_gaji()
        {
            if(!$_SESSION["user"]){
                $this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["page"] = "Laporan_Gaji_page";
            $data["collapse_group"] = "Laporan";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[9]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/report_gaji');
            $this->load->view('footer');
        }      
    //end gaji report supir

    //report bon supir
        public function report_bon()
        {
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["page"] = "Laporan_Bon_page";
            $data["collapse_group"] = "Laporan";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[10]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/report_bon');
            $this->load->view('footer');
        }
    //report bon supir

    // bon
        public function bon()
        {
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["page"] = "Bon_page";
            $data["collapse_group"] = "Penggajian";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[5]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/bon');
            $this->load->view('footer');
        }
        public function view_bon(){
            $search = $_POST['search']['value'];
            $limit = $_POST['length'];
            $start = $_POST['start'];
            // $status = $this->input->post('searchStatus');
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            $sql_total = $this->model_home->count_all_bon();
            $sql_data = $this->model_home->filter_bon($search, $limit, $start, $order_field, $order_ascdesc);
            $sql_filter = $this->model_home->count_filter_bon($search);
            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
            );

            header('Content-Type: application/json');
            echo json_encode($callback);
        }
    //end bon

    //fungsi untuk truk
        public function truck()
        {
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["truck"] = $this->model_home->gettruck();
            $data["page"] = "Kendaraan_page";
            $data["collapse_group"] = "Master_Data";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[0]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/truck');
            $this->load->view('footer');
        }
        public function view_truck(){
            $postData = $this->input->post();
            $data = $this->model_home->getTruckData($postData);
            echo json_encode($data);
        }
    //end fungsi untuk truk
    
    // funngsi report 
        public function report()
        {
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["page"] = "Laporan_page";
            $data["collapse_group"] = "Laporan";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[7]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/report');
            $this->load->view('footer');
        }
    // end funngsi report 

    // funngsi report uang jalan 
        public function report_uang_jalan()
        {
            if(!$_SESSION["user"]){
                $this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["page"] = "Laporan_Uang_Jalan_page";
            $data["collapse_group"] = "Laporan";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[8]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/report_uang_jalan');
            $this->load->view('footer');
        }
    // end funngsi report uang jalan 

    // Invoice
        public function view_invoice(){
            $search = $_POST['search']['value'];
            // $limit = $_POST['length'];
            // $start = $_POST['start'];
            $status = $this->input->post('status_bayar');
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            $sql_total = $this->model_home->count_all_invoice($status);
            $sql_data = $this->model_home->filter_invoice($search,$order_field, $order_ascdesc,$status);
            $sql_filter = $this->model_home->count_filter_invoice($search,$status);
            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
            );

            header('Content-Type: application/json');
            echo json_encode($callback);
        }

        public function view_invoice_belum_lunas(){
            $search = $_POST['search']['value'];
            $limit = $_POST['length'];
            $start = $_POST['start'];
            $customer_id = $this->input->post('customer_id');
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            $sql_total = $this->model_home->count_all_invoice_belum_lunas($customer_id);
            $sql_data = $this->model_home->filter_invoice_belum_lunas($search, $limit, $start, $order_field, $order_ascdesc,$customer_id);
            $sql_filter = $this->model_home->count_filter_invoice_belum_lunas($search,$customer_id);
            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
            );

            header('Content-Type: application/json');
            echo json_encode($callback);
        }

        public function view_invoice_lunas(){
            $search = $_POST['search']['value'];
            $limit = $_POST['length'];
            $start = $_POST['start'];
            $customer_id = $this->input->post('customer_id');
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            $sql_total = $this->model_home->count_all_invoice_lunas($customer_id);
            $sql_data = $this->model_home->filter_invoice_lunas($search, $limit, $start, $order_field, $order_ascdesc,$customer_id);
            $sql_filter = $this->model_home->count_filter_invoice_lunas($search,$customer_id);
            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
            );

            header('Content-Type: application/json');
            echo json_encode($callback);
        }
        
        public function invoice()
        {
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["page"] = "Invoice_page";
            $data["collapse_group"] = "Perintah_Kerja";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            $data["customer"] = $this->model_home->getcustomer();
            if(json_decode($data["akun_akses"]["akses"])[3]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/invoice');
            $this->load->view('footer');
        }

        public function invoice_customer()
        {
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["page"] = "Invoice_Customer_page";
            $data["collapse_group"] = "Perintah_Kerja";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            $data["customer"] = $this->model_home->getcustomer();
            if(json_decode($data["akun_akses"]["akses"])[4]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/invoice_customer');
            $this->load->view('footer');
        }
    // end Invoice

    //Akun
        public function akun()
        {
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["page"] = "Akun_page";
            $data["collapse_group"] = "Konfigurasi";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[11]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/akun');
            $this->load->view('footer');
        }

        public function view_akun(){
            $search = $_POST['search']['value'];
            $limit = $_POST['length'];
            $start = $_POST['start'];
            
            // $tanggal,$bulan,$tahun
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            $sql_total = $this->model_home->count_all_akun();
            $sql_data = $this->model_home->filter_akun($search, $limit, $start, $order_field, $order_ascdesc);
            $sql_filter = $this->model_home->count_filter_akun($search);
            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
            );

            header('Content-Type: application/json');
            echo json_encode($callback);
        }
    //end Akun

    //rute dan muatan
        public function satuan()
        {
            if(!$_SESSION["user"]){
                $this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["page"] = "Satuan_page";
            $data["collapse_group"] = "Master_Data";
            $data["mobil"] = $this->model_form->getallmobil();
            $data["customer"] = $this->model_home->getcustomer();
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[0]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/rute_muatan');
            $this->load->view('footer');
        }
        public function view_rute($asal){
            $search = $_POST['search']['value'];
            $customer = $this->input->post('customer');
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            $sql_total = $this->model_home->count_all_rute($asal,$customer);
            $sql_data = $this->model_home->filter_rute($asal,$customer,$search,$order_field, $order_ascdesc);
            $sql_filter = $this->model_home->count_filter_rute($asal,$customer,$search);
            $data = array();
            for($i=0;$i<count($sql_data);$i++){
                array_push($data, $sql_data[$i]);
            }
            $no = 1;
            for($i=0;$i<count($data);$i++){
                $data[$i]['no'] = $no;   
                $no++;
            }
            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $data
            );

            header('Content-Type: application/json');
            echo json_encode($callback);
        }
    // end rute dan muatan

    //fungsi untuk merk
        public function merk()
        {
            if(!$_SESSION["user"]){
                $this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["merk"] = $this->model_home->getmerk();
            $data["page"] = "Merk_page";
            $data["collapse_group"] = "Master_Data";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[0]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/merk');
            $this->load->view('footer');
        }
        public function view_merk($asal){
            $search = $_POST['search']['value'];
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            $sql_total = $this->model_home->count_all_merk($asal);
            $sql_data = $this->model_home->filter_merk($asal,$search, $order_field, $order_ascdesc);
            $sql_filter = $this->model_home->count_filter_merk($asal,$search);
            $data = array();
            for($i=0;$i<count($sql_data);$i++){
                array_push($data, $sql_data[$i]);
            }
            $no = 1;
            for($i=0;$i<count($data);$i++){
                $data[$i]['no'] = $no;   
                $no++;
            }
            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $data
            );

            header('Content-Type: application/json');
            echo json_encode($callback);
        }
    //end fungsi untuk merk

    //fungsi untuk kosongan
        public function kosongan()
        {
            if(!$_SESSION["user"]){
                $this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["page"] = "Kosongan_page";
            $data["collapse_group"] = "Master_Data";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[0]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/kosongan');
            $this->load->view('footer');
        }
        public function view_kosongan(){
            $search = $_POST['search']['value'];
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            $sql_total = $this->model_home->count_all_kosongan();
            $sql_data = $this->model_home->filter_kosongan($search, $order_field, $order_ascdesc);
            $sql_filter = $this->model_home->count_filter_kosongan($search);
            $data = array();
            for($i=0;$i<count($sql_data);$i++){
                array_push($data, $sql_data[$i]);
            }
            $no = 1;
            for($i=0;$i<count($data);$i++){
                $data[$i]['no'] = $no;   
                $no++;
            }
            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $data
            );

            header('Content-Type: application/json');
            echo json_encode($callback);
        }
    //end fungsi untuk kosongan

    //fungsi untuk paketan
        public function paketan()
        {
            if(!$_SESSION["user"]){
                $this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["kosongan"] = $this->model_home->getkosongan();
            $data["page"] = "Paketan_page";
            $data["collapse_group"] = "Master_Data";
            $data["customer"] = $this->model_home->getcustomer();
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[0]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/paketan');
            $this->load->view('footer');
        }
        public function view_paketan($asal){
            $search = $_POST['search']['value'];
            $customer = $this->input->post('customer');
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            $sql_total = $this->model_home->count_all_paketan($asal,$customer);
            $sql_data = $this->model_home->filter_paketan($asal,$customer,$search, $order_field, $order_ascdesc);
            $sql_filter = $this->model_home->count_filter_paketan($asal,$customer,$search);
            $data = array();
            for($i=0;$i<count($sql_data);$i++){
                array_push($data, $sql_data[$i]);
            }
            $no = 1;
            for($i=0;$i<count($data);$i++){
                $data[$i]['no'] = $no;   
                $no++;
            }
            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $data
            );

            header('Content-Type: application/json');
            echo json_encode($callback);
        }
    //end fungsi untuk paketan
}
