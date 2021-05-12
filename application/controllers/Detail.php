<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends CI_Controller {
    // contruck
        public function __construct()
        {
            parent::__construct();
            $this->load->model('model_home');//load model
            $this->load->model('model_detail');//load model
            $this->load->model('model_form');//load model
            $this->load->model('model_print');//load model
        }
    // end contruck

    //fungsi untuk Detail JO dan invoice
        public function updatesupirjo($jo_id,$supir_id_old){
            $this->model_detail->updatesupirjo($jo_id,$this->input->post("Supir"),$supir_id_old);
    		$this->session->set_flashdata('supir_jo', 'Berhasil');
            redirect(base_url("index.php/detail/detail_jo/".$jo_id."/JO"));
        }
        public function updatemobiljo($jo_id,$mobil_no_old){
            $this->model_detail->updatemobiljo($jo_id,$this->input->post("Mobil"),str_replace("%20"," ",$mobil_no_old));
    		$this->session->set_flashdata('mobil_jo', 'Berhasil');
            redirect(base_url("index.php/detail/detail_jo/".$jo_id."/JO"));
        }
        public function detail_jo($Jo_id,$asal)
        {
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["jo"] = $this->model_home->getjobyid($Jo_id);
            $data["customer"] = $this->model_home->getcustomerbyid($data["jo"]["customer_id"]);
            $data["mobil"] = $this->model_home->getmobilbyid($data["jo"]["mobil_no"]);
            $data["supir"] = $this->model_home->getsupirbyid($data["jo"]["supir_id"]);
            $data["all_supir"] = $this->model_detail->getsupir();
            $data["all_mobil"] = $this->model_detail->getmobil($data["mobil"]["mobil_jenis"]);
            if($asal=="JO"){
                $data["page"] = "JO_page";
                $data["collapse_group"] = "Perintah_Kerja";
            }else if($asal=="uang_jalan"){
                $data["page"] = "Laporan_Uang_Jalan_page";
                $data["collapse_group"] = "Laporan";
            }else{
                $data["page"] = "Laporan_page";
                $data["collapse_group"] = "Laporan";
            }

            if($data["jo"]["paketan_id"]!=0){
                $data["tipe_jo"]="paketan";
                $data["paketan"] = $this->model_form->getpaketanbyid($data["jo"]["paketan_id"]);
                $data["kosongan"] = $this->model_detail->getkosonganbyid(0,$Jo_id);
            }else{     
                $data["tipe_jo"]="reguler";
                $data["kosongan"] = $this->model_detail->getkosonganbyid($data["jo"]["kosongan_id"],$Jo_id);
            }
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[1]==0 && json_decode($data["akun_akses"]["akses"])[8]==0 && json_decode($data["akun_akses"]["akses"])[7]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('detail/joborder');
            $this->load->view('footer');
        }
        public function detail_invoice($invoice_id)
        {
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["invoice"] = $this->model_detail->getinvoicebyid(str_replace("%20"," ",$invoice_id));
            $paketan_id = [];
            $kosongan_id = [];
            for($i=0;$i<count($data["invoice"]);$i++){
                $data_paketan = $this->model_form->getpaketanbyid($data["invoice"][$i]["paketan_id"]);
                $paketan_id[] = $data_paketan;
                $data_kosongan = $this->model_print->getkosonganbyid($data["invoice"][$i]["kosongan_id"]);
                if($data_kosongan){
                    $kosongan_id[] = $data_kosongan;    
                }
            }
            $data["paketan"] = $paketan_id;
            $data["kosongan"] = $kosongan_id;
            $data["customer"] = $this->model_home->getcustomerbyid($data["invoice"][0]["customer_id"]);
            $data["page"] = "Invoice_Customer_page";
            $data["collapse_group"] = "Perintah_Kerja";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[4]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('detail/invoice');
            $this->load->view('footer');
        }
        public function updatestatusjo($supir,$mobil){
            $data_jo = $this->model_home->getjobyid($this->input->post("jo_id"));
            $keterangan = "<strong>Catatan JO : </strong>".$data_jo["keterangan"]."<br><strong>Catatan Konfirmasi : </strong>".$this->input->post("Keterangan");
            $TOD = $this->input->post("TOD");
            $data = array(
                "tonase"=>$this->input->post("tonase"),
                "bonus"=>str_replace(".","",$this->input->post("bonus")),
                "keterangan"=>$keterangan,
                "tanggal_bongkar"=>date('Y-m-d'),
                "Jo_id"=>$this->input->post("jo_id")
            );
            $this->model_detail->updatestatusjo($data,$supir,$mobil);
            redirect(base_url("index.php/detail/detail_jo/").$this->input->post("jo_id")."/JO");
        }

        public function updateUJ($jo_id){
            $data_jo = $this->model_home->getjobyid($jo_id);
            $keterangan = $data_jo["keterangan"]."<br>".$this->input->post("Keterangan");
            $uj = $data_jo["uang_jalan_bayar"]+str_replace(".","",$this->input->post("uang_jalan_bayar"));
            $this->model_detail->updateUJ($jo_id,$keterangan,$uj);
            redirect(base_url("index.php/detail/detail_jo/").$jo_id."/JO");
        }

        public function updateinvoice(){
            $invoice_kode = $this->input->post("invoice-kode");
            $this->model_detail->updateinvoice($invoice_kode);
            redirect(base_url("index.php/detail/detail_invoice/").$invoice_kode."/Invoice");
        }

        public function updatejobatal($Jo_id){
            $data_jo = $this->model_home->getjobyid($Jo_id);
            $data["data_jo"]=$data_jo;
            $bon_id = $this->model_form->getbonid();
            $isi_bon_id = [];
            for($i=0;$i<count($bon_id);$i++){
                $isi_bon_id[] = $bon_id[$i]["bon_id"];
            }
            date_default_timezone_set('Asia/Jakarta');
            $data["data"]=array(
                "bon_id"=>max($isi_bon_id)+1,
                "supir_id"=>$data_jo["supir_id"],
                "bon_jenis"=>"Pembatalan JO",
                "bon_nominal"=>$data_jo["uang_jalan"],
                "bon_keterangan"=>"Pembatalan JO",
                "bon_tanggal"=>date("Y-m-d H:i:s")
            );
            $data["bon_id"] = max($isi_bon_id)+1;
            $this->model_form->insert_bon($data["data"]);
            $this->model_detail->update_jo_dibatalkan($data_jo["Jo_id"],$data_jo["supir_id"],$data_jo["mobil_no"],$data_jo["uang_jalan"]);
            $data["supir"] = $this->model_home->getsupirbyid($data["data"]["supir_id"]);
            $data["asal"] = "batal JO";
            $this->load->view("print/bon_print",$data);
        }
        public function getjo(){
            $jo_id = $this->input->get('id');
            $data = $this->model_home->getjobyid($jo_id);
            echo json_encode($data);       
        }
        public function hapus_jo($jo_id){
            $data_jo = $this->model_home->getjobyid($jo_id);
            $data["data_jo"]=$data_jo;
            $bon_id = $this->model_form->getbonid();
            $isi_bon_id = [];
            for($i=0;$i<count($bon_id);$i++){
                $isi_bon_id[] = $bon_id[$i]["bon_id"];
            }
            date_default_timezone_set('Asia/Jakarta');
            $data["data"]=array(
                "bon_id"=>max($isi_bon_id)+1,
                "supir_id"=>$data_jo["supir_id"],
                "bon_jenis"=>"Pembatalan JO",
                "bon_nominal"=>$data_jo["uang_jalan_bayar"],
                "bon_keterangan"=>"Pembatalan JO",
                "bon_tanggal"=>date("Y-m-d H:i:s")
            );
            $data["bon_id"] = max($isi_bon_id)+1;
            $this->model_form->insert_bon($data["data"]);
            $data["supir"] = $this->model_home->getsupirbyid($data["data"]["supir_id"]);
            $data["asal"] = "Hapus JO";
            $this->load->view("print/bon_print",$data);
            
            $this->model_detail->hapus_jo($jo_id);
        }
    //end fungsi untuk Detail jo dan invoice

    //fungsi untuk Detail customer
        public function detail_customer($customer_id)
        {
            
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["customer"] = $this->model_home->getcustomerbyid($customer_id);
            $data["page"] = "Invoice_Customer_page";
            $data["collapse_group"] = "Perintah_Kerja";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[4]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('detail/customer',$data);
            $this->load->view('footer');
        }
        function getcustomer()
        {
            $customer_id = $this->input->get('id');
            $data = $this->model_home->getcustomerbyid($customer_id);
            echo json_encode($data);
        }
    //end fungsi untuk Detail customer

    //fungsi untuk Detail bon
        function getbon()
        {
            $bon_id = $this->input->get('id');
            $data = $this->model_detail->getbonbyid($bon_id);
            echo json_encode($data);
        }
    //end fungsi untuk Detail bon
    
    //fungsi untuk Detail report bon
        function detail_report_bon($supir_id)
        {
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["transaksi_bon"] = $this->model_detail->getbonbysupir($supir_id);
            $data["supir"] = $this->model_home->getsupirbyid($supir_id)["supir_name"];
            $data["page"] = "Laporan_Bon_page";
            $data["collapse_group"] = "Laporan";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[10]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('detail/laporan_bon');
            $this->load->view('footer');
        }
    //end fungsi untuk Detail report bon
    
    //fungsi untuk Detail truck
        function gettruck()
        {
            $truck_id = $this->input->get('id');
            $data = $this->model_detail->gettruckbyid($truck_id);
            echo json_encode($data);
        }
    //end fungsi untuk Detail ttruckk

    //fungsi untuk Detail kosongan
        function getkosongan()
        {
            $kosongan_id = $this->input->get('id');
            $jo_id = $this->input->get('jo');
            $data = $this->model_detail->getkosonganbyid($kosongan_id,$jo_id);
            echo json_encode($data);
        }
    //end fungsi untuk Detail kosongan

    //fungsi untuk Detail merk
        function getmerk()
        {
            $merk_id = $this->input->get('id');
            $data = $this->model_detail->getmerkbyid($merk_id);
            echo json_encode($data);
        }
        function getallmerk()
        {
            $data = $this->model_detail->getallmerk();
            echo json_encode($data);
        }
    //end fungsi untuk Detail merk

    //fungsi untuk Detail supir
        function getsupir()
        {
            $supir_id = $this->input->get('id');
            $data = $this->model_home->getsupirbyid($supir_id);
            echo json_encode($data);
        }
    //end fungsi untuk Detail supir

    //fungsi untuk Detail penggajian
        public function detail_penggajian($supir_id)
        {
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            if($this->input->post("bonus")==""){
                $bonus=0;
            }else{
                $bonus=$this->input->post("bonus");
            }
            if($this->input->post("kasbon")==""){
                $kasbon=0;
            }else{
                $kasbon = $this->input->post("kasbon");
            }
            $data["pilih_jo"] = array(
                "jo_id" => $this->input->post("jo"),
                "gaji_total" => $this->input->post("gaji_total"),
                "gaji_grand_total" => $this->input->post("gaji_grand_total"),
                "bonus" => $bonus,
                "kasbon" => $kasbon
            );
            $data_jo = [];
            $data_jo_form = explode(",",$this->input->post("jo"));
            for($i=0;$i<count($data_jo_form);$i++){
                $jo = $this->model_home->getjobyid($data_jo_form[$i]);
                $data_jo[] = $jo;
            }
            $data["jo"]=$data_jo;
            $data["supir"] = $this->model_home->getsupirbyid($supir_id);
            $data["page"] = "Gaji_page";
            $data["collapse_group"] = "Penggajian";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[6]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('detail/penggajian',$data);
            $this->load->view('footer');
        }

        public function pilih_gaji($supir_id)
        {
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["jo"] = $this->model_detail->getjobbysupir($supir_id);
            $data["supir"] = $this->model_home->getsupirbyid($supir_id);
            $data["page"] = "Gaji_page";
            $data["collapse_group"] = "Penggajian";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[6]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('detail/pilih_gaji',$data);
        }

        public function detail_penggajian_report($supir_id)
        {
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["pembayaran_upah"] = $this->model_detail->getpembayaranupah($supir_id);
            $data["supir"] = $this->model_home->getsupirbyid($supir_id);
            $data["page"] = "Laporan_Gaji_page";
            $data["collapse_group"] = "Laporan";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[9]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('detail/penggajian_report',$data);
            $this->load->view('footer');
        }

        public function detail_penggajian_report_pembayaran($supir_id,$pembayaran_id)
        {
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["pembayaran_upah"] = $this->model_detail->getpembayaranupahbyid($pembayaran_id);
            $data["supir"] = $this->model_home->getsupirbyid($supir_id);
            $data["page"] = "Laporan_Gaji_page";
            $data["collapse_group"] = "Laporan";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[9]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('detail/penggajian_report_pembayaran',$data);
            $this->load->view('footer');
        }

        public function update_upah(){
            $data = array(
                "supir_id"=>$this->input->get("supir_id"),
                "kasbon"=>str_replace(".","",$this->input->get("kasbon")),
                "gaji_grand_total"=>str_replace(".","",$this->input->get("gaji_grand_total")),
                "gaji_total"=>str_replace(".","",$this->input->get("gaji_total")),
                "bonus"=>str_replace(".","",$this->input->get("bonus")),
                "Jo_id"=>$this->input->get("jo_id")
            );
            $this->model_detail->update_upah($data);
            echo $data["supir_id"]."=".$data["kasbon"]."=".$data["gaji_grand_total"]."=".$data["gaji_total"]."=".$data["bonus"];
        }
    //end fungsi untuk Detail penggajian
    
    function getrute()
    {
        $rute_id = $this->input->get('id');
        $data = $this->model_detail->getrutebyid($rute_id);
        echo json_encode($data);
    }

    function getpaketan()
    {
        $paketan_id = $this->input->get('id');
        $data = $this->model_form->getpaketanbyid($paketan_id);
        echo json_encode($data);
    }
    
}