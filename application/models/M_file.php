<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_file extends CI_Model
{

	// Definisi field/colomn tabel
	public $id_file;
	public $id_peserta;
	public $kartu_keluarga;
	//

	// Definisi nama tabel
	protected $table      = 'file_berkas';
	protected $primaryKey = 'id_file';
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

	public function loadData_byId(){
		$this->db->select('*')
			->from($this->table)
			->where(['id_file' => $this->id_file]);

		$obj = $this->db->get();
		$data  = $obj->result();
		return count($data)>0 ? $data[0]:null;
	}

	public function checkData(){
		$this->db->select('id_file')
			->from($this->table)
			->where(['id_peserta' => $this->id_peserta]);

		$obj = $this->db->get();
		$data  = $obj->result();
		return count($data)>0 ? true : false;
	}

	public function addData()
	{
		$data = array(
			'kartu_keluarga' => $this->kartu_keluarga,
			'id_peserta' => $this->id_peserta
		);
		$result= $this->db->insert($this->table, $data);
		return $result ? true : false;
	}

	public function updateData()
	{
		$data = array(
			'kartu_keluarga' => $this->kartu_keluarga,
		);
		$this->db->where('id_peserta', $this->id_peserta);
		return $this->db->update($this->table, $data);
	}

	public function delete_data(){
		return $this->db->delete($this->table, array('id_file' => $this->id_file));
	}
}
