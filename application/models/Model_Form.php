<?php
// error_reporting(0);
class Model_Form extends CI_model
{
    //fungsi get
        public function getcustomerbyname($customer_name){
            return $this->db->get_where("skb_customer",array("customer_name"=>str_replace("%20"," ",$customer_name)))->row_array();
        }
        public function getbonbysupir($supir_id){
            return $this->db->get_where("skb_supir",array("supir_id"=>$supir_id))->row_array();
        }
        public function getakunbyid($akun_id){
            $this->db->join("user", "user.akun_id = skb_akun.akun_id", 'left');
            return $this->db->get_where("skb_akun",array("skb_akun.akun_id"=>$akun_id))->row_array();
        }
        public function getrutebyid($rute_id){
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_rute.customer_id", 'left');
            return $this->db->get_where("skb_rute",array("skb_rute.rute_id"=>$rute_id))->row_array();
        }
        public function getpaketanbyid($paketan_id){
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_paketan.customer_id", 'left');
            return $this->db->get_where("skb_paketan",array("skb_paketan.paketan_id"=>$paketan_id))->row_array();
        }
        public function getrutepaketanbyid($paketan_id){
            return $this->db->get_where("skb_paketan",array("paketan_id"=>$paketan_id))->row_array();
        }
        public function getjoid(){
            $this->db->select("Jo_id");
            return $this->db->get("skb_job_order")->result_array();
        }
        public function getsupirname($supir_id){
            return $this->db->get_where("skb_supir",array("supir_id"=>$supir_id))->row_array();
        }
        public function getallsupir(){
            return $this->db->get("skb_supir")->result_array();
        }
        public function getakunbyname($akun_name){
            return $this->db->get_where("skb_akun",array("akun_name"=>$akun_name))->row_array();
        }
        public function getbonid(){
            $this->db->select("bon_id");
            return $this->db->get("skb_bon")->result_array();
        }
    //end fungsi get
    //fungsi insert
        public function insert_JO($data){
            $this->db->set("status_jalan","Jalan");
            $this->db->where("supir_id",$data["supir_id"]);
            $this->db->update("skb_supir");

            $this->db->set("status_jalan","Jalan");
            $this->db->where("mobil_no",$data["mobil_no"]);
            $this->db->update("skb_mobil");

            return $this->db->insert("skb_job_order", $data);
        }
        public function insert_invoice($data,$data_jo){
            for($i=0;$i<count($data_jo);$i++){
                $this->db->set("invoice_id",$data["invoice_kode"]);
                $this->db->where("Jo_id",$data_jo[$i]);
                $this->db->update("skb_job_order");
            }

            return $this->db->insert("skb_invoice", $data);
        }
        public function insert_merk($data){
            return $this->db->insert("skb_merk_kendaraan", $data);
        }
        public function insert_bon($data){
            $supir=$this->db->get_where("skb_supir",array("supir_id"=>$data["supir_id"]))->row_array();
            if($data["bon_jenis"]=="Pengajuan"){
                $bon_now = $supir["supir_kasbon"]+$data["bon_nominal"];
            }else if($data["bon_jenis"]=="Pembayaran"){
                $bon_now = $supir["supir_kasbon"]-$data["bon_nominal"];
            }else{
                $bon_now = $supir["supir_kasbon"]+$data["bon_nominal"];
            }
            $this->db->set("supir_kasbon",$bon_now);
            $this->db->where("supir_id",$data["supir_id"]);
            $this->db->update("skb_supir");

            return $this->db->insert("skb_bon", $data);
        }
        public function insert_akun($data){
            return $this->db->insert("skb_akun", $data);
        }
        public function insert_user($data){
            return $this->db->insert("user", $data);
        }
        public function insert_customer($data){
            return $this->db->insert("skb_customer", $data);
        }
        public function insert_supir($data){
            return $this->db->insert("skb_supir", $data);
        }
        public function insert_rute($data){
            return $this->db->insert("skb_rute", $data);
        }
        public function insert_paketan($data){
            return $this->db->insert("skb_paketan", $data);
        }
        public function insert_truck($data){
            return $this->db->insert("skb_mobil", $data);
        }
        public function insert_kosongan($data){
            return $this->db->insert("skb_kosongan", $data);
        }
    //end fungsi insert
    //fungsi acc
        public function accsupir($supir_id,$validasi){
            $this->db->set("validasi",$validasi);
            $this->db->where("supir_id",$supir_id);
            $this->db->update("skb_supir");
        }
        public function accdeletesupir($supir_id,$validasi){
            if($validasi=="Ditolak"){
                $this->db->set("status_hapus","NO");
            }else{
                $this->db->set("status_hapus","YES");
            }
            $this->db->set("validasi_delete","ACC");
            $this->db->where("supir_id",$supir_id);
            $this->db->update("skb_supir");
        }
        public function acceditsupir($supir_id,$validasi){
            $data_supir = $this->db->get_where("skb_supir",array("supir_id"=>$supir_id))->row_array();
            $temp_supir = json_decode($data_supir["temp_supir"],true);
            $this->db->set("temp_supir","");
            $this->db->set("validasi_edit","ACC");
            $this->db->where("supir_id",$supir_id);
            if($validasi=="Ditolak"){
                $this->db->update("skb_supir");
            }else{
                $this->db->update("skb_supir",$temp_supir);
            }
        }

