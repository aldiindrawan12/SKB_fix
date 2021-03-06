<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('model_form');//load model
        $this->load->model('model_home');//load model
        $this->load->model('model_detail');//load model
    }

    // fungsi view form
        public function joborder(){
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["customer"] = $this->model_home->getcustomer();
            $data["mobil"] = $this->model_home->gettruck();
            $data["supir"] = $this->model_home->getsupir();
            $data["kosongan"] = $this->model_home->getkosongan();
            $data["page"] = "JO_page";
            $data["collapse_group"] = "Perintah_Kerja";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[1]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('form/joborder');
            $this->load->view('footer');
        }

        public function joborderpaketan(){
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["customer"] = $this->model_home->getcustomer();
            $data["mobil"] = $this->model_home->gettruck();
            $data["supir"] = $this->model_home->getsupir();
            $data["page"] = "JO_page";
            $data["collapse_group"] = "Perintah_Kerja";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[1]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('form/joborderpaketan');
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
            if(json_decode($data["akun_akses"]["akses"])[5]==0){
                redirect(base_url());
            }
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
                "total_tonase"=>str_replace(".","",$this->input->post("invoice_tonase")),
                "total"=>str_replace(".","",$this->input->post("invoice_total")),
                "ppn"=>str_replace(".","",$this->input->post("invoice_ppn_nilai")),
                "grand_total"=>str_replace(".","",$this->input->post("invoice_grand_total")),
                "batas_pembayaran"=>$this->input->post("invoice_payment"),
                "invoice_keterangan"=>$this->input->post("invoice_keterangan"),
                "status_bayar"=>"Belum Lunas",
                "user_invoice"=>$_SESSION["user"]
            );
            $data_jo = explode(",",$this->input->post("data_jo"));
            $this->model_form->insert_invoice($data,$data_jo);
            redirect(base_url("index.php/home/invoice"));
        }
        public function insert_paketan(){
            $data_rute = explode(",",$this->input->post("data_rute"));
            $detail_rute = [];
            for($i=0;$i<count($data_rute);$i++){
                $isi_detail_rute = [];
                if($data_rute[$i][0]=="k"){
                    $data_kosongan_by_id = $this->model_detail->getkosonganbyid(str_replace("k","",$data_rute[$i]),0);
                    $isi_detail_rute = array(
                        "customer"=>"-",
                        "dari"=>$data_kosongan_by_id["kosongan_dari"],
                        "ke"=>$data_kosongan_by_id["kosongan_ke"],
                        "muatan"=>"Kosongan",
                    );
                }else{
                    $data_rute_by_id = $this->model_detail->getrutebyid(str_replace("r","",$data_rute[$i]));
                    $isi_detail_rute = array(
                        "customer"=>$data_rute_by_id["customer_name"],
                        "dari"=>$data_rute_by_id["rute_dari"],
                        "ke"=>$data_rute_by_id["rute_ke"],
                        "muatan"=>$data_rute_by_id["rute_muatan"],
                    );
                }
                $detail_rute[] = $isi_detail_rute;
            }
            if($this->input->post("Tonase")==""){
                $paketan_gaji = str_replace(".","",$this->input->post("paketan_gaji"));
                $paketan_gaji_rumusan = 0;
                $tonase = 0;
            }else{
                $paketan_gaji = 0;
                $paketan_gaji_rumusan = str_replace(".","",$this->input->post("paketan_gaji_rumusan"));
                $tonase = str_replace(".","",$this->input->post("Tonase"));
            }
            $data=array(
                "jenis_mobil"=>$this->input->post("jenis_mobil"),
                "paketan_uj"=>str_replace(".","",$this->input->post("paketan_uj")),
                "paketan_gaji"=>$paketan_gaji,
                "paketan_tonase"=>$tonase,
                "paketan_gaji_rumusan"=>$paketan_gaji_rumusan,
                "paketan_status_hapus"=>"NO",
                "validasi_paketan"=>"Pending",
                "validasi_paketan_edit"=>"ACC",
                "validasi_paketan_delete"=>"ACC",
                "paketan_keterangan"=>$this->input->post("paketan_keterangan"),
                "paketan_data_rute"=>json_encode($detail_rute),
                "ritase"=>$this->input->post("Ritase"),
                "data_rute"=>$this->input->post("data_rute")
            );
            $this->model_form->insert_paketan($data);
			$this->session->set_flashdata('status-add-paketan', 'Berhasil');
            redirect(base_url("index.php/home/paketan"));
        }
        public function insert_JO(){
            $kosongan = $this->model_home->getkosonganbyid($this->input->post("kosongan_id"));
            $jo_id = $this->model_form->getjoid();
            $isi_jo_id = [];
            for($i=0;$i<count($jo_id);$i++){
                $isi_jo_id[] = $jo_id[$i]["Jo_id"];
            }
            if(!$kosongan){
                $kosongan_id = 0;
                $uang_kosongan = 0;
            }else{
                $kosongan_id = $kosongan["kosongan_id"];
                $uang_kosongan = $kosongan["kosongan_uang"];
            }
            //generate jo id
            $new_jo_id = "";
            for($i=0;$i<7-strlen(max($isi_jo_id)+1);$i++){
                $new_jo_id .= "0";
            }
            $new_jo_id = $new_jo_id.(max($isi_jo_id)+1);
            //end generate jo id
            $data["data"]=array(
                "Jo_id"=>$new_jo_id,
                "parent_Jo_id"=>'y',
                "mobil_no"=>$this->input->post("Kendaraan"),
                "supir_id"=>$this->input->post("Supir"),
                "muatan"=>$this->input->post("Muatan"),
                "asal"=>$this->input->post("Asal"),
                "tujuan"=>$this->input->post("Tujuan"),
                "uang_jalan"=>str_replace(".","",$this->input->post("Uang")),
                "uang_jalan_bayar"=>str_replace(".","",$this->input->post("uang_jalan_bayar")),
                "terbilang"=>$this->input->post("Terbilang"),
                "tanggal_surat"=>$this->input->post("tanggal_jo"),
                "keterangan"=>$this->input->post("Keterangan"),
                "customer_id"=>$this->input->post("Customer"),
                "status"=>"Dalam Perjalanan",
                "status_upah"=>"Belum Dibayar",
                "upah"=>str_replace(".","",$this->input->post("Upah")),
                "tagihan"=>str_replace(".","",$this->input->post("Tagihan")),
                "kosongan_id"=>$kosongan_id,
                "paketan_id"=>0,
                "uang_kosongan" =>$uang_kosongan,
                "user"=>$_SESSION["user"]
            );
            $this->model_form->insert_JO($data["data"]);
            $data["jo_id"] = $new_jo_id;
            $data["asal"] = "insert";
            $data["tipe_jo"] = "reguler";
            $data["kosongan"] = $this->model_detail->getkosonganbyid($data["data"]["kosongan_id"],$new_jo_id);
            $data["supir"] = $this->model_home->getsupirbyid($data["data"]["supir_id"]);
            $data["mobil"] = $this->model_home->getmobilbyid($data["data"]["mobil_no"]);
            $this->load->view("print/jo_print",$data);
        }
        public function insert_JO_paketan(){
            $jo_id = $this->model_form->getjoid();
            $isi_jo_id = [];
            for($i=0;$i<count($jo_id);$i++){
                $isi_jo_id[] = $jo_id[$i]["Jo_id"];
            }
            //generate jo id
            $new_jo_id = "";
            for($i=0;$i<7-strlen(max($isi_jo_id)+1);$i++){
                $new_jo_id .= "0";
            }
            $new_jo_id = $new_jo_id.(max($isi_jo_id)+1);
            //end generate jo id
            $data["data"]=array(
                "Jo_id"=>$new_jo_id,
                "parent_Jo_id"=>'x',
                "mobil_no"=>$this->input->post("Kendaraan"),
                "supir_id"=>$this->input->post("Supir"),
                "uang_jalan"=>str_replace(".","",$this->input->post("Uang")),
                "uang_jalan_bayar"=>str_replace(".","",$this->input->post("uang_jalan_bayar")),
                "terbilang"=>$this->input->post("Terbilang"),
                "tanggal_surat"=>$this->input->post("tanggal_jo"),
                "keterangan"=>$this->input->post("Keterangan"),
                "status"=>"Dalam Perjalanan",
                "status_upah"=>"Belum Dibayar",
                "upah"=>str_replace(".","",$this->input->post("Upah")),
                "tagihan"=>str_replace(".","",$this->input->post("Tagihan")),
                "paketan_id"=>$this->input->post("paketan_id"),
                "kosongan_id"=>0,
                "uang_kosongan"=>0,
                "user"=>$_SESSION["user"]
            );
            $this->model_form->insert_JO($data["data"]);

            $paketan = $this->model_form->getrutepaketanbyid($this->input->post("paketan_id"));
            $data_rute = explode(",",$paketan["data_rute"]);
            $kosongan_id = 0;
            $uang_kosongan = 0;
            $parent_jo_id = "";
            for($i=0;$i<7-strlen(max($isi_jo_id)+1);$i++){
                $parent_jo_id .= "0";
            }
            $parent_jo_id = $parent_jo_id.(max($isi_jo_id)+1);
            for($i=0;$i<count($data_rute);$i++){
                if($data_rute[$i][0]=="k"){
                    //get kosongan
                    $kosongan = $this->model_home->getkosonganbyid(str_replace("k","",$data_rute[$i]),0);
                    $kosongan_id = $kosongan["kosongan_id"];
                    $uang_kosongan = $kosongan["kosongan_uang"];
                    //end kosongan
                }else{
                    if($i+2==count($data_rute) && $data_rute[$i+1][0]=="k"){
                        $kosongan = $this->model_home->getkosonganbyid(str_replace("k","",$data_rute[$i+1]),0);
                        $kosongan_id = $kosongan["kosongan_id"];
                        $uang_kosongan = $kosongan["kosongan_uang"];
                    }
                    $rute = $this->model_detail->getrutebyid(str_replace("r","",$data_rute[$i]));
                    $jo_id = $this->model_form->getjoid();
                    $isi_jo_id = [];
                    for($j=0;$j<count($jo_id);$j++){
                        $isi_jo_id[] = $jo_id[$j]["Jo_id"];
                    }
                    //generate jo id
                    $child_jo_id = "";
                    for($k=0;$k<7-strlen(max($isi_jo_id)+1);$k++){
                        $child_jo_id .= "0";
                    }
                    $child_jo_id = $child_jo_id.(max($isi_jo_id)+1);
                    //end generate jo id
                    $data_jo=array(
                        "Jo_id"=>$child_jo_id,
                        "parent_Jo_id"=>$parent_jo_id,
                        "mobil_no"=>$this->input->post("Kendaraan"),
                        "supir_id"=>$this->input->post("Supir"),
                        "muatan"=>$rute["rute_muatan"],
                        "asal"=>$rute["rute_ke"],
                        "tujuan"=>$rute["rute_dari"],
                        "uang_jalan"=>$rute["rute_uj_engkel"],
                        "uang_jalan_bayar"=>0,
                        "terbilang"=>0,
                        "tanggal_surat"=>$this->input->post("tanggal_jo"),
                        "keterangan"=>$this->input->post("Keterangan"),
                        "customer_id"=>$rute["customer_id"],
                        "status"=>"Dalam Perjalanan",
                        "status_upah"=>"Belum Dibayar",
                        "upah"=>0,
                        "tagihan"=>$rute["rute_tagihan"],
                        "kosongan_id"=>$kosongan_id,
                        "paketan_id"=>0,
                        "uang_kosongan" =>$uang_kosongan,
                        "user"=>$_SESSION["user"]
                    );
                    $this->model_form->insert_JO($data_jo);
                    $kosongan_id = 0;
                    $uang_kosongan = 0;
                }
            }

                $data["jo_id"] = $new_jo_id;
                $data["asal"] = "insert";
                $data["tipe_jo"] = "paketan";
                $data["paketan"] = $this->model_form->getpaketanbyid($this->input->post("paketan_id"));
                $data["kosongan"] = $this->model_detail->getkosonganbyid(0,$new_jo_id);
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
                "bon_tanggal"=>date("Y-m-d H:i:s"),
                "user"=>$_SESSION["user"]
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
                "akses"=>'["1","1","1","1","1","1","1","1","1","1","1","1"]'
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
                "status_hapus"=>"No",
                "validasi"=>"Pending",
                "validasi_edit"=>"ACC",
                "validasi_delete"=>"ACC",
            );
            // echo var_dump($data);
            $this->model_form->insert_customer($data);
			$this->session->set_flashdata('status-add-customer', 'Berhasil');
            redirect(base_url("index.php/home/customer"));
        }
        
        public function insert_supir(){
            $config['upload_path'] = './assets/berkas/driver'; //letak folder file yang akan diupload
            $config['allowed_types'] = 'jpg|png|img|jpeg'; //jenis file yang dapat diterima
            $config['max_size'] = '2000'; // kb
            $this->load->library('upload', $config); //deklarasi library upload (config)
            if ($this->upload->do_upload('file_foto')) {
                $this->upload->data();
                $file_foto =  $this->upload->data('file_name');
            }
            if ($this->upload->do_upload('file_sim')) {
                $this->upload->data();
                $file_sim =  $this->upload->data('file_name');
            }
            if ($this->upload->do_upload('file_ktp')) {
                $this->upload->data();
                $file_ktp =  $this->upload->data('file_name');
            }
            $data=array(
                "supir_name"=>$this->input->post("Supir"),
                "supir_kasbon"=>0,
                "status_jalan"=>"Tidak Jalan",
                "status_hapus"=>"NO",
                "supir_alamat"=>$this->input->post("supir_alamat"),
                "supir_telp"=>$this->input->post("supir_telp"),
                "supir_keterangan"=>$this->input->post("supir_keterangan"),
                "supir_ktp"=>$this->input->post("supir_ktp"),
                "supir_sim"=>$this->input->post("supir_sim"),
                "supir_panggilan"=>$this->input->post("supir_panggilan"),
                "status_aktif"=>"Aktif",
                "supir_tgl_aktif"=>$this->input->post("supir_tgl_aktif"),
                "supir_tgl_lahir"=>$this->input->post("supir_tgl_lahir"),
                "supir_tempat_lahir"=>$this->input->post("supir_tempat_lahir"),
                "file_foto"=>$file_foto,
                "file_sim"=>$file_sim,
                "file_ktp"=>$file_ktp,
                "darurat_nama"=>$this->input->post("darurat_nama"),
                "darurat_telp"=>$this->input->post("darurat_telp"),
                "darurat_referensi"=>$this->input->post("darurat_referensi"),
                "supir_tgl_sim"=>$this->input->post("supir_tgl_sim"),
                "validasi"=>"Pending",
                "validasi_edit"=>"ACC",
                "validasi_delete"=>"ACC",
            );
            // echo var_dump($data)."<br><br>";
            $this->model_form->insert_supir($data);
			$this->session->set_flashdata('status-add-supir', 'Berhasil');
            redirect(base_url("index.php/home/penggajian"));
        }

        public function insert_truck(){
            $config['upload_path'] = './assets/berkas/kendaraan'; //letak folder file yang akan diupload
            $config['allowed_types'] = 'jpg|png|img|jpeg'; //jenis file yang dapat diterima
            $config['max_size'] = '2000'; // kb
            $this->load->library('upload', $config); //deklarasi library upload (config)
            if ($this->upload->do_upload('file_foto')) {
                $this->upload->data();
                $file_foto =  $this->upload->data('file_name');
            }
            if ($this->upload->do_upload('file_STNK')) {
                $this->upload->data();
                $file_stnk =  $this->upload->data('file_name');
            }

            $data=array(
                "mobil_no"=>$this->input->post("mobil_no"),
                "mobil_jenis"=>$this->input->post("mobil_jenis"),
                "mobil_max_load"=>$this->input->post("mobil_max_load"),
                "status_jalan"=>"Tidak Jalan",
                "status_hapus"=>"NO",
                "mobil_keterangan"=>$this->input->post("mobil_keterangan"),
                "merk_id"=>$this->input->post("merk_id"),
                "mobil_merk"=>$this->input->post("mobil_merk"),
                "mobil_type"=>$this->input->post("mobil_type"),
                "mobil_dump"=>$this->input->post("mobil_dump"),
                "mobil_tahun"=>$this->input->post("mobil_tahun"),
                "mobil_berlaku"=>$this->input->post("mobil_berlaku"),
                "mobil_pajak"=>$this->input->post("mobil_pajak"),
                "mobil_stnk"=>$this->input->post("mobil_stnk"),
                "mobil_kir"=>$this->input->post("mobil_kir"),
                "mobil_ijin_bongkar"=>$this->input->post("mobil_ijin_bongkar"),
                "mobil_berlaku_kir"=>$this->input->post("mobil_berlaku_kir"),
                "mobil_berlaku_ijin_bongkar"=>$this->input->post("mobil_berlaku_ijin_bongkar"),
                "validasi"=>"Pending",
                "validasi_edit"=>"ACC",
                "validasi_delete"=>"ACC",
                "file_foto"=>$file_foto,
                "file_stnk"=>$file_stnk
            );
            // echo var_dump($data);
            $this->model_form->insert_truck($data);
			$this->session->set_flashdata('status-add-kendaraan', 'Berhasil');
            redirect(base_url("index.php/home/truck"));
        }

        public function insert_kosongan(){

            $data=array(
                "kosongan_dari"=>$this->input->post("kosongan_dari"),
                "kosongan_ke"=>$this->input->post("kosongan_ke"),
                "kosongan_uang"=>str_replace(".","",$this->input->post("kosongan_uang")),
                "status_hapus"=>"NO",
                "validasi"=>"Pending",
                "validasi_edit"=>"ACC",
                "validasi_delete"=>"ACC",
            );
            // echo var_dump($data);
            $this->model_form->insert_kosongan($data);
			$this->session->set_flashdata('status-add-kosongan', 'Berhasil');
            redirect(base_url("index.php/home/kosongan"));
        }

        public function insert_merk(){
            $data=array(
                "merk_nama"=>$this->input->post("merk_nama"),
                "merk_type"=>$this->input->post("merk_type"),
                "merk_jenis"=>$this->input->post("merk_jenis"),
                "merk_dump"=>$this->input->post("merk_dump"),
                "status_hapus"=>"NO",
                "validasi"=>"Pending",
                "validasi_edit"=>"ACC",
                "validasi_delete"=>"ACC",
            );
            $this->model_form->insert_merk($data);
			$this->session->set_flashdata('status-add-merk', 'Berhasil');
            redirect(base_url("index.php/home/merk"));
        }

        public function insert_rute(){
            if($this->input->post("Tonase")==""){
                $rute_gaji_engkel = str_replace(".","",$this->input->post("rute_gaji_engkel"));
                // $rute_gaji_tronton = str_replace(".","",$this->input->post("rute_gaji_tronton"));
                $rute_gaji_engkel_rumusan = 0;
                // $rute_gaji_tronton_rumusan = 0;
                $tonase = 0;
            }else{
                $rute_gaji_engkel = 0;
                // $rute_gaji_tronton = 0;
                $rute_gaji_engkel_rumusan = str_replace(".","",$this->input->post("rute_gaji_engkel_rumusan"));
                // $rute_gaji_tronton_rumusan = str_replace(".","",$this->input->post("rute_gaji_tronton_rumusan"))     ;
                $tonase = str_replace(".","",$this->input->post("Tonase"));
            }
            $data=array(
                "customer_id"=>$this->input->post("customer_id"),
                "rute_dari"=>$this->input->post("rute_dari"),
                "rute_ke"=>$this->input->post("rute_ke"),
                "rute_muatan"=>$this->input->post("rute_muatan"),
                "jenis_mobil"=>$this->input->post("jenis_mobil"),
                "rute_uj_engkel"=>str_replace(".","",$this->input->post("rute_uj_engkel")),
                // "rute_uj_tronton"=>str_replace(".","",$this->input->post("rute_uj_tronton")),
                "rute_tagihan"=>str_replace(".","",$this->input->post("rute_tagihan")),
                "rute_gaji_engkel"=>$rute_gaji_engkel,
                // "rute_gaji_tronton"=>$rute_gaji_tronton,
                "rute_tonase"=>$tonase,
                "rute_gaji_engkel_rumusan"=>$rute_gaji_engkel_rumusan,
                // "rute_gaji_tronton_rumusan"=>$rute_gaji_tronton_rumusan,
                "rute_status_hapus"=>"NO",
                "validasi_rute"=>"Pending",
                "validasi_rute_edit"=>"ACC",
                "validasi_rute_delete"=>"ACC",
                "rute_keterangan"=>$this->input->post("rute_keterangan"),
                "ritase"=>$this->input->post("Ritase")
            );
            $this->model_form->insert_rute($data);
			$this->session->set_flashdata('status-add-satuan', 'Berhasil');
            redirect(base_url("index.php/home/satuan"));
        }
    // end fungsi insert
    
    // fungsi update
        public function update_rute(){
            $data=array(
                "customer_id"=>$this->input->post("customer_id_update"),
                "rute_dari"=>$this->input->post("rute_dari_update"),
                "rute_ke"=>$this->input->post("rute_ke_update"),
                "rute_muatan"=>$this->input->post("rute_muatan_update"),
                "rute_uj_engkel"=>str_replace(".","",$this->input->post("rute_uj_engkel_update")),
                // "rute_uj_tronton"=>str_replace(".","",$this->input->post("rute_uj_tronton_update")),
                "rute_tagihan"=>str_replace(".","",$this->input->post("rute_tagihan_update")),
                "rute_gaji_engkel"=>str_replace(".","",$this->input->post("rute_gaji_engkel_update")),
                // "rute_gaji_tronton"=>str_replace(".","",$this->input->post("rute_gaji_tronton_update")),
                "rute_gaji_engkel_rumusan"=>str_replace(".","",$this->input->post("rute_gaji_engkel_rumusan_update")),
                // "rute_gaji_tronton_rumusan"=>str_replace(".","",$this->input->post("rute_gaji_tronton_rumusan_update")),
                "rute_tonase"=>str_replace(".","",$this->input->post("rute_tonase_update")),
                "rute_keterangan"=>str_replace(".","",$this->input->post("rute_keterangan_update")),
                // "ritase"=>str_replace(".","",$this->input->post("Ritase_update")),
            );
            $this->model_form->update_rute($data,$this->input->post("rute_id_update"));
            $this->session->set_flashdata('status-update-satuan', 'Berhasil');
            redirect(base_url("index.php/home/satuan"));
        }
        public function update_paketan(){
            $data=array(
                "jenis_mobil"=>$this->input->post("jenis_mobil_update"),
                "paketan_uj"=>str_replace(".","",$this->input->post("paketan_uj_update")),
                "paketan_gaji"=>str_replace(".","",$this->input->post("paketan_gaji_update")),
                "paketan_tonase"=>str_replace(".","",$this->input->post("Tonase_update")),
                "paketan_gaji_rumusan"=>str_replace(".","",$this->input->post("paketan_gaji_rumusan_update")),
                "paketan_keterangan"=>$this->input->post("paketan_keterangan_update"),
                "ritase"=>$this->input->post("Ritase_update")
            );
            $this->model_form->update_paketan($data,$this->input->post("paketan_id_update"));
            $this->session->set_flashdata('status-update-paketan', 'Berhasil');
            redirect(base_url("index.php/home/paketan"));
        }
        public function update_supir(){
            $supir_id = $this->input->post("supir_id");
            $data = array(
                "supir_name" => $this->input->post("supir_name"),
                "supir_panggilan" => $this->input->post("supir_panggilan_update"),
                "supir_tempat_lahir" => $this->input->post("supir_tempat_lahir_update"),
                "supir_tgl_lahir" => $this->input->post("supir_tgl_lahir_update"),
                "supir_alamat" => $this->input->post("supir_alamat_update"),
                "supir_telp" => $this->input->post("supir_telp_update"),
                "supir_ktp" => $this->input->post("supir_ktp_update"),
                "supir_sim" => $this->input->post("supir_sim_update"),
                "supir_tgl_sim" => $this->input->post("supir_tgl_sim_update"),
                "supir_tgl_aktif" => $this->input->post("supir_tgl_aktif_update"),
                "darurat_nama" => $this->input->post("darurat_nama_update"),
                "darurat_telp" => $this->input->post("darurat_telp_update"),
                "darurat_referensi" => $this->input->post("darurat_referensi_update"),
                "supir_keterangan" => $this->input->post("supir_keterangan_update"),
            );
            $this->model_form->update_supir($data,$supir_id);
            $this->session->set_flashdata('status-update-supir', 'Berhasil');
            redirect(base_url("index.php/home/penggajian"));
        }
        public function update_truck(){
            $data = array(
                "mobil_no" => $this->input->post("mobil_no_update"),
                "mobil_stnk" => $this->input->post("mobil_stnk_update"),
                "mobil_berlaku" => $this->input->post("mobil_berlaku_update"),
                "mobil_pajak" => $this->input->post("mobil_pajak_update"),
                "mobil_kir" => $this->input->post("mobil_kir_update"),
                "mobil_berlaku_kir" => $this->input->post("mobil_berlaku_kir_update"),
                "mobil_ijin_bongkar" => $this->input->post("mobil_ijin_bongkar_update"),
                "mobil_berlaku_ijin_bongkar" => $this->input->post("mobil_berlaku_ijin_bongkar_update"),
                "mobil_keterangan" => $this->input->post("mobil_keterangan_update")
            );
            $this->model_form->update_truck($data);
            $this->session->set_flashdata('status-update-truck', 'Berhasil');
            redirect(base_url("index.php/home/truck"));
        }
        public function update_kosongan(){
            $data = array(
                "kosongan_dari" => $this->input->post("kosongan_dari_update"),
                "kosongan_ke" => $this->input->post("kosongan_ke_update"),
                "kosongan_uang" => str_replace(".","",$this->input->post("kosongan_uang_update")),
            );
            // echo var_dump($data);
            $kosongan_id = $this->input->post("kosongan_id_update");
            $this->model_form->update_kosongan($kosongan_id,$data);
            $this->session->set_flashdata('status-update-kosongan', 'Berhasil');
            redirect(base_url("index.php/home/kosongan"));
        }
        public function update_merk(){
            $data = array(
                "merk_nama" => $this->input->post("merk_nama_update"),
                "merk_type" => $this->input->post("merk_type_update"),
                "merk_jenis" => $this->input->post("merk_jenis_update"),
                "merk_dump" => $this->input->post("merk_dump_update")
            );
            $merk_id = $this->input->post("merk_id_update");
            $this->model_form->update_merk($data,$merk_id);
            $this->session->set_flashdata('status-update-merk', 'Berhasil');
            redirect(base_url("index.php/home/merk"));
        }
        public function update_customer(){
            $data = array(
                "customer_id" => $this->input->post("customer_id_update"),
                "customer_name" => $this->input->post("customer_name_update"),
                "customer_alamat" => $this->input->post("customer_alamat_update"),
                "customer_kontak_person" => $this->input->post("customer_kontak_person_update"),
                "customer_telp" => $this->input->post("customer_telp_update"),
                // "customer_bank" => $this->input->post("customer_bank_update"),
                // "customer_rekening" => $this->input->post("customer_rekening_update"),
                // "customer_AN" => $this->input->post("customer_AN_update"),
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
        public function update_jo_status($supir,$mobil){
            if($this->input->post("status")!="Dibatalkan"){
                $data_jo = $this->model_home->getjobyid($this->input->post("jo_id"));
                $keterangan = $data_jo["keterangan"]."<br>".$this->input->post("Keterangan");
                $data = array(
                    "jo_id" => $this->input->post("jo_id"),
                    "status" => $this->input->post("status"),
                    "tonase"=>$this->input->post("tonase"),
                    "keterangan"=>$keterangan,
                    "tanggal_bongkar"=>date('Y-m-d'),
                );
                $this->model_form->update_jo_status($data,$supir,$mobil);
                redirect(base_url("index.php/home/konfirmasi_jo"));
            }else{
                $this->updatejobatal($this->input->post("jo_id"));
            }
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
                "bon_nominal"=>$data_jo["uang_jalan_bayar"],
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
        public function update_status_aktif_supir(){
            $data = array(
                "supir_id"=>$this->input->post("update_status_supir_id"),
                "supir_tgl_nonaktif"=>$this->input->post("update_status_tanggal_nonaktif"),
                "status_aktif"=>$this->input->post("update_status_status_aktif")
            );
            $this->model_form->update_status_aktif_supir($data);
            redirect(base_url("index.php/home/penggajian"));
        }
        public function update_konfigurasi($akun_id){
            $konfigurasi = [$this->input->post("cekpage1"),$this->input->post("cekpage2"),$this->input->post("cekpage3"),
            $this->input->post("cekpage4"),$this->input->post("cekpage5"),$this->input->post("cekpage6"),
            $this->input->post("cekpage7"),$this->input->post("cekpage8"),$this->input->post("cekpage9"),
            $this->input->post("cekpage10"),$this->input->post("cekpage11"),$this->input->post("cekpage12")];
            // for($i=0;$i<count($konfigurasi);$i++){
            //     echo $konfigurasi[$i]."<br>";
            // }
            $this->model_form->update_konfigurasi($akun_id,$konfigurasi);
            redirect(base_url("index.php/home/akun"));
        }
    //end fungsi update
    //fungsi delete
        public function deletesupir(){
            $supir_id = $this->input->get("id");
            $this->model_form->deletesupir($supir_id);
            $this->session->set_flashdata('status-delete-supir', 'Berhasil');
            echo $supir_id;
        }
        public function deletepaketan(){
            $paketan_id = $this->input->get("id");
            $this->model_form->deletepaketan($paketan_id);
            $this->session->set_flashdata('status-delete-paketan', 'Berhasil');
            echo $paketan_id;
        }
        public function deletemerk(){
            $merk_id = $this->input->get("id");
            $this->model_form->deletemerk($merk_id);
            $this->session->set_flashdata('status-delete-merk', 'Berhasil');
            echo $merk_id;
        }
        public function deletekosongan(){
            $kosongan_id = $this->input->get("id");
            $this->model_form->deletekosongan($kosongan_id);
            $this->session->set_flashdata('status-delete-kosongan', 'Berhasil');
            echo $kosongan_id;
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
    //end fungsi delete
    //fungsi acc
        public function accsupir($validasi){
            $supir_id = $this->input->get("id");
            $this->model_form->accsupir($supir_id,$validasi);
            echo $supir_id;
        }
        public function accdeletesupir($validasi){
            $supir = $this->input->get("id");
            $this->model_form->accdeletesupir($supir,$validasi);
            echo $supir;
        }
        public function acceditsupir($validasi){
            $supir_id = $this->input->get("id");
            $this->model_form->acceditsupir($supir_id,$validasi);
            echo $supir_id;
        }

        public function acckosongan($validasi){
            $kosongan_id = $this->input->get("id");
            $this->model_form->acckosongan($kosongan_id,$validasi);
            echo $kosongan_id;
        }
        public function accdeletekosongan($validasi){
            $kosongan_id = $this->input->get("id");
            $this->model_form->accdeletekosongan($kosongan_id,$validasi);
            echo $kosongan_id;
        }
        public function acceditkosongan($validasi){
            $kosongan_id = $this->input->get("id");
            $this->model_form->acceditkosongan($kosongan_id,$validasi);
            echo $kosongan_id;
        }

        public function acccustomer($validasi){
            $customer_id = $this->input->get("id");
            $this->model_form->acccustomer($customer_id,$validasi);
            echo $customer_id;
        }
        public function accdeletecustomer($validasi){
            $customer_id = $this->input->get("id");
            $this->model_form->accdeletecustomer($customer_id,$validasi);
            echo $customer_id;
        }
        public function acceditcustomer($validasi){
            $customer_id = $this->input->get("id");
            $this->model_form->acceditcustomer($customer_id,$validasi);
            echo $customer_id;
        }

        public function acctruck($validasi){
            $truck_id = $this->input->get("id");
            $this->model_form->acctruck($truck_id,$validasi);
            echo $truck_id;
        }
        public function accdeletetruck($validasi){
            $mobil_no = $this->input->get("id");
            $this->model_form->accdeletetruck($mobil_no,$validasi);
            echo $mobil_no;
        }
        public function accedittruck($validasi){
            $mobil_no = $this->input->get("id");
            $this->model_form->accedittruck($mobil_no,$validasi);
            echo $mobil_no;
        }

        public function accrute($validasi){
            $rute_id = $this->input->get("id");
            $this->model_form->accrute($rute_id,$validasi);
            echo $rute_id;
        }
        public function accdeleterute($validasi){
            $rute_id = $this->input->get("id");
            $this->model_form->accdeleterute($rute_id,$validasi);
            echo $rute_id;
        }
        public function acceditrute($validasi){
            $rute_id = $this->input->get("id");
            $this->model_form->acceditrute($rute_id,$validasi);
            echo $rute_id;
        }

        public function accpaketan($validasi){
            $paketan_id = $this->input->get("id");
            $this->model_form->accpaketan($paketan_id,$validasi);
            echo $paketan_id;
        }
        public function accdeletepaketan($validasi){
            $paketan_id = $this->input->get("id");
            $this->model_form->accdeletepaketan($paketan_id,$validasi);
            echo $paketan_id;
        }
        public function acceditpaketan($validasi){
            $paketan_id = $this->input->get("id");
            $this->model_form->acceditpaketan($paketan_id,$validasi);
            echo $paketan_id;
        }

        public function accmerk($validasi){
            $merk_id = $this->input->get("id");
            $this->model_form->accmerk($merk_id,$validasi);
            echo $merk_id;
        }
        public function accdeletemerk($validasi){
            $merk_id = $this->input->get("id");
            $this->model_form->accdeletemerk($merk_id,$validasi);
            echo $merk_id;
        }
        public function acceditmerk($validasi){
            $merk_id = $this->input->get("id");
            $this->model_form->acceditmerk($merk_id,$validasi);
            echo $merk_id;
        }
    //end fungsi acc
    //fungsi get
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
        public function getpaketanbyid(){
            $paketan_id = $this->input->get("id");
            $paketan = $this->model_form->getpaketanbyid($paketan_id);
            echo json_encode($paketan);
        }
        public function getrutepaketanbyid(){
            $rute_id = $this->input->get("id");
            $rute = $this->model_form->getrutepaketanbyid($rute_id);
            echo json_decode(json_encode($rute["paketan_data_rute"]));
        }
        public function getallmobil(){
            $mobil = $this->model_form->getallmobil();
            echo json_encode($mobil);
        }
        public function getbonsupir(){
            $supir_id = $this->input->get('id');
            $data = $this->model_form->getbonbysupir($supir_id);
            echo $data["supir_kasbon"];
        }
        public function getakunbyid(){
            $akun_id = $this->input->get('id');
            $data = $this->model_form->getakunbyid($akun_id);
            echo json_encode($data);
        }
    //end fungsi get
    //fungsi lain
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
    public function generate_selisih_tanggal($tanggal_sim){
        $tanggal_now = date("Y-m-d");
        $tgl1 = new DateTime($tanggal_now);
        $tgl2 = new DateTime($tanggal_sim);
        $d = $tgl2->diff($tgl1)->days + 1;
        echo $d;
    }

    public function konfigurasi($akun_id){
        if(!$_SESSION["user"]){
            $this->session->set_flashdata('status-login', 'False');
            redirect(base_url());
        }
        $data["akun"]=$this->model_form->getakunbyid($akun_id);
        $data["page"] = "Akun_page";
        $data["collapse_group"] = "Konfigurasi";
        $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
        if(json_decode($data["akun_akses"]["akses"])[11]==0){
            redirect(base_url());
        }
        $this->load->view('header',$data);
        $this->load->view('sidebar');
        $this->load->view('form/konfigurasi',$data);
        $this->load->view('footer');
    }

    
}
