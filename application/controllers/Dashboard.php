<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    //construck
        public function __construct()
        {
            parent::__construct();
            $this->load->model('model_home');//load model
            $this->load->model('model_form');//load model
            $this->load->model('model_dashboard');//load model
        }
    //end construck

    public function index()
    {
        if(!$_SESSION["user"]){
    		$this->session->set_flashdata('status-login', 'False');
            redirect(base_url());
        }
        $data["page"] = "Dashboard_page";
        $data["collapse_group"] = "Dashboard";
        $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
        if(json_decode($data["akun_akses"]["akun_akses"])[1]==0){
            redirect(base_url());
        }
        $this->load->view('header',$data);
        $this->load->view('sidebar');
        $this->load->view('dashboard/dashboard');
    }    
    public function view_truck($fungsi){
        $search = $_POST['search']['value'];
        $order_index = $_POST['order'][0]['column'];
        $order_field = $_POST['columns'][$order_index]['data'];
        $order_ascdesc = $_POST['order'][0]['dir'];
        $sql_total = $this->model_dashboard->count_all_truck($fungsi);
        $sql_data = $this->model_dashboard->filter_truck($fungsi,$search, $order_field, $order_ascdesc);
        $sql_filter = $this->model_dashboard->count_filter_truck($fungsi,$search);
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
    public function view_supir($fungsi){
        $search = $_POST['search']['value'];
        $order_index = $_POST['order'][0]['column'];
        $order_field = $_POST['columns'][$order_index]['data'];
        $order_ascdesc = $_POST['order'][0]['dir'];
        $sql_total = $this->model_dashboard->count_all_supir($fungsi);
        $sql_data = $this->model_dashboard->filter_supir($fungsi,$search, $order_field, $order_ascdesc);
        $sql_filter = $this->model_dashboard->count_filter_supir($fungsi,$search);
        
        $callback = array(
            'draw' => $_POST['draw'],
            'recordsTotal' => $sql_total,
            'recordsFiltered' => $sql_filter,
            'data' => $sql_data
        );

        header('Content-Type: application/json');
        echo json_encode($callback);
    }
    public function view_invoice_jatuh_tempo(){
        $search = $_POST['search']['value'];
        $order_index = $_POST['order'][0]['column'];
        $order_field = $_POST['columns'][$order_index]['data'];
        $order_ascdesc = $_POST['order'][0]['dir'];
        $sql_total = $this->model_dashboard->count_all_invoice_jatuh_tempo();
        $sql_data = $this->model_dashboard->filter_invoice_jatuh_tempo($search,$order_field, $order_ascdesc);
        $sql_filter = $this->model_dashboard->count_filter_invoice_jatuh_tempo($search);
        $data = array();
        for($i=0;$i<count($sql_data);$i++){
            array_push($data, $sql_data[$i]);
        }
        $no = 1;
        for($i=0;$i<count($data);$i++){
            //tanggal pembayaran invoice dan sisa hari
            $tgl_invoice = $data[$i]["tanggal_invoice"];
            $tanggal = date('Y-m-d', strtotime('+'.$data[$i]["batas_pembayaran"].' days', strtotime($tgl_invoice)));
            $tanggal_now = date("Y-m-d");
            $tgl1 = new DateTime($tanggal_now);
            $tgl2 = new DateTime($tanggal);
            $d = $tgl2->diff($tgl1)->days + 1;

            $data[$i]['no'] = $no;   
            $data[$i]['tgl_batas_pembayaran'] = $tanggal;   
            $data[$i]['batas_pembayaran'] = $d;   
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
    public function view_JO_no_invoice(){
        $search = $_POST['search']['value'];
        $status = "Sampai Tujuan";
        $order_index = $_POST['order'][0]['column'];
        $order_field = $_POST['columns'][$order_index]['data'];
        $order_ascdesc = $_POST['order'][0]['dir'];
        $sql_total = $this->model_dashboard->count_all_JO($status);
        $sql_data = $this->model_dashboard->filter_JO($search,$order_field, $order_ascdesc,$status);
        $sql_filter = $this->model_dashboard->count_filter_JO($search,$status);
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
}