        public function acckosongan($kosongan_id,$validasi){
            $this->db->set("validasi",$validasi);
            $this->db->where("kosongan_id",$kosongan_id);
            $this->db->update("skb_kosongan");
        }
        public function accdeletekosongan($kosongan_id,$validasi){
            if($validasi=="Ditolak"){
                $this->db->set("status_hapus","NO");
            }else{
                $this->db->set("status_hapus","YES");
            }
            $this->db->set("validasi_delete","ACC");
            $this->db->where("kosongan_id",$kosongan_id);
            $this->db->update("skb_kosongan");
        }
        public function acceditkosongan($kosongan_id,$validasi){
            $data_kosongan = $this->db->get_where("skb_kosongan",array("kosongan_id"=>$kosongan_id))->row_array();
            $temp_kosongan = json_decode($data_kosongan["temp_kosongan"],true);
            $this->db->set("temp_kosongan","");
            $this->db->set("validasi_edit","ACC");
            $this->db->where("kosongan_id",$kosongan_id);
            if($validasi=="Ditolak"){
                $this->db->update("skb_kosongan");
            }else{
                $this->db->update("skb_kosongan",$temp_kosongan);
            }
        }

        public function acccustomer($customer_id,$validasi){
            $this->db->set("validasi",$validasi);
            $this->db->where("customer_id",$customer_id);
            $this->db->update("skb_customer");
        }
        public function accdeletecustomer($customer_id,$validasi){
            if($validasi=="Ditolak"){
                $this->db->set("status_hapus","NO");
            }else{
                $this->db->set("status_hapus","YES");
            }
            $this->db->set("validasi_delete","ACC");
            $this->db->where("customer_id",$customer_id);
            $this->db->update("skb_customer");
        }
        public function acceditcustomer($customer_id,$validasi){
            $data_customer = $this->db->get_where("skb_customer",array("customer_id"=>$customer_id))->row_array();
            $temp_customer = json_decode($data_customer["temp_customer"],true);
            $this->db->set("temp_customer","");
            $this->db->set("validasi_edit","ACC");
            $this->db->where("customer_id",$customer_id);
            if($validasi=="Ditolak"){
                $this->db->update("skb_customer");
            }else{
                $this->db->update("skb_customer",$temp_customer);
            }
        }

