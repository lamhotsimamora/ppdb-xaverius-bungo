<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta extends CI_Controller {

	public function index(){
		
	}

	public function add(){
		$this->load->model('M_peserta');

		$this->M_peserta->nama_lengkap = $this->input->post('nama_lengkap');

		$result = $this->M_peserta->add();
		
		echo json_encode($result); 
	}

	public function loadData(){
		$this->load->model('M_peserta');

		$result = $this->M_peserta->loadData();
		
		echo json_encode($result); 
	}
}
