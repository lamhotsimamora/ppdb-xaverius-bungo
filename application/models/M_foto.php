<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_foto extends CI_Model
{

	// Definisi field/colomn tabel
	public $id_foto;
	public $id_rumah;
	public $foto;
	//

	// Definisi nama tabel
	protected $table      = 'foto_rumah';
	protected $primaryKey = 'id_foto';
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
			->where(['foto' => $this->foto]);

		$obj = $this->db->get();
		$data  = $obj->result();

		return (count($data) > 0) ? true : false;
	}


	public function add()
	{
		$data = array(
			'id_rumah' => $this->id_rumah,
			'foto' => $this->foto
		);
		return $this->db->insert($this->table, $data);
	}

	public function update()
	{
		$data = array(
			'id_rumah' => $this->id_rumah,
			'foto' => $this->foto
		);
		$this->db->where('id_foto', $this->id_foto);
		return $this->db->update($this->table, $data);
	}

	public function delete(){
		return $this->db->delete($this->table, array('id_foto' => $this->id_foto));
	}
}
