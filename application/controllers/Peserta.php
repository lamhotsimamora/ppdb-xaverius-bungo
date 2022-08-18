<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peserta extends CI_Controller
{
	public $session_peserta;
	public $session_token;

	public function AuthLogin(){
		
		if ($this->session_peserta==false || $this->session_peserta ==null || $this->session_token == false 
			|| $this->session_token == null)
		{
			return false;
		}else{
			
			$token = $this->session->userdata('token');
			$token = $token[0]->{"token"};

			$this->M_peserta->token = $token;
		
			if (!$this->M_peserta->checkToken()){
				$this->session->unset_userdata('peserta');
				$this->session->unset_userdata('token');
				return false;
			}
		}
		return true;
	}

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_peserta');
		
		$this->session_peserta	= $this->session->has_userdata('peserta');
		$this->session_token	= $this->session->has_userdata('token');
	}

	public function logout(){
		$this->session->unset_userdata('peserta');
		$this->session->unset_userdata('token');
		redirect(base_url('/'));
	}


	public function loadData_byId(){

		if (!$this->AuthLogin()){
			exit(json_encode(array('message'=>'access denied')));
		}

		$id_peserta = $this->input->post('id_peserta');
	
		validationInput($id_peserta);

		$this->M_peserta->id_peserta = $id_peserta;

		$result = $this->M_peserta->loadData_byId();
		echo json_encode($result);
	}

	public function index()
	{
		$data['session_peserta'] = $this->session_peserta;
		if ($this->AuthLogin()){
			$token =  $this->session->userdata('token');
			$token = $token[0]->{'token'};
			$id_peserta = $this->M_peserta->getIdPeserta();
			$id_peserta = $id_peserta->{'id_peserta'};
			
			$data['id_peserta'] = $id_peserta;
			$this->load->view('peserta/home',$data);
			
		}else{
			$this->load->view('peserta/index',$data);
		}
	}

	public function home(){
		
		$data['session_peserta'] = $this->session_peserta;
		if ($this->AuthLogin()){
			$token =  $this->session->userdata('token');
			$token = $token[0]->{'token'};
			$id_peserta = $this->M_peserta->getIdPeserta();
			$id_peserta = $id_peserta->{'id_peserta'};
			
			$data['id_peserta'] = $id_peserta;
			$this->load->view('peserta/home',$data);
		}else{
			redirect('./peserta/index');
		}
	}


	public function daftar()
	{
		$data['session_peserta'] = $this->session_peserta;
		$this->load->view('peserta/daftar',$data);
	}

	public function upload(){
		$data['session_peserta'] = $this->session_peserta;
		if ($this->AuthLogin()){
			$token =  $this->session->userdata('token');
			$token = $token[0]->{'token'};
			$id_peserta = $this->M_peserta->getIdPeserta();
			$id_peserta = $id_peserta->{'id_peserta'};
			
			$data['id_peserta'] = $id_peserta;
			$this->load->view('peserta/upload',$data);
		}else{
			redirect('./peserta/index');
		}
	}

	public function login()
	{
		$data['session_peserta'] = $this->session_peserta;
		if ($this->AuthLogin()){
			$this->load->view('peserta/home',$data);
		}else{
			$this->load->view('peserta/login',$data);
		}
	}

	public function api_login(){

		$username=$this->M_peserta->username = $this->input->post('username');
		$password=$this->M_peserta->password = $this->input->post('password');

		validationInput($username,$password);

		$login = $this->M_peserta->login();
		
		
		$response  = array('result' => false,'message'=>'Login gagal');
		if ($login){
			$token= $this->M_peserta->getToken();
	
			$this->session->set_userdata('peserta',true);
			$this->session->set_userdata('token',$token);
			$response = array('result' => true,'message'=>'Login Berhasil','token'=>$token);
		}
		echo json_encode($response);
	}

	public function api_save_data(){
		if (!$this->AuthLogin()){
			exit(json_encode(array('message'=>'access denied')));
		}

		$nama_lengkap=$this->M_peserta->nama_lengkap = $this->input->post('nama_lengkap');
		$alamat=$this->M_peserta->alamat = $this->input->post('alamat');
		$asal_sekolah=$this->M_peserta->asal_sekolah = $this->input->post('asal_sekolah');
		$ayah=$this->M_peserta->ayah = $this->input->post('ayah');
		$ibu=$this->M_peserta->ibu = $this->input->post('ibu');
		$hp=$this->M_peserta->hp = $this->input->post('hp');
		$agama=$this->M_peserta->agama = $this->input->post('agama');
		$id_peserta = $this->M_peserta->id_peserta = $this->input->post('id_peserta');

		validationInput($id_peserta,$nama_lengkap,$alamat,$asal_sekolah,$ayah,$ibu,$hp,$agama);

		$result = $this->M_peserta->save_data();

		$response  = array('result' => false,'message'=>'Save data gagal');
		if ($result) {

			$response = array('result' => true,'message'=>'Data Berhasil Disimpan');
		}
		echo json_encode($response);
	}

	public function api_daftar()
	{
		
		$username=$this->M_peserta->username = $this->input->post('username');
		$password=$this->M_peserta->password = $this->input->post('password');

		validationInput($username,$password);

		$check = $this->M_peserta->checkUsername();

		if ($check){
			$response = array('result' => false,'message'=>'Username sudah digunakan');
			exit(json_encode($response));
		}

		$daftar = $this->M_peserta->daftar();


		$response  = array('result' => false,'message'=>'Pendaftaran gagal');
		if ($daftar) {
			
			$response = array('result' => true,'message'=>'Pendaftaran Berhasil');
		}
		echo json_encode($response);
	}


	
}
