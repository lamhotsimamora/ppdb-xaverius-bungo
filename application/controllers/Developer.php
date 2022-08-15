<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Developer extends CI_Controller {

	public function index(){
		
	}

	public function add(){
		$this->load->model('M_developer');

		$this->M_developer->nama_rumah = $this->input->post('nama_rumah');
		$this->M_developer->id_type = $this->input->post('id_type');
		$this->M_developer->harga_rumah = $this->input->post('harga_rumah');
		$this->M_developer->id_developer = $this->input->post('id_developer');
		$this->M_developer->detail = $this->input->post('detail');

		$result = $this->M_developer->add();
		
		echo json_encode($result); 
	}

	public function loadData(){
		$this->load->model('M_developer');

		$result = $this->M_developer->loadData();
		
		echo json_encode($result); 
	}
}
