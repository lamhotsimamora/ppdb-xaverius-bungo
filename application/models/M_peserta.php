<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_peserta extends CI_Model
{

	// Definisi field/colomn tabel
	public $id_peserta;
	public $nama_lengkap;
	public $alamat;
	public $kartu_keluarga;
	//

	// Definisi nama tabel
	protected $table      = 'peserta';
	protected $primaryKey = 'id_peserta';
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
			->where(['nama_lengkap' => $this->nama_lengkap]);

		$obj = $this->db->get();
		$data  = $obj->result();

		return (count($data) > 0) ? true : false;
	}


	public function add()
	{
		$data = array(
			'nama_lengkap' => $this->nama_lengkap,
			'alamat' => $this->alamat,
			'kartu_keluarga' => $this->kartu_keluarga
		);
		return $this->db->insert($this->table, $data);
	}

	public function update()
	{
		$data = array(
			'nama_lengkap' => $this->nama_lengkap,
			'alamat' => $this->alamat,
			'kartu_keluarga' => $this->kartu_keluarga
		);
		$this->db->where('id_peserta', $this->id_peserta);
		return $this->db->update($this->table, $data);
	}

	public function delete(){
		return $this->db->delete($this->table, array('id_peserta' => $this->id_peserta));
	}
}
