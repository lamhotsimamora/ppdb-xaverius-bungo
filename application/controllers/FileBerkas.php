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


	public function api_upload_file(){
		$id_peserta = $this->input->post('id');
		
		validationInput($id_peserta);
		$id_peserta =(int)$id_peserta;
		
		$filename = generateFileName();

		$config['upload_path']      = './public/file/';
		$config['allowed_types']    = 'jpeg|gif|jpg|png';
		$config['max_size']         = 800;
		$config['file_name']        = $filename;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);

		$result= array('result'=>false,'message'=>'File gagal diupload!');

		$result_upload = $this->upload->do_upload('file_kartu_keluarga');

		if ( $result_upload )
		{
			$this->load->model("M_file");
			
			$this->M_file->id_peserta = $id_peserta;
			
			$filename = $this->upload->data('file_name');   

			$this->M_file->kartu_keluarga = $filename;

			$checkFile =$this->M_file->checkData();
			
			$save=false;
			
			if ($checkFile==false){			
				$save = $this->M_file->addData();
			}else{
				$save = $this->M_file->updateData();
			}
			
			if ($save){
				$result = array('result'=>true,'message'=>'File berhasil diupload !');
			}
		}

		echo json_encode($result);
	}
	
}
