<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function index(){
		
	}

	public function add(){
		$this->load->model('M_customer');

		$this->M_customer->nama_rumah = $this->input->post('nama_rumah');
		$this->M_customer->id_type = $this->input->post('id_type');
		$this->M_customer->harga_rumah = $this->input->post('harga_rumah');
		$this->M_customer->id_developer = $this->input->post('id_developer');
		$this->M_customer->detail = $this->input->post('detail');

		$result = $this->M_customer->add();
		
		echo json_encode($result); 
	}

	public function loadData(){
		$this->load->model('M_customer');

		$result = $this->M_customer->loadData();
		
		echo json_encode($result); 
	}
}
