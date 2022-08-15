<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {

	public function index(){
		
	}

	public function add(){
		$this->load->model('M_sales');

		$this->M_sales->name = $this->input->post('name');
		$this->M_sales->hp = $this->input->post('hp');

		$result = $this->M_sales->add();
		
		echo json_encode($result); 
	}

	public function loadData(){
		$this->load->model('M_sales');

		$result = $this->M_sales->loadData();
		
		echo json_encode($result); 
	}
}
