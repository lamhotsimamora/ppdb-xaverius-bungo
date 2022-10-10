
<?php
defined("BASEPATH") or exit("No direct script access allowed");

class M_Sekolah extends CI_Model
{
	// Definisi field/colomn tabel
	public $id_school;public $name;public $info;
	//

	// Definisi nama tabel
	protected $table      = "school";

	protected $primaryKey ="id_school";
	protected $useAutoIncrement = true;

	protected $useTimestamps = false;
	protected $createdField  = "created_at";
	protected $updatedField  = "updated_at";
	protected $deletedField  = "deleted_at";

	public function loadData()
	{
		$this->db->select("*")
				->from($this->table);
		$obj = $this->db->get();
		return $obj->result_array();
	}

	public function loadDataById()
	{
		$this->db->select("*")
				->from($this->table)
				->where([$this->primaryKey => $this->id_school]);

		$obj = $this->db->get();
		$data  = $obj->result_array();
		return (count($data)) > 0 ? $data[0] : null;
	}

	public function countData(){
		$this->db->select($this->primaryKey)
				->from($this->table);
		$obj = $this->db->get();
		$data =$obj->result_array();
		return count($data);
	}

	public function checkDataById()
	{
		$this->db->select($this->primaryKey)
			->from($this->table)
			->where([$this->primaryKey => $this->id_school]);

		$obj = $this->db->get();
		$data  = $obj->result_array();
		return count($data) > 0 ? true : false;
	}

	public function searchWhere()
	{
		$this->db->select("*")
			->from($this->table)
			->where(["name" => $this->name]);

		$obj = $this->db->get();
		$data  = $obj->result_array();

		return (count($data) > 0) ? $data : null;
	}

	public function searchLike()
	{
		$this->db->select("*")
			->from($this->table)
			->like("name", $this->name);

		$obj = $this->db->get();
		$data  = $obj->result_array();

		return (count($data) > 0) ? $data : false;
	}

	public function add()
	{
		$data = array(
			"name" => $this->name,"info" => $this->info,
		);
		return $this->db->insert($this->table, $data);
	}

	public function update()
	{
		$data = array(
			"name" => $this->name,"info" => $this->info,
		);
		$this->db->where($this->primaryKey, $this->id_school);
		return $this->db->update($this->table, $data);
	}

	public function delete()
	{
		return $this->db->delete($this->table, array($this->primaryKey => $this->id_school));
	}
}
