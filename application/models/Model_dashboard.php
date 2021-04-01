<?php
// error_reporting(0);
class Model_Dashboard extends CI_model
{
     //function-fiunction datatable truck dashboard
        public function count_all_truck($fungsi)
        {
            $this->db->where("status_hapus","NO");
            if($_SESSION["role"]=="Supervisor"){
                $this->db->where("validasi","Pending");
            }else{
                $this->db->where("validasi","ACC");
            }
            return $this->db->count_all_results("skb_mobil");
        }

        public function filter_truck($fungsi,$search, $order_field, $order_ascdesc)
        {
            if($search!=""){
                $this->db->like('mobil_no', $search);
                $this->db->or_like('mobil_jenis', $search);
                $this->db->or_like('mobil_merk', $search);
                $this->db->or_like('mobil_type', $search);
                $this->db->or_like('mobil_tahun', $search);
            }
            $this->db->order_by($order_field, $order_ascdesc);
            $hasil = $this->db->get('skb_mobil')->result_array();
            $hasil_fix = [];
            for($i=0;$i<count($hasil);$i++){
                if($fungsi=="nopol"){
                    $tanggal = $hasil[$i]["mobil_berlaku"];
                }else if($fungsi=="kir"){
                    $tanggal = $hasil[$i]["mobil_berlaku_kir"];
                }else if($fungsi=="stnk"){
                    $tanggal = $hasil[$i]["mobil_berlaku_stnk"];
                }else if($fungsi=="ijin"){
                    $tanggal = $hasil[$i]["mobil_berlaku_ijin_bongkar"];
                }else{
                    $tanggal = "0000-00-00";
                }
                $tanggal_now = date("Y-m-d");
                $tgl1 = new DateTime($tanggal_now);
                $tgl2 = new DateTime($tanggal);
                $d = $tgl2->diff($tgl1)->days + 1;
                if($fungsi=="tidak_jalan"){
                    if($_SESSION["role"]=="Supervisor"){
                        if($hasil[$i]["status_hapus"]=="NO" && $hasil[$i]["status_jalan"]=="Tidak Jalan" && $hasil[$i]["validasi"]=="Pending"){
                            $hasil_fix[] = $hasil[$i];
                        }
                    }else{
                        if($hasil[$i]["status_hapus"]=="NO" && $hasil[$i]["status_jalan"]=="Tidak Jalan" && $hasil[$i]["validasi"]=="ACC"){
                            $hasil_fix[] = $hasil[$i];
                        }
                    }   
                }else{
                    if($_SESSION["role"]=="Supervisor"){
                        if($hasil[$i]["status_hapus"]=="NO" && $d<31 && $tanggal!=null  && $hasil[$i]["validasi"]=="Pending"){
                            $hasil_fix[] = $hasil[$i];
                        }
                    }else{
                        if($hasil[$i]["status_hapus"]=="NO" && $d<31 && $tanggal!=null  && $hasil[$i]["validasi"]=="ACC"){
                            $hasil_fix[] = $hasil[$i];
                        }
                    }
                }
            }
            return $hasil_fix;   
        }

        public function count_filter_truck($fungsi,$search)
        {
            if($search!=""){
                $this->db->like('mobil_no', $search);
                $this->db->or_like('mobil_jenis', $search);
                $this->db->or_like('mobil_merk', $search);
                $this->db->or_like('mobil_type', $search);
                $this->db->or_like('mobil_tahun', $search);
            }
            $hasil_data = $this->db->get('skb_mobil')->result_array();
                $hasil_fix = 0;
                for($i=0;$i<count($hasil_data);$i++){
                    if($fungsi=="nopol"){
                        $tanggal = $hasil_data[$i]["mobil_berlaku"];
                    }else if($fungsi=="kir"){
                        $tanggal = $hasil_data[$i]["mobil_berlaku_kir"];
                    }else if($fungsi=="stnk"){
                        $tanggal = $hasil_data[$i]["mobil_berlaku_stnk"];
                    }else if($fungsi=="ijin"){
                        $tanggal = $hasil_data[$i]["mobil_berlaku_ijin_bongkar"];
                    }else{
                        $tanggal = "0000-00-00";
                    }
                    $tanggal_now = date("Y-m-d");
                    $tgl1 = new DateTime($tanggal_now);
                    $tgl2 = new DateTime($tanggal);
                    $d = $tgl2->diff($tgl1)->days + 1;
                    if($fungsi="tidak_jalan"){
                        if($_SESSION["role"]=="Supervisor"){
                            if($hasil_data[$i]["status_hapus"]=="NO" && $hasil_data[$i]["status_jalan"]=="Tidak Jalan" && $hasil_data[$i]["validasi"]=="Pending"){
                                $hasil_fix +=1;
                            }
                        }else{
                            if($hasil_data[$i]["status_hapus"]=="NO" && $hasil_data[$i]["status_jalan"]=="Tidak Jalan" && $hasil_data[$i]["validasi"]=="ACC"){
                                $hasil_fix +=1;
                            }
                        }
                    }else{
                        if($_SESSION["role"]=="Supervisor"){
                            if($hasil_data[$i]["status_hapus"]=="NO"  && $d<31 && $tanggal!=null && $hasil_data[$i]["validasi"]=="Pending"){
                                $hasil_fix +=1;
                            }
                        }else{
                            if($hasil_data[$i]["status_hapus"]=="NO"  && $d<31 && $tanggal!=null && $hasil_data[$i]["validasi"]=="ACC"){
                                $hasil_fix +=1;
                            }
                        }
                    }
                }
                return $hasil_fix;
        }
    //akhir function-fiunction datatable truck dashboard
    //  Function Supir
        public function count_all_supir($fungsi)
        {
            $this->db->where("status_hapus","NO");
            if($_SESSION["role"]=="Supervisor"){
                $this->db->where("validasi","Pending");
            }else{
                $this->db->where("validasi","ACC");
            }
            return $this->db->count_all_results("skb_supir");
        }

