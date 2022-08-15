<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_sales extends CI_Model
{

	// Definisi field/colomn tabel
	public $id_sales;
	public $name;
	public $hp;
	//

	// Definisi nama tabel
	protected $table      = 't_sales';
	protected $primaryKey = 'id_sales';
	protected $useAutoIncrement = true;

	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';

	public function loadData()
	{
		$this->db->select('*')
			->from($this->table);
		$obj = $this->db->get();
		$data  = $obj->result();
		return $data;
	}

	public function search()
	{
		$this->db->select('*')
			->from($this->table)
			->where(['name' => $this->name]);

		$obj = $this->db->get();
		$data  = $obj->result();

		return (count($data) > 0) ? true : false;
	}


	public function add()
	{
		$data = array(
			'name' => $this->name,
			'hp' => $this->hp,
		);
		return $this->db->insert($this->table, $data);
	}

	public function update()
	{

		$data = array(
			'name' => $this->name,
			'hp' => $this->hp,
		);

		$this->db->where('id_sales', $this->id_sales);
		return $this->db->update($this->table, $data);
	}

	public function delete(){
		return $this->db->delete($this->table, array('id_sales' => $this->id_sales));
	}
}
