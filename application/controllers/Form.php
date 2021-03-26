<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('model_form');//load model
        $this->load->model('model_home');//load model
    }

    // fungsi view form
        public function joborder($customer_name){
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["customer"] = $this->model_home->getcustomer();
            $data["customer_by_name"] = $this->model_form->getcustomerbyname($customer_name);
            if($data["customer_by_name"] == null){
                $data["customer_by_name"] = [];
            }
            $data["mobil"] = $this->model_home->gettruck();
            $data["supir"] = $this->model_home->getsupir();
            $data["page"] = "JO_page";
            $data["collapse_group"] = "Perintah_Kerja";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('form/joborder');
            $this->load->view('footer');
        }

        public function bon(){
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["supir"] = $this->model_home->getsupir();
            $data["page"] = "Bon_page";
            $data["collapse_group"] = "Penggajian";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('form/form_bon',$data);
            $this->load->view('footer');
        }

        public function view_pilih_jo(){
            $customer_id = $this->input->post("customer");
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            $sql_total = $this->model_form->count_all_jo($customer_id);
            $sql_data = $this->model_form->filter_jo($order_field, $order_ascdesc,$customer_id);
            $sql_filter = $this->model_form->count_filter_jo($customer_id);
            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
            );

            header('Content-Type: application/json');
            echo json_encode($callback);
        }
    // end fungsi view form

    // fungsi insert
        public function insert_invoice(){
            $data=array(
                "customer_id"=>$this->input->post("customer_id"),
                "invoice_kode"=>$this->input->post("invoice_id1").$this->input->post("invoice_id2").$this->input->post("invoice_id3"),
                "tanggal_invoice"=>$this->input->post("invoice_tgl"),
                "total_tonase"=>$this->input->post("invoice_tonase"),
                "total"=>$this->input->post("invoice_total"),
                "ppn"=>$this->input->post("invoice_ppn_nilai"),
                "grand_total"=>$this->input->post("invoice_grand_total"),
                "batas_pembayaran"=>$this->input->post("invoice_payment"),
                "invoice_keterangan"=>$this->input->post("invoice_keterangan"),
                "status_bayar"=>"Belum Lunas"
            );
            $data_jo = explode(",",$this->input->post("data_jo"));
            $this->model_form->insert_invoice($data,$data_jo);
            redirect(base_url("index.php/home/invoice"));
        }
        public function insert_JO(){
            $jo_id = $this->model_form->getjoid();
            $isi_jo_id = [];
            for($i=0;$i<count($jo_id);$i++){
                $isi_jo_id[] = $jo_id[$i]["Jo_id"];
            }
            $data["data"]=array(
                "Jo_id"=>max($isi_jo_id)+1,
                "mobil_no"=>$this->input->post("Kendaraan"),
                "supir_id"=>$this->input->post("Supir"),
                "muatan"=>$this->input->post("Muatan"),
                "asal"=>$this->input->post("Asal"),
                "tujuan"=>$this->input->post("Tujuan"),
                "uang_jalan"=>str_replace(".","",$this->input->post("Uang")),
                "terbilang"=>$this->input->post("Terbilang"),
                "tanggal_surat"=>date("Y-m-d"),
                "keterangan"=>$this->input->post("Keterangan"),
                "customer_id"=>$this->input->post("Customer"),
                "status"=>"Dalam Perjalanan",
                "status_upah"=>"Belum Dibayar",
                "upah"=>str_replace(".","",$this->input->post("Upah")),
            );
            $this->model_form->insert_JO($data["data"]);
            $data["jo_id"] = max($isi_jo_id)+1;
            $data["asal"] = "insert";
            $data["supir"] = $this->model_home->getsupirbyid($data["data"]["supir_id"]);
            $data["mobil"] = $this->model_home->getmobilbyid($data["data"]["mobil_no"]);
            $this->load->view("print/jo_print",$data);
        }

        public function insert_bon(){
            $bon_id = $this->model_form->getbonid();
            $isi_bon_id = [];
            for($i=0;$i<count($bon_id);$i++){
                $isi_bon_id[] = $bon_id[$i]["bon_id"];
            }

            date_default_timezone_set('Asia/Jakarta');
            $data["data"]=array(
                "bon_id"=>max($isi_bon_id)+1,
                "supir_id"=>$this->input->post("Supir_bon"),
                "bon_jenis"=>$this->input->post("Jenis"),
                "bon_nominal"=>str_replace(".","",$this->input->post("Nominal")),
                "bon_keterangan"=>$this->input->post("Keterangan"),
                "bon_tanggal"=>date("Y-m-d H:i:s")
            );
            $data["bon_id"] = max($isi_bon_id)+1;
            $this->model_form->insert_bon($data["data"]);
            $data["supir"] = $this->model_home->getsupirbyid($data["data"]["supir_id"]);
            $data["asal"] = "insert";
            $data["data_jo"] = array("Jo_id"=>"0");
            $this->load->view("print/bon_print",$data);
        }

        public function insert_akun(){
            $data_akun=array(
                "akun_name"=>$this->input->post("nama"),
                "akun_role"=>$this->input->post("role"),
                "akun_akses"=>'["1","1","1","1","1"]'
            );
            $this->model_form->insert_akun($data_akun);
            $akun = $this->model_form->getakunbyname($data_akun["akun_name"]);
            $data_user=array(
                "akun_id" => $akun["akun_id"],
                "username"=>$this->input->post("username"),
                "password"=>sha1($this->input->post("password"))
            );
            $this->model_form->insert_user($data_user);
			$this->session->set_flashdata('status-add-akun', 'Berhasil');
            redirect(base_url("index.php/home/akun"));
        }

        public function insert_customerMenu(){
            $data=array(
                "customer_name"=>$this->input->post("Customer"),
                "customer_alamat"=>$this->input->post("customer_alamat"),
                "customer_kontak_person"=>$this->input->post("customer_kontak_person"),
                "customer_telp"=>$this->input->post("customer_telp"),
                "customer_keterangan"=>$this->input->post("customer_keterangan"),
                "customer_bank"=>$this->input->post("customer_bank"),
                "customer_rekening"=>$this->input->post("customer_rekening"),
                "customer_AN"=>$this->input->post("customer_AN"),
                "status_hapus"=>"No"
            );
            echo var_dump($data);
            $this->model_form->insert_customer($data);
			$this->session->set_flashdata('status-add-customer', 'Berhasil');
            redirect(base_url("index.php/home/customer"));
        }

        public function insert_supir(){
            $data=array(
                "supir_name"=>$this->input->post("Supir"),
                "supir_kasbon"=>0,
                "status_jalan"=>"Tidak Jalan",
                "status_hapus"=>"NO",
                "supir_alamat"=>$this->input->post("supir_alamat"),
                "supir_telp"=>$this->input->post("supir_telp"),
                "supir_ktp"=>$this->input->post("supir_ktp"),
                "supir_sim"=>$this->input->post("supir_sim"),
                "supir_keterangan"=>$this->input->post("supir_keterangan")
            );
            // echo($data["customer_name"]);
            $this->model_form->insert_supir($data);
			$this->session->set_flashdata('status-add-supir', 'Berhasil');
            redirect(base_url("index.php/home/penggajian"));
        }

        public function insert_truck(){
            $data=array(
                "mobil_no"=>$this->input->post("mobil_no"),
                "mobil_jenis"=>$this->input->post("mobil_jenis"),
                "mobil_max_load"=>$this->input->post("mobil_max_load"),
                "status_jalan"=>"Tidak Jalan",
                "status_hapus"=>"NO",
                "mobil_keterangan"=>$this->input->post("mobil_keterangan"),
                "mobil_merk"=>$this->input->post("mobil_merk"),
                "mobil_type"=>$this->input->post("mobil_type"),
                "mobil_dump"=>$this->input->post("mobil_dump"),
                "mobil_tahun"=>$this->input->post("mobil_tahun"),
                "mobil_berlaku"=>$this->input->post("mobil_berlaku"),
                "mobil_pajak"=>$this->input->post("mobil_pajak")
            );
            // echo var_dump($data);
            $this->model_form->insert_truck($data);
			$this->session->set_flashdata('status-add-kendaraan', 'Berhasil');
            redirect(base_url("index.php/home/truck"));
        }

        public function insert_rute(){
            if($this->input->post("Tonase")==""){
                $rute_gaji_engkel = str_replace(".","",$this->input->post("rute_gaji_engkel"));
                $rute_gaji_tronton = str_replace(".","",$this->input->post("rute_gaji_tronton"));
                $rute_gaji_engkel_rumusan = 0;
                $rute_gaji_tronton_rumusan = 0;
                $tonase = 0;
            }else{
                $rute_gaji_engkel = 0;
                $rute_gaji_tronton = 0;
                $rute_gaji_engkel_rumusan = str_replace(".","",$this->input->post("rute_gaji_engkel_rumusan"));
                $rute_gaji_tronton_rumusan = str_replace(".","",$this->input->post("rute_gaji_tronton_rumusan"))     ;
                $tonase = str_replace(".","",$this->input->post("Tonase"));
            }
            $data=array(
                "customer_id"=>$this->input->post("customer_id"),
                "rute_dari"=>$this->input->post("rute_dari"),
                "rute_ke"=>$this->input->post("rute_ke"),
                "rute_muatan"=>$this->input->post("rute_muatan"),
                "rute_uj_engkel"=>str_replace(".","",$this->input->post("rute_uj_engkel")),
                "rute_uj_tronton"=>str_replace(".","",$this->input->post("rute_uj_tronton")),
                "rute_tagihan"=>str_replace(".","",$this->input->post("rute_tagihan")),
                "rute_gaji_engkel"=>$rute_gaji_engkel,
                "rute_gaji_tronton"=>$rute_gaji_tronton,
                "rute_tonase"=>$tonase,
                "rute_gaji_engkel_rumusan"=>$rute_gaji_engkel_rumusan,
                "rute_gaji_tronton_rumusan"=>$rute_gaji_tronton_rumusan,
                "rute_status_hapus"=>"NO"
            );
            // echo var_dump($data);
            $this->model_form->insert_rute($data);
			$this->session->set_flashdata('status-add-satuan', 'Berhasil');
            redirect(base_url("index.php/home/satuan"));
        }
    // end fungsi insert
    
    // fungsi lain
        public function update_rute(){
            $data=array(
                "customer_id"=>$this->input->post("customer_id_update"),
                "rute_dari"=>$this->input->post("rute_dari_update"),
                "rute_ke"=>$this->input->post("rute_ke_update"),
                "rute_muatan"=>$this->input->post("rute_muatan_update"),
                "rute_uj_engkel"=>str_replace(".","",$this->input->post("rute_uj_engkel_update")),
                "rute_uj_tronton"=>str_replace(".","",$this->input->post("rute_uj_tronton_update")),
                "rute_tagihan"=>str_replace(".","",$this->input->post("rute_tagihan_update")),
                "rute_gaji_engkel"=>str_replace(".","",$this->input->post("rute_gaji_engkel_update")),
                "rute_gaji_tronton"=>str_replace(".","",$this->input->post("rute_gaji_tronton_update")),
                "rute_gaji_engkel_rumusan"=>str_replace(".","",$this->input->post("rute_gaji_engkel_rumusan_update")),
                "rute_gaji_tronton_rumusan"=>str_replace(".","",$this->input->post("rute_gaji_tronton_rumusan_update")),
                "rute_tonase"=>str_replace(".","",$this->input->post("rute_tonase_update")),
            );
            // echo var_dump($data);
            $this->model_form->update_rute($data,$this->input->post("rute_id_update"));
            $this->session->set_flashdata('status-update-satuan', 'Berhasil');
            redirect(base_url("index.php/home/satuan"));
        }
        public function update_supir(){
            $data = array(
                "supir_name" => $this->input->post("supir_name"),
                "supir_id" => $this->input->post("supir_id"),
                "supir_alamat" => $this->input->post("supir_alamat_update"),
                "supir_telp" => $this->input->post("supir_telp_update"),
                "supir_ktp" => $this->input->post("supir_ktp_update"),
                "supir_sim" => $this->input->post("supir_sim_update"),
                "supir_keterangan" => $this->input->post("supir_keterangan_update"),
            );
            $this->model_form->update_supir($data);
            $this->session->set_flashdata('status-update-supir', 'Berhasil');
            redirect(base_url("index.php/home/penggajian"));
        }
        public function update_truck(){
            $data = array(
                "mobil_no" => $this->input->post("mobil_no_update"),
                "mobil_berlaku" => $this->input->post("mobil_berlaku_update"),
                "mobil_pajak" => $this->input->post("mobil_pajak_update"),
                "mobil_keterangan" => $this->input->post("mobil_keterangan_update")
            );
            // echo var_dump($data);
            $this->model_form->update_truck($data);
            $this->session->set_flashdata('status-update-truck', 'Berhasil');
            redirect(base_url("index.php/home/truck"));
        }

        public function update_customer(){
            $data = array(
                "customer_id" => $this->input->post("customer_id_update"),
                "customer_name" => $this->input->post("customer_name_update"),
                "customer_alamat" => $this->input->post("customer_alamat_update"),
                "customer_kontak_person" => $this->input->post("customer_kontak_person_update"),
                "customer_telp" => $this->input->post("customer_telp_update"),
                "customer_bank" => $this->input->post("customer_bank_update"),
                "customer_rekening" => $this->input->post("customer_rekening_update"),
                "customer_AN" => $this->input->post("customer_AN_update"),
                "customer_keterangan" => $this->input->post("customer_keterangan_update"),
            );
            // echo var_dump($data);
            $this->model_form->update_customer($data);
            $this->session->set_flashdata('status-update-customer', 'Berhasil');
            redirect(base_url("index.php/home/customer"));
        }

        public function update_akun(){
            $akun = $this->model_form->getakunbyid($this->input->post("akun_id"));
            $password = $this->input->post("password_update");
            if($akun["password"]!=$this->input->post("password_update")){
                $password = sha1($password);
            }
            $data = array(
                "akun_id" => $this->input->post("akun_id"),
                "akun_name" => $this->input->post("akun_name"),
                "akun_role" => $this->input->post("role_update"),
                "username" => $this->input->post("username_update"),
                "password" => $password
            );
            $this->model_form->update_akun($data);
            $this->session->set_flashdata('status-update-akun', 'Berhasil');
            redirect(base_url("index.php/home/akun"));
        }

        public function deletesupir(){
            $supir_id = $this->input->get("id");
            $this->model_form->deletesupir($supir_id);
            $this->session->set_flashdata('status-delete-supir', 'Berhasil');
            echo $supir_id;
        }

        public function deletecustomer(){
            $customer_id = $this->input->get("id");
            $this->model_form->deletecustomer($customer_id);
            $this->session->set_flashdata('status-delete-customer', 'Berhasil');
            echo $customer_id;
        }

        public function deleterute(){
            $rute_id = $this->input->get("id");
            $this->model_form->deleterute($rute_id);
            $this->session->set_flashdata('status-delete-satuan', 'Berhasil');
            echo $rute_id;
        }

        public function deleteakun(){
            $akun_id = $this->input->get("id");
            $this->model_form->deleteakun($akun_id);
            $this->session->set_flashdata('status-delete-akun', 'Berhasil');
            echo $akun_id;
        }

        public function deletetruck(){
            $mobil_no = $this->input->get("id");
            $this->model_form->deletetruck($mobil_no);
            $this->session->set_flashdata('status-delete-kendaraan', 'Berhasil');
            echo $mobil_no;
        }

        public function getsupirname(){
            $supir_id = $this->input->get("id");
            $supir = $this->model_form->getsupirname($supir_id);
            echo json_encode($supir);
        }

        public function getrutebyid(){
            $rute_id = $this->input->get("id");
            $rute = $this->model_form->getrutebyid($rute_id);
            echo json_encode($rute);
        }

        public function generate_terbilang($uang){
            $uang = abs($uang);
            $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "sebelas");
            $temp = "";

            if ($uang < 12) {
                $temp = " ". $huruf[$uang];
            } else if ($uang <20) {
                $temp = $this->generate_terbilang($uang - 10). " Belas";
            } else if ($uang < 100) {
                $temp = $this->generate_terbilang($uang/10)." Puluh". $this->generate_terbilang($uang % 10);
            } else if ($uang < 200) {
                $temp = " Seratus" . $this->generate_terbilang($uang - 100);
            } else if ($uang < 1000) {
                $temp = $this->generate_terbilang($uang/100) . " Ratus" . $this->generate_terbilang($uang % 100);
            } else if ($uang < 2000) {
                $temp = " Seribu" . $this->generate_terbilang($uang - 1000);
            } else if ($uang < 1000000) {
                $temp = $this->generate_terbilang($uang/1000) . " Ribu" . $this->generate_terbilang($uang % 1000);
            } else if ($uang < 1000000000) {
                $temp = $this->generate_terbilang($uang/1000000) . " Juta" . $this->generate_terbilang($uang % 1000000);
            }     
            return $temp;
        }

        public function generate_terbilang_fix($uang){
            if($uang != "x"){
                echo $this->generate_terbilang(str_replace(".","",$uang))." Rupiah";
            }else{
                echo "";
            }
        }

        function getbonsupir()
        {
            $supir_id = $this->input->get('id');
            $data = $this->model_form->getbonbysupir($supir_id);
            echo $data["supir_kasbon"];
        }

        function getakunbyid()
        {
            $akun_id = $this->input->get('id');
            $data = $this->model_form->getakunbyid($akun_id);
            echo json_encode($data);
        }

        public function konfigurasi($akun_id){
            if(!$_SESSION["user"]){
                $this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["akun"]=$this->model_form->getakunbyid($akun_id);
            $data["page"] = "Akun_page";
            $data["collapse_group"] = "Konfigurasi";
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('form/konfigurasi',$data);
            $this->load->view('footer');
        }   

        public function update_konfigurasi($akun_id){
            $data_konfigurasi = [$this->input->post("cek1"),$this->input->post("cek2"),$this->input->post("cek3"),
            $this->input->post("cek4"),$this->input->post("cek5")];
            $this->model_form->update_konfigurasi($akun_id,$data_konfigurasi);
            redirect(base_url("index.php/home/akun"));
        }

        public function update_jo_status($supir,$mobil){
            $data_jo = $this->model_home->getjobyid($this->input->post("jo_id"));
            $keterangan = "<strong>Catatan JO : </strong>".$data_jo["keterangan"]."<br><strong>Catatan Konfirmasi : </strong>".$this->input->post("Keterangan");
            $data = array(
                "jo_id" => $this->input->post("jo_id"),
                "status" => $this->input->post("status"),
                "tonase"=>$this->input->post("tonase"),
                "bonus"=>str_replace(".","",$this->input->post("bonus")),
                "keterangan"=>$keterangan,
                "tanggal_bongkar"=>date('Y-m-d'),
            );
            // echo var_dump($data);
            $this->model_form->update_jo_status($data,$supir,$mobil);
            redirect(base_url("index.php/home/konfirmasi_jo"));
        }
    //end fungsi lain

    // fungsi form joborder
    public function getrutebycustomer($customer_id){
        $rute = $this->model_form->getrutebycustomer($customer_id);
        echo json_encode($rute);        
    }
    public function getrutebymuatan(){
        $customer_id = $this->input->post("customer_id");
        $muatan = $this->input->post("rute_muatan");
        $rute = $this->model_form->getrutebymuatan($customer_id,$muatan);
        echo json_encode($rute);        
    }
    public function getrutebyasal(){
        $customer_id = $this->input->post("customer_id");
        $muatan = $this->input->post("rute_muatan");
        $rute_dari = $this->input->post("rute_asal");
        $rute = $this->model_form->getrutebydari($customer_id,$muatan,$rute_dari);
        echo json_encode($rute);        
    }
    public function getmobilbyjenis(){
        $mobil_jenis = $this->input->post("mobil_jenis");
        $mobil = $this->model_form->getmobilbyjenis($mobil_jenis);
        echo json_encode($mobil);        
    }
    public function getrutefix(){
        $data = array(
            "customer_id" => $this->input->post("customer_id"),
            "muatan" => $this->input->post("rute_muatan"),
            "rute_dari" => $this->input->post("rute_asal"),
            "rute_ke" => $this->input->post("rute_ke"),
            "mobil_jenis" => $this->input->post("mobil_jenis"),
            "rute_tonase"=>$this->input->post("rute_tonase"),
        );   
        $rute = $this->model_form->getrutefix($data);
        echo json_encode($rute);        
    }
    public function getrutetonase(){
        $data = array(
            "customer_id" => $this->input->post("customer_id"),
            "muatan" => $this->input->post("rute_muatan"),
            "rute_dari" => $this->input->post("rute_asal"),
            "rute_ke" => $this->input->post("rute_ke")
        );   
        $rute = $this->model_form->getrutetonase($data);
        echo json_encode($rute);        
    }
    // end fungsi form joborder
}
