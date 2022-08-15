<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rumah extends CI_Controller {

	public function index(){
		
	}

	public function add(){
		$this->load->model('M_rumah');

		$this->M_rumah->nama_rumah = $this->input->post('nama_rumah');
		$this->M_rumah->id_type = $this->input->post('id_type');
		$this->M_rumah->harga_rumah = $this->input->post('harga_rumah');
		$this->M_rumah->id_developer = $this->input->post('id_developer');
		$this->M_rumah->detail = $this->input->post('detail');

		$result = $this->M_rumah->add();
		
		echo json_encode($result); 
	}

	public function loadData(){
		$this->load->model('M_rumah');

		$result = $this->M_rumah->loadData();
		
		echo json_encode($result); 
	}
}
