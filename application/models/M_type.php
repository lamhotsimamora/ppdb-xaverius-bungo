<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_type extends CI_Model
{

	// Definisi field/colomn tabel
	public $id_type;
	public $type;
	//

	// Definisi nama tabel
	protected $table      = 't_type';
	protected $primaryKey = 'id_type';
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
			->where(['type' => $this->type]);

		$obj = $this->db->get();
		$data  = $obj->result();

		return (count($data) > 0) ? true : false;
	}


	public function add()
	{
		$data = array(
			'type' => $this->type
		);
		return $this->db->insert($this->table, $data);
	}

	public function update()
	{

		$data = array(
			'type' => $this->type
		);

		$this->db->where('id_type', $this->id_type);
		return $this->db->update($this->table, $data);
	}

	public function delete(){
		return $this->db->delete($this->table, array('id_type' => $this->id_type));
	}
}
