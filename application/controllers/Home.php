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
            if(json_decode($data["akun_akses"]["akun_akses"])[1]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/joborder');
            $this->load->view('footer');
        }

        public function view_JO(){
            $search = $_POST['search']['value'];
            $status = $this->input->post('status_JO');
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            $sql_total = $this->model_home->count_all_JO($status);
            $sql_data = $this->model_home->filter_JO($search,$order_field, $order_ascdesc,$status);
            $sql_filter = $this->model_home->count_filter_JO($search,$status);
            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
            );

            header('Content-Type: application/json');
            echo json_encode($callback);
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
        public function view_Customer(){
            $search = $_POST['search']['value'];
            $limit = $_POST['length'];
            $start = $_POST['start'];
            
            // $tanggal,$bulan,$tahun
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            $sql_total = $this->model_home->count_all_Customer();
            $sql_data = $this->model_home->filter_Customer($search, $limit, $start, $order_field, $order_ascdesc);
            $sql_filter = $this->model_home->count_filter_Customer($search);
            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
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
            if(json_decode($data["akun_akses"]["akun_akses"])[0]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/customer');
            $this->load->view('footer');
        }
    // end Customer

    // Supir
        public function view_Supir(){
            $search = $_POST['search']['value'];
            $limit = $_POST['length'];
            $start = $_POST['start'];
            
            // $tanggal,$bulan,$tahun
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            $sql_total = $this->model_home->count_all_supir();
            $sql_data = $this->model_home->filter_supir($search, $limit, $start, $order_field, $order_ascdesc);
            $sql_filter = $this->model_home->count_filter_supir($search);
            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
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
            if(json_decode($data["akun_akses"]["akun_akses"])[0]==0){
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
            if(json_decode($data["akun_akses"]["akun_akses"])[2]==0){
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
            if(json_decode($data["akun_akses"]["akun_akses"])[3]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/report_gaji');
            $this->load->view('footer');
        }      
    //end gaji report supir

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
            if(json_decode($data["akun_akses"]["akun_akses"])[2]==0){
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
            if(json_decode($data["akun_akses"]["akun_akses"])[0]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/truck');
            $this->load->view('footer');
        }
        public function view_truck(){
            $search = $_POST['search']['value'];
            $limit = $_POST['length'];
            $start = $_POST['start'];
            // $status = $this->input->post('searchStatus');
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            $sql_total = $this->model_home->count_all_truck();
            $sql_data = $this->model_home->filter_truck($search, $limit, $start, $order_field, $order_ascdesc);
            $sql_filter = $this->model_home->count_filter_truck($search);
            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
            );

            header('Content-Type: application/json');
            echo json_encode($callback);
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
            if(json_decode($data["akun_akses"]["akun_akses"])[3]==0){
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
        if(json_decode($data["akun_akses"]["akun_akses"])[3]==0){
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
            if(json_decode($data["akun_akses"]["akun_akses"])[1]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/invoice');
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
            if($_SESSION["role"]!="Super User"){
                redirect(base_url("index.php/home/"));
            }
            $data["page"] = "Akun_page";
            $data["collapse_group"] = "Konfigurasi";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akun_akses"])[4]==0){
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

    //satuan muatan
        public function satuan()
        {
            if(!$_SESSION["user"]){
                $this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["page"] = "Satuan_page";
            $data["collapse_group"] = "Master_Data";
            $data["satuan"] = $this->model_home->getallsatuan();
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akun_akses"])[0]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/satuan');
            $this->load->view('footer');
        }
    // end satuan muatan
}
