<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function AuthLogin(){
		$admin = $this->session->has_userdata('admin');
		$token = $this->session->has_userdata('token');
		
		if ($admin==false || $admin ==null || $token == false || $token == null)
		{
			return false;
		}else{
			
			$token = $this->session->userdata('token');
			$token = $token[0]->{"token"};

			$this->M_admin->token = $token;
		
			if (!$this->M_admin->checkToken()){
				$this->session->unset_userdata('admin');
				$this->session->unset_userdata('token');
				return false;
			}
		}
		return true;
	}

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin');
	}

	public function index(){
		if ($this->AuthLogin()){
			$this->load->view('admin/home/');
		}else{
			$this->load->view('admin/login');
		}
	}

	public function login(){
		if (!$this->AuthLogin()){
			$this->load->view('login');
		}else{
			$this->load->view('admin');
		}
	}

	

	public function home(){
		if ($this->AuthLogin()){
			$this->load->view('admin/home');
		}
		else{
			$this->load->view('admin/login');
		}
	}




	public function logout(){
		$this->session->unset_userdata('admin');
		$this->session->unset_userdata('token');
		redirect(base_url('/'));
	}

	public function api_login()
	{
		$response = array('message'=>'Login Failed','result'=>false);


		$this->M_admin->username =  $this->input->post('username');
		$this->M_admin->password = $this->input->post('password');

		$result = $this->M_admin->login();
		
		if ($result){

			$token= $this->M_admin->getToken();
	
			$this->session->set_userdata('admin',true);
			$this->session->set_userdata('token',$token);

			$response = array('message'=>'Login Success','result'=>true);
		}
		echo json_encode($response);
	}

	public function add(){
		$result = $this->M_admin->add();
		
		var_dump($result);
	}

	
}
