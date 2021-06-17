<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {
    //construck
        public function __construct()
        {
            parent::__construct();
            $this->load->model('model_home');//load model
            $this->load->model('model_form');//load model
            $this->load->model('model_detail');//load model
        }
    //end construck

    public function payment_invoice($invoice_kode)
    {
        if(!$_SESSION["user"]){
    		$this->session->set_flashdata('status-login', 'False');
            redirect(base_url());
        }
        $data["invoice_kode"] = $invoice_kode;
        $data["invoice"] = $this->model_detail->getinvoicepayment($invoice_kode);
        $data["payment_invoice"] = $this->model_detail->getpaymentinvoice($invoice_kode);
        $data["page"] = "Invoice_Customer_page";
        $data["collapse_group"] = "Invoice";
        $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
        $this->load->view('header',$data);
        $this->load->view('sidebar');
        $this->load->view("payment/payment_invoice");
    }
}