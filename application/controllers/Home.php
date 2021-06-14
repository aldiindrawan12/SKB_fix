<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    //construck
        public function __construct()
        {
            parent::__construct();
            $this->load->model('model_home');//load model
            $this->load->model('model_form');//load model
            $this->load->model('model_detail');//load model
        }
    //end construck

    //fungsi untuk JO
        public function index()
        {
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["supir"] = $this->model_home->getallsupir();
            $data["mobil"] = $this->model_home->gettruck();
            $data["customer"] = $this->model_home->getallcustomer();
            $data["jo"] = $this->model_home->getjo();
            $data["page"] = "JO_page";
            $data["collapse_group"] = "Job_Order";
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
            $data["collapse_group"] = "Job_Order";
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
            $data = array(
                "Supir" => "",
                "Kendaraan" => "",
                "Jenis" => "",
                "Customer" => "",
                "Jo_id" => "",
                "Tanggal1" => "",
                "Tanggal2" => "",
            );
            $postData = $this->input->post();
            $data = $this->model_home->getJOData($postData,$status,$data);
            echo json_encode($data);
        }

        public function view_JO(){
            $Status = $this->input->post('Status');
            $data = array(
                "Supir" => $this->input->post('Supir'),
                "Kendaraan" => $this->input->post('Kendaraan'),
                "Jenis" => $this->input->post('Jenis'),
                "Customer" => $this->input->post('Customer'),
                "Jo_id" => $this->input->post('Jo_id'),
                "Tanggal1" => $this->input->post('Tanggal1'),
                "Tanggal2" => $this->input->post('Tanggal2'),
            );
            $postData = $this->input->post();
            $data = $this->model_home->getJOData($postData,$Status,$data);
            echo json_encode($data);
        }

        public function getditemukanjo(){
            $data = array(
                "Supir" => $this->input->post('Supir'),
                "Kendaraan" => $this->input->post('Kendaraan'),
                "Jenis" => $this->input->post('Jenis'),
                "Customer" => $this->input->post('Customer'),
                "Jo_id" => $this->input->post('Jo_id'),
                "Tanggal1" => $this->input->post('Tanggal1'),
                "Tanggal2" => $this->input->post('Tanggal2'),
                "Status" => $this->input->post('Status')
            );
            $data_filter = $this->model_home->getDitemukanJo($data);
            echo $data_filter;
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
            $data["pembayaran_upah"] = $this->model_detail->getpembayaranupah();
            $gaji = 0;
            for($i=0;$i<count($data["pembayaran_upah"]);$i++){
                if($data["pembayaran_upah"][$i]["pembayaran_upah_status"]=="Belum Lunas"){
                    $gaji = $gaji + $data["pembayaran_upah"][$i]["pembayaran_upah_total"];
                }
            }
            $data["gaji"]=$gaji;
            $data["supir"] = $this->model_home->getallsupir();
            $data["page"] = "Laporan_Gaji_page";
            $data["collapse_group"] = "Penggajian";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[9]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('detail/penggajian_report',$data);
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
            $data["collapse_group"] = "Kasbon";
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

    //mutasi bon supir
        public function saldo_bon()
        {
            if(!$_SESSION["user"]){
                $this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["supir"] = $this->model_home->getsupir();
            $data["page"] = "Saldo_Bon_page";
            $data["collapse_group"] = "Kasbon";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[12]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('home/saldo_bon');
            $this->load->view('footer');
        }
    //mutasi bon supir

    // bon
        public function bon()
        {
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["supir"] = $this->model_home->getallsupir();
            $data["bon"]=$this->model_home->getbon();
            $data["page"] = "Bon_page";
            $data["collapse_group"] = "Kasbon";
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
            $No_Bon = $this->input->post('No_Bon1')."-".$this->input->post('No_Bon2')."-".$this->input->post('No_Bon3')."-".$this->input->post('No_Bon4');
            $data = array(
                "Supir" => $this->input->post('Supir'),
                "Tanggal1" => $this->input->post('Tanggal1'),
                "Tanggal2" => $this->input->post('Tanggal2'),
                "Status" => $this->input->post('Status'),
                "No_Bon" => $No_Bon,
            );
            $limit = $_POST['length'];
            $start = $_POST['start'];
            // $status = $this->input->post('searchStatus');
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            $sql_total = $this->model_home->count_all_bon();
            $sql_data = $this->model_home->filter_bon( $limit, $start, $order_field, $order_ascdesc,$data);
            $sql_filter = $this->model_home->count_filter_bon($data);
            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
            );

            header('Content-Type: application/json');
            echo json_encode($callback);
        }

        public function getditemukanbon(){
            $No_Bon = $this->input->post('No_Bon1')."-".$this->input->post('No_Bon2')."-".$this->input->post('No_Bon3')."-".$this->input->post('No_Bon4');
            $data = array(
                "Supir" => $this->input->post('Supir'),
                "Tanggal1" => $this->input->post('Tanggal1'),
                "Tanggal2" => $this->input->post('Tanggal2'),
                "Status" => $this->input->post('Status'),
                "No_Bon" => $No_Bon,
            );
            $data_filter = $this->model_home->getDitemukanBon($data);
            echo $data_filter;
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
        public function view_seluruh_invoice(){
            $No_Invoice = $this->input->post('No_Bon1')."-".$this->input->post('No_Bon2')."-".$this->input->post('No_Bon3')."-".$this->input->post('No_Bon4');
            $data = array(
                "Status" => $this->input->post('Status'),
                "Customer" => $this->input->post('Customer'),
                "Tanggal_Top" => $this->input->post('Tanggal_Top'),
                "Tanggal1" => $this->input->post('Tanggal1'),
                "Tanggal2" => $this->input->post('Tanggal2'),
                "Ppn" => $this->input->post('Ppn'),
                "No_Invoice" => $No_Invoice,
            );
            $postData = $this->input->post();
            $data = $this->model_home->getAllInvoiceData($postData,$data);
            echo json_encode($data);
        }
        public function getditemukaninvoice(){
            $No_Invoice = $this->input->post('No_Invoice1')."-".$this->input->post('No_Invoice2')."-".$this->input->post('No_Invoice3')."-".$this->input->post('No_Invoice4');
            $data = array(
                "Status" => $this->input->post('Status'),
                "Customer" => $this->input->post('Customer'),
                "Tanggal_Top" => $this->input->post('Tanggal_Top'),
                "Tanggal1" => $this->input->post('Tanggal1'),
                "Tanggal2" => $this->input->post('Tanggal2'),
                "Ppn" => $this->input->post('Ppn'),
                "No_Invoice" => $No_Invoice,
            );
            $data_filter = $this->model_home->getDitemukanInvoice($data);
            $tagihan = 0;
            for($i=0;$i<count($data_filter);$i++){
                $tagihan = $tagihan + $data_filter[$i]["grand_total"];
            }
            echo count($data_filter)."=".number_format($tagihan,2,",",".");
        }

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
            $data["collapse_group"] = "Invoice";
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
            $data["invoice"] = $this->model_home->getinvoice();
            $tagihan = 0;
            for($i=0;$i<count($data["invoice"]);$i++){
                $tagihan = $tagihan + $data["invoice"][$i]["grand_total"];
            }
            $data["tagihan"] = $tagihan;
            $data["page"] = "Invoice_Customer_page";
            $data["collapse_group"] = "Invoice";
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

        public function no_invoice(){
            // $customer_name = $this->input->get("customer_name");
            $invoice_id = $this->model_form->getinvoiceid();
            $isi_invoice_id = [];
            for($i=0;$i<count($invoice_id);$i++){
                $explode_invoice = explode("-",$invoice_id[$i]["invoice_kode"]);
                if(count($explode_invoice)>1){
                    if($explode_invoice[2]==date("m") && $explode_invoice[3]==date('Y')){
                        $isi_invoice_id[] = $explode_invoice[0];
                    }
                }
            }
            if(count($isi_invoice_id)==0){
                $isi_invoice_id[]=0;
            }
            echo (max($isi_invoice_id)+1);
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
            $customer = $this->input->post('customer');
            $postData = $this->input->post();
            $data = $this->model_home->getRuteData($postData,$asal,$customer);
            echo json_encode($data);
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
            $postData = $this->input->post();
            $data = $this->model_home->getMerkData($postData,$asal);
            echo json_encode($data);
        }
    //end fungsi untuk merk
}
