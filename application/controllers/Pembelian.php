<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller {

	public function index(){
		
	}

	public function add(){
		$this->load->model('M_pembelian');

		$this->M_pembelian->name = $this->input->post('name');
		$this->M_pembelian->hp = $this->input->post('hp');

		$result = $this->M_pembelian->add();
		
		echo json_encode($result); 
	}

	public function loadData(){
		$this->load->model('M_pembelian');

		$result = $this->M_pembelian->loadData();
		
		echo json_encode($result); 
	}
}
