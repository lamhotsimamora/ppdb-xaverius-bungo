<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type extends CI_Controller {

	public function index(){
		
	}

	public function addData(){
		$this->load->model('M_type');

		$this->M_type->type = $this->input->post('type');

		$result = $this->M_type->add();
		
		$response = array("message"=>'Failed add data','result'=>false);

		if ($result){
			$response = array("message"=>'success add data','result'=>true);
		}
		echo json_encode($response);
	}

	public function loadData(){
		$this->load->model('M_type');

		$result = $this->M_type->loadData();
		
		echo json_encode($result); 
	}
}