        public function filter_supir($fungsi,$search, $order_field, $order_ascdesc)
        {
            $this->db->like('supir_name', $search);
            $this->db->where("status_hapus","NO");
            $this->db->order_by($order_field, $order_ascdesc);
            $hasil = $this->db->get('skb_supir')->result_array();
            $hasil_fix = [];
            for($i=0;$i<count($hasil);$i++){
                if($fungsi=="sim"){
                    $tanggal = $hasil[$i]["supir_tgl_sim"];
                }else{
                    $tanggal = "0000-00-00";
                }
                $tanggal_now = date("Y-m-d");
                $tgl1 = new DateTime($tanggal_now);
                $tgl2 = new DateTime($tanggal);
                $d = $tgl2->diff($tgl1)->days + 1;
                if($fungsi=="tidak_jalan"){
                    if($_SESSION["role"]=="Supervisor"){
                        if($hasil[$i]["status_hapus"]=="NO" && $hasil[$i]["status_jalan"]=="Tidak Jalan" && $hasil[$i]["validasi"]=="Pending"){
                            $hasil_fix[] = $hasil[$i];
                        }
                    }else{
                        if($hasil[$i]["status_hapus"]=="NO" && $hasil[$i]["status_jalan"]=="Tidak Jalan" && $hasil[$i]["validasi"]=="ACC"){
                            $hasil_fix[] = $hasil[$i];
                        }
                    }   
                }else{
                    if($_SESSION["role"]=="Supervisor"){
                        if($hasil[$i]["status_hapus"]=="NO" && $d<31 && $tanggal!=null  && $hasil[$i]["validasi"]=="Pending"){
                            $hasil_fix[] = $hasil[$i];
                        }
                    }else{
                        if($hasil[$i]["status_hapus"]=="NO" && $d<31 && $tanggal!=null  && $hasil[$i]["validasi"]=="ACC"){
                            $hasil_fix[] = $hasil[$i];
                        }
                    }
                }
            }
            return $hasil_fix;   
        }

        public function count_filter_supir($fungsi,$search)
        {
            $this->db->like('supir_name', $search);
            $this->db->where("status_hapus","NO");
            $hasil_data = $this->db->get('skb_supir')->result_array();
            $hasil_fix = 0;
            for($i=0;$i<count($hasil_data);$i++){
                if($fungsi=="sim"){
                    $tanggal = $hasil_data[$i]["supir_tgl_sim"];
                }else{
                    $tanggal = "0000-00-00";
                }
                $tanggal_now = date("Y-m-d");
                $tgl1 = new DateTime($tanggal_now);
                $tgl2 = new DateTime($tanggal);
                $d = $tgl2->diff($tgl1)->days + 1;
                if($fungsi="tidak_jalan"){
                    if($_SESSION["role"]=="Supervisor"){
                        if($hasil_data[$i]["status_hapus"]=="NO" && $hasil_data[$i]["status_jalan"]=="Tidak Jalan" && $hasil_data[$i]["validasi"]=="Pending"){
                            $hasil_fix +=1;
                        }
                    }else{
                        if($hasil_data[$i]["status_hapus"]=="NO" && $hasil_data[$i]["status_jalan"]=="Tidak Jalan" && $hasil_data[$i]["validasi"]=="ACC"){
                            $hasil_fix +=1;
                        }
                    }
                }else{
                    if($_SESSION["role"]=="Supervisor"){
                        if($hasil_data[$i]["status_hapus"]=="NO"  && $d<31 && $tanggal!=null && $hasil_data[$i]["validasi"]=="Pending"){
                            $hasil_fix +=1;
                        }
                    }else{
                        if($hasil_data[$i]["status_hapus"]=="NO"  && $d<31 && $tanggal!=null && $hasil_data[$i]["validasi"]=="ACC"){
                            $hasil_fix +=1;
                        }
                    }
                }
            }
            return $hasil_fix;
            
        }
    //  end Function Supir

    public function generate_selisih_tanggal($tanggal){
        $tanggal_now = date("Y-m-d");
        $tgl1 = new DateTime($tanggal_now);
        $tgl2 = new DateTime($tanggal);
        $d = $tgl2->diff($tgl1)->days + 1;
        echo $d;
    }
}