        public function acctruck($truck_id,$validasi){
            $this->db->set("validasi",$validasi);
            $this->db->where("mobil_no",$truck_id);
            $this->db->update("skb_mobil");
        }
        public function accdeletetruck($mobil_no,$validasi){
            if($validasi=="Ditolak"){
                $this->db->set("status_hapus","NO");
            }else{
                $this->db->set("status_hapus","YES");
            }
            $this->db->set("validasi_delete","ACC");
            $this->db->where("mobil_no",$mobil_no);
            $this->db->update("skb_mobil");
        }
        public function accedittruck($mobil_no,$validasi){
            $data_mobil = $this->db->get_where("skb_mobil",array("mobil_no"=>$mobil_no))->row_array();
            $temp_mobil = json_decode($data_mobil["temp_mobil"],true);
            $this->db->set("temp_mobil","");
            $this->db->set("validasi_edit","ACC");
            $this->db->where("mobil_no",$mobil_no);
            if($validasi=="Ditolak"){
                $this->db->update("skb_mobil");
            }else{
                $this->db->update("skb_mobil",$temp_mobil);
            }
        }

        public function accrute($rute_id,$validasi){
            $this->db->set("validasi_rute",$validasi);
            $this->db->where("rute_id",$rute_id);
            $this->db->update("skb_rute");
        }
        public function accdeleterute($rute_id,$validasi){
            if($validasi=="Ditolak"){
                $this->db->set("rute_status_hapus","NO");
            }else{
                $this->db->set("rute_status_hapus","YES");
            }
            $this->db->set("validasi_rute_delete","ACC");
            $this->db->where("rute_id",$rute_id);
            $this->db->update("skb_rute");
        }
        public function acceditrute($rute_id,$validasi){
            $data_rute = $this->db->get_where("skb_rute",array("rute_id"=>$rute_id))->row_array();
            $temp_rute = json_decode($data_rute["temp_rute"],true);
            $this->db->set("temp_rute","");
            $this->db->set("validasi_rute_edit","ACC");
            $this->db->where("rute_id",$rute_id);
            if($validasi=="Ditolak"){
                $this->db->update("skb_rute");
            }else{
                $this->db->update("skb_rute",$temp_rute);
            }
        }

        public function accpaketan($paketan_id,$validasi){
            $this->db->set("validasi_paketan",$validasi);
            $this->db->where("paketan_id",$paketan_id);
            $this->db->update("skb_paketan");
        }
        public function accdeletepaketan($paketan_id,$validasi){
            if($validasi=="Ditolak"){
                $this->db->set("paketan_status_hapus","NO");
            }else{
                $this->db->set("paketan_status_hapus","YES");
            }
            $this->db->set("validasi_paketan_delete","ACC");
            $this->db->where("paketan_id",$paketan_id);
            $this->db->update("skb_paketan");
        }
        public function acceditpaketan($paketan_id,$validasi){
            $data_paketan = $this->db->get_where("skb_paketan",array("paketan_id"=>$paketan_id))->row_array();
            $temp_paketan = json_decode($data_paketan["temp_paketan"],true);
            $this->db->set("temp_paketan","");
            $this->db->set("validasi_paketan_edit","ACC");
            $this->db->where("paketan_id",$paketan_id);
            if($validasi=="Ditolak"){
                $this->db->update("skb_paketan");
            }else{
                $this->db->update("skb_paketan",$temp_paketan);
            }
        }

