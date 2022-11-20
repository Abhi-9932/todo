<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('User', 'u');
        $this->load->database();
    }
    public function index(){
        $this->load->view('login');
    }
    #reg
	public function register()
	{
		$this->form_validation->set_rules('reg_email', 'Email-ID', 'required|valid_email');
		$this->form_validation->set_rules('reg_name', 'Full Name', 'required');
		$this->form_validation->set_rules('reg_dob', 'Date Of Birth', 'required');
		$this->form_validation->set_rules('reg_password', 'Password', 'required');
		$this->form_validation->set_rules('reg_confirm_password', 'Confirm Password', 'required|matches[reg_password]');

        if ($this->form_validation->run() == FALSE){
            $this->load->view('welcome_message');
        }else{
            $insert = array(
                'email' => $this->db->escape_str(trim($this->input->post('reg_email'))),
                'name' => $this->db->escape_str(trim($this->input->post('reg_name'))),
                'dob' => $this->db->escape_str(trim($this->input->post('reg_dob'))),
                'pass' => $this->db->escape_str(trim($this->input->post('reg_password'))),
            );
            $array = $this->u->register($insert);
            if(!empty($array)){
                $this->session->set_userdata('userdata', $array);
                redirect('dashboard');
            }else{
                $this->session->set_flashdata('reg_error','Registration Not Successfull');
                $this->load->view('welcome_message');
            }
        }
	}
    #login
    public function login(){
        $this->form_validation->set_rules('reg_email', 'Email-ID', 'required|valid_email');
        $this->form_validation->set_rules('reg_password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE){
            $this->load->view('login');
        }else{
            $check = array(
                'email' => $this->db->escape_str(trim($this->input->post('reg_email'))),
                'pass' => $this->db->escape_str(trim($this->input->post('reg_password'))),
            );
            $checking = $this->u->login($check);
            if($checking){
                $this->session->set_userdata('userdata', $checking);
                redirect('dashboard');
            }
            $this->session->set_flashdata('login_error','Your Email-ID Or Password does not matched.');
            redirect('login');  
        }
    }
    #dashboard
    public function dashboard(){
        $session = $this->session->userdata('userdata');
        if(!empty($session)){
            $data['users'] = $this->u->alldata();
            $this->load->view('dashboard', $data);
        }else{
            $this->session->unset_userdata('userdata');
            $this->session->sess_destroy();
            redirect('login');
        }        
    }
    #delete
    public function userdelete($id = null){
        $id = base64_decode($id);
        $this->session->set_flashdata('id_blank','Something Went Wrong.');
        if($id != ''){
            $res = $this->u->delete_user($this->db->escape_str(trim($id)));
            if($res){
                $this->session->set_flashdata('delete_success','User Data deleted');
            }else{
                $this->session->set_flashdata('delete_error','User Data not deleted.');
            }
        }
        redirect('dashboard');
    }

    #logout
    public function logout(){
        $this->session->sess_destroy();
        redirect('dashboard');
    }
}
