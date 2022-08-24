<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FileBerkas extends CI_Controller
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
		$this->load->model('M_file');
		
		$this->session_peserta	= $this->session->has_userdata('peserta');
		$this->session_token	= $this->session->has_userdata('token');
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


	
}