        public function accmerk($merk_id,$validasi){
            $this->db->set("validasi",$validasi);
            $this->db->where("merk_id",$merk_id);
            $this->db->update("skb_merk_kendaraan");
        }
        public function accdeletemerk($merk_id,$validasi){
            if($validasi=="Ditolak"){
                $this->db->set("status_hapus","NO");
            }else{
                $this->db->set("status_hapus","YES");
            }
            $this->db->set("validasi_delete","ACC");
            $this->db->where("merk_id",$merk_id);
            $this->db->update("skb_merk_kendaraan");
        }
        public function acceditmerk($merk_id,$validasi){
            $data_merk = $this->db->get_where("skb_merk_kendaraan",array("merk_id"=>$merk_id))->row_array();
            $temp_merk = json_decode($data_merk["temp_merk"],true);
            $this->db->set("temp_merk","");
            $this->db->set("validasi_edit","ACC");
            $this->db->where("merk_id",$merk_id);
            if($validasi=="Ditolak"){
                $this->db->update("skb_merk_kendaraan");
            }else{
                $this->db->update("skb_merk_kendaraan",$temp_merk);
                
                $data_truck = array(
                    "mobil_merk" => $temp_merk["merk_nama"],
                    "mobil_type" => $temp_merk["merk_type"],
                    "mobil_jenis" => $temp_merk["merk_jenis"],
                    "mobil_dump" => $temp_merk["merk_dump"]
                );
                $this->db->where("merk_id",$merk_id);
                $this->db->update("skb_mobil",$data_truck);
            }
        }
    //end fungsi acc
    //fungsi update
        public function update_jo_status($data,$supir,$mobil){
            $child_jo = $this->db->get_where("skb_job_order",array("parent_Jo_id"=>$data["jo_id"]))->result_array();
            for($i=0;$i<count($child_jo);$i++){
                $this->db->set("status","Sampai Tujuan");
                $this->db->set("tanggal_bongkar",$data["tanggal_bongkar"]);
                $this->db->set("tonase",$data["tonase"]);
                $this->db->where("Jo_id",$child_jo[$i]["Jo_id"]);
                $this->db->update("skb_job_order");
            }

            $this->db->set("tonase",$data["tonase"]);
            $this->db->set("keterangan",$data["keterangan"]);
            $this->db->set("status",$data["status"]);
            $this->db->set("tanggal_bongkar",$data["tanggal_bongkar"]);
            $this->db->where("Jo_id",$data["jo_id"]);
            $this->db->update("skb_job_order");

            $this->db->set("status_jalan","Tidak Jalan");
            $this->db->where("supir_id",$supir);
            $this->db->update("skb_supir");

            $this->db->set("status_jalan","Tidak Jalan");
            $this->db->where("mobil_no",str_replace("%20"," ",$mobil));
            $this->db->update("skb_mobil");
        }
        public function update_status_aktif_supir($data){
            $this->db->set("status_aktif",$data["status_aktif"]);
            if($data["status_aktif"]=="Aktif"){
                $this->db->set("supir_tgl_aktif",$data["supir_tgl_nonaktif"]);
                $this->db->set("supir_tgl_nonaktif",null);
            }else{
                $this->db->set("supir_tgl_nonaktif",$data["supir_tgl_nonaktif"]);
            }
            $this->db->where("supir_id",$data["supir_id"]);
            $this->db->update("skb_supir");
        }
        public function update_supir($data,$supir_id){
            $this->db->set("temp_supir",json_encode($data));
            $this->db->set("validasi_edit","Pending");
            $this->db->where("supir_id",$supir_id);
            $this->db->update("skb_supir");
        }
        public function update_kosongan($kosongan_id,$data){
            $this->db->set("temp_kosongan",json_encode($data));
            $this->db->set("validasi_edit","Pending");
            $this->db->where("kosongan_id",$kosongan_id);
            $this->db->update("skb_kosongan");
        }
        public function update_merk($data,$merk_id){
            // $data_merk = $this->db->get_where("skb_merk_kendaraan",array("merk_id"=>$merk_id))->row_array();

            // $this->db->set("jenis_mobil",$data["merk_jenis"]);
            // $this->db->where("jenis_mobil",$data_merk["merk_jenis"]);
            // $this->db->update("skb_rute");
    
            // $data_truck = array(
            //     "mobil_merk" => $data["merk_nama"],
            //     "mobil_type" => $data["merk_type"],
            //     "mobil_jenis" => $data["merk_jenis"],
            //     "mobil_dump" => $data["merk_dump"]
            // );
            // $this->db->where("merk_id",$merk_id);
            // $this->db->update("skb_mobil",$data_truck);
            
            $this->db->set("temp_merk",json_encode($data));
            $this->db->set("validasi_edit","Pending");
            $this->db->where("merk_id",$merk_id);
            $this->db->update("skb_merk_kendaraan");
            // $this->db->update("skb_merk_kendaraan",$data);
        }
        public function update_rute($data,$rute_id){
            $this->db->set("temp_rute",json_encode($data));
            $this->db->set("validasi_rute_edit","Pending");
            $this->db->where("rute_id",$rute_id);
            $this->db->update("skb_rute");
        }
        public function update_paketan($data,$paketan_id){
            $this->db->set("temp_paketan",json_encode($data));
            $this->db->set("validasi_paketan_edit","Pending");
            $this->db->where("paketan_id",$paketan_id);
            $this->db->update("skb_paketan");
        }
        public function update_customer($data){
            $data_temp = array(
                "customer_name"=>$data["customer_name"],
                "customer_alamat"=>$data["customer_alamat"],
                "customer_kontak_person"=>$data["customer_kontak_person"],
                "customer_telp"=>$data["customer_telp"],
                "customer_keterangan"=>$data["customer_keterangan"]
            );
            $this->db->set("temp_customer",json_encode($data_temp));
            $this->db->set("validasi_edit","Pending");
            $this->db->where("customer_id",$data["customer_id"]);
            $this->db->update("skb_customer");
        }
        public function update_truck($data){
            $this->db->set("temp_mobil",json_encode($data));
            $this->db->set("validasi_edit","Pending");
            $this->db->where("mobil_no",$data["mobil_no"]);
            $this->db->update("skb_mobil");
        }
        public function update_akun($data){
            $user = $this->db->get_where("user",array("akun_id"=>$data["akun_id"]))->row_array();
            if($user){
                $this->db->set("username",$data["username"]);
                $this->db->set("password",$data["password"]);
                $this->db->where("akun_id",$data["akun_id"]);
                $this->db->update("user");
            }else{
                $data_user = array(
                    "akun_id"=>$data["akun_id"],
                    "username"=>$data["username"],
                    "password"=>$data["password"]
                );
                $this->db->insert("user",$data_user);
            }
    
            $this->db->set("akun_name",$data["akun_name"]);
            $this->db->set("akun_role",$data["akun_role"]);
            $this->db->where("akun_id",$data["akun_id"]);
            $this->db->update("skb_akun");
        }
        public function update_konfigurasi($akun_id,$konfigurasi){
            // $data_konfigurasi=json_encode($data_konfigurasi);
            $konfigurasi=json_encode($konfigurasi);
            $this->db->set("akses",$konfigurasi);
            // $this->db->set("akun_akses",$data_konfigurasi);
            $this->db->where("akun_id",$akun_id);
            $this->db->update("skb_akun");
        }
    //end fungsi update
    //fungsi delete
        public function deletesupir($supir_id){
            $this->db->set("validasi_delete","Pending");
            $this->db->where("supir_id",$supir_id);
            return $this->db->update("skb_supir");
        }
        public function deletepaketan($paketan_id){
            $this->db->set("validasi_paketan_delete","Pending");
            $this->db->where("paketan_id",$paketan_id);
            return $this->db->update("skb_paketan");
        }
        public function deletekosongan($kosongan_id){
            $this->db->set("validasi_delete","Pending");
            $this->db->where("kosongan_id",$kosongan_id);
            return $this->db->update("skb_kosongan");
        }
        public function deletetruck($mobil_no){
            $this->db->set("validasi_delete","Pending");
            $this->db->where("mobil_no",$mobil_no);
            return $this->db->update("skb_mobil");
        }
        public function deletemerk($merk_id){
            $this->db->set("validasi_delete","Pending");
            $this->db->where("merk_id",$merk_id);
            return $this->db->update("skb_merk_kendaraan");
        }
        public function deletecustomer($customer_id){
            $this->db->set("validasi_delete","Pending");
            $this->db->where("customer_id",$customer_id);
            return $this->db->update("skb_customer");
        }
        public function deleterute($rute_id){
            $this->db->set("validasi_rute_delete","Pending");
            $this->db->where("rute_id",$rute_id);
            return $this->db->update("skb_rute");
        }
        public function deleteakun($akun_id){
            $this->db->where("akun_id",$akun_id);
            return $this->db->delete("skb_akun");
        }
    //end fungsi delete
    // fungsi untuk form joborder
        public function getrutebycustomer($customer_id){
            $this->db->select("rute_muatan");
            return $this->db->get_where("skb_rute",array("customer_id"=>$customer_id,"rute_status_hapus"=>"NO"))->result_array();
        }
        public function getrutebymuatan($customer_id,$muatan){
            $data_where = array(
                "customer_id"=>$customer_id,
                "rute_muatan"=>$muatan,
                "rute_status_hapus"=>"NO"
            );
            $this->db->select("rute_dari");
            $this->db->where($data_where);
            return $this->db->get("skb_rute")->result_array();
        }
        public function getrutebydari($customer_id,$muatan,$rute_dari){
            $data_where = array(
                "customer_id"=>$customer_id,
                "rute_muatan"=>$muatan,
                "rute_dari"=>$rute_dari,
                "rute_status_hapus"=>"NO"
            );
            $this->db->select("rute_ke");
            $this->db->where($data_where);
            return $this->db->get("skb_rute")->result_array();
        }
        public function getmobilbyjenis($mobil_jenis){
            return $this->db->get_where("skb_mobil",array("mobil_jenis"=>$mobil_jenis,"status_jalan"=>"Tidak Jalan","validasi"=>"ACC"))->result_array();
        }
        public function getallmobil(){
            return $this->db->get_where("skb_mobil",array("status_hapus"=>"No"))->result_array();
        }
        public function getrutefix($data){
            if($data["rute_tonase"]!=0){
                $data_where = array(
                    "customer_id"=>$data["customer_id"],
                    "rute_muatan"=>$data["muatan"],
                    "rute_dari"=>$data["rute_dari"],
                    "rute_ke"=>$data["rute_ke"],
                    "rute_status_hapus"=>"NO",
                    "rute_tonase"=>$data["rute_tonase"]
                );
            }else{
                $data_where = array(
                    "customer_id"=>$data["customer_id"],
                    "rute_muatan"=>$data["muatan"],
                    "rute_dari"=>$data["rute_dari"],
                    "rute_ke"=>$data["rute_ke"],
                    "rute_status_hapus"=>"NO",
                    "rute_tonase"=>"0"
                );
            }
            if($data["mobil_jenis"]=="Sedang(Engkel)"){
                $this->db->select("rute_uj_engkel,rute_gaji_engkel,rute_tonase,rute_gaji_engkel_rumusan,rute_tagihan");
            }else{
                $this->db->select("rute_uj_tronton,rute_gaji_tronton,rute_tonase,rute_gaji_tronton_rumusan,rute_tagihan");
            }
            $this->db->where($data_where);
            return $this->db->get("skb_rute")->row_array();
        }
        public function getrutetonase($data){
            $data_where = array(
                "customer_id"=>$data["customer_id"],
                "rute_muatan"=>$data["muatan"],
                "rute_dari"=>$data["rute_dari"],
                "rute_ke"=>$data["rute_ke"],
                "rute_status_hapus"=>"NO",
                "rute_tonase!="=>"0"
            );
            $this->db->where($data_where);
            return $this->db->get("skb_rute")->result_array();
        }
    // end fungsi untuk form joborder
    //fungsi untuk datatables pilih jo untuk invoice
        public function count_all_jo($customer_id)
        {
            $this->db->where("customer_id",$customer_id);
            $this->db->where("status","Sampai Tujuan");
            $this->db->where("invoice_id","");
            return $this->db->count_all_results("skb_job_order");
        }

        public function filter_jo($order_field, $order_ascdesc,$customer_id)
        {
            $this->db->where("customer_id",$customer_id);
            $this->db->where("status","Sampai Tujuan");
            $this->db->where("invoice_id","");
            $this->db->order_by($order_field, $order_ascdesc);
            return $this->db->get('skb_job_order')->result_array();
        }

        public function count_filter_jo($customer_id)
        {
            $this->db->where("customer_id",$customer_id);
            $this->db->where("status","Sampai Tujuan");
            $this->db->where("invoice_id","");
            return $this->db->get('skb_job_order')->num_rows();
        }
    // end fungsi untuk datatables pilih jo untuk invoice
}