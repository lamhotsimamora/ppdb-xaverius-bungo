
<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Sekolah extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_Sekolah");
	}

	public function index(){	
		$this->load->view("Sekolah");
	}

	public function show(){
		$this->M_Sekolah->id_school = 1;
		$data = $this->M_Sekolah->loadDataById();
		echo json_encode($data);
	}

	public function save(){

		$name = $this->input->post("name");
		$info = $this->input->post("info"); 
		
		$this->M_Sekolah->name = $name;
		$this->M_Sekolah->info = $info;

		validationInput($name,$info);

		$result = $this->M_Sekolah->add();

		if ($result){
			echo json_encode(array("result"=>true,"message"=>"Success"));
		}else{
			echo json_encode(array("result"=>false,"message"=>"Failed"));
		}
	}

	public function update(){
		$id_school = $this->input->post("id_school");
		$name = $this->input->post("name");
		$info = $this->input->post("info"); 

		$this->M_Sekolah->id_school = $id_school;
		$this->M_Sekolah->name = $name;
		$this->M_Sekolah->info = $info;

		$result = $this->M_Sekolah->update();

		if ($result){
			echo json_encode(array("result"=>true,"message"=>"Success"));
		}else{
			echo json_encode(array("result"=>false,"message"=>"Failed"));
		}
	}

	public function search(){
		$this->M_Sekolah->name= $this->input->post("search");

		$result = $this->M_Sekolah->search();

		if ($result){
			echo json_encode(array("result"=>true,"data"=>$result));
		}else{
			echo json_encode(array("result"=>false,"message"=>"Failed"));
		}
	}

	public function delete(){
		$id_school = $this->input->post("id_school");

		$this->M_Sekolah->id_school = $id_school;

		$result = $this->M_Sekolah->delete();

		if ($result){
			echo json_encode(array("result"=>true,"message"=>"Success"));
		}else{
			echo json_encode(array("result"=>false,"message"=>"Failed"));
		}
	}

}
