<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('model_login');//load model
    }

    public function index(){
        $this->load->view("login");
    }

    public function logout(){
        session_destroy();
        redirect(base_url());
    }
    
    public function login(){
        $username = $this->input->post("username");
        $password = sha1($this->input->post("password"));
        $user = $this->model_login->getuserbyusername($username);
        $akun = $this->model_login->getakunbyid($user["akun_id"]);
        // $redirect = ["truck","","bon","report","akun"];
        $akun_akses = json_decode($akun["akun_akses"]);
        if($user){
            $save_password = $user["password"];
            if($password == $save_password){
                $this->session->set_flashdata('status-login', 'Berhasil');
                $_SESSION["user_id"] = $user["akun_id"];
                $_SESSION["user"] = $user["akun_name"];
                $_SESSION["role"] = $user["akun_role"];
                for($i=0;$i<count($akun_akses);$i++){
                    if($akun_akses[$i]==1){
                        redirect(base_url("index.php/dashboard/"));
                        break;
                    }
                }
            }else{
                $this->session->set_flashdata('status-login', 'Password');
                redirect(base_url());                
            }
        }else{
			$this->session->set_flashdata('status-login', 'Username');
            redirect(base_url());
        }
    }
}