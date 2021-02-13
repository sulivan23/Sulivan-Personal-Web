<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model("LoginModels");
        $this->load->library("customfunction");
        if($this->session->userdata("user_id") !== NULL){
            $this->customfunction->redirect("dashboard");
        }
    }

    public function index()
    {
        //$data['show_alert'] = $this->customfunction->showAlert();
        $data['title']  = "Dashboard Login";
        $data['token']  = $this->security->get_csrf_hash();
        $data['token_name'] = $this->security->get_csrf_token_name();
        return view('indexlogin', $data);
    }

    public function loginProcess()
    {
        $username = $this->input->post("username");
        $password = $this->db->escape_str($this->input->post("password"));
        $users = $this->LoginModels->login($username);
        if($users->num_rows() > 0){
            $data = $users->result(); 
            foreach($data as $rows){
                if(password_verify($password, $rows->password)){
                    $this->session->set_userdata('user_id', $rows->user_id);
                    $this->session->set_userdata('email', $rows->email);
                    $this->session->set_userdata('last_update', $rows->last_update);
                    $this->session->set_userdata('last_login', $rows->last_login);
                    $this->session->set_userdata('date_registered', $rows->date_registered);
                    redirect(base_url()."dashboard");
                }else{
                    $this->customfunction->alert("warning", "Username atau password yang anda masukan salah");
                    $this->customfunction->historyBack();
                }
            }
        }else{
            $this->customfunction->alert("warning", "Username atau password yang anda masukan salah");
            $this->customfunction->historyBack();
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url("auth"));
    }
}
