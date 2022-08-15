<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_developer extends CI_Model
{

	// Definisi field/colomn tabel
	public $id_developer;
	public $developer;
	//

	// Definisi nama tabel
	protected $table      = 't_developer';
	protected $primaryKey = 'id_developer';
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
			->where(['developer' => $this->developer]);

		$obj = $this->db->get();
		$data  = $obj->result();

		return (count($data) > 0) ? true : false;
	}


	public function add()
	{
		$data = array(
			'developer' => $this->developer
		);
		return $this->db->insert($this->table, $data);
	}

	public function update()
	{

		$data = array(
			'developer' => $this->developer
		);
		$this->db->where('id_developer', $this->id_developer);
		return $this->db->update($this->table, $data);
	}

	public function delete(){
		return $this->db->delete($this->table, array('id_developer' => $this->id_developer));
	}
}
