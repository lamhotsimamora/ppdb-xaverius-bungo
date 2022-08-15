<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_customer extends CI_Model
{

	// Definisi field/colomn tabel
	public $id_customer;
	public $nama;
	public $umur;
	public $alamat;
	public $ktp;
	public $hp;
	//

	// Definisi nama tabel
	protected $table      = 't_customer';
	protected $primaryKey = 'id_customer';
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
			'nama' => $this->nama,
			'umur' => $this->umur,
			'alamat' => $this->alamat,
			'ktp' => $this->ktp,
			'hp' => $this->hp,
		);
		return $this->db->insert($this->table, $data);
	}

	public function update()
	{

		$data = array(
			'nama' => $this->nama,
			'umur' => $this->umur,
			'alamat' => $this->alamat,
			'ktp' => $this->ktp,
			'hp' => $this->hp,
		);
		$this->db->where('id_customer', $this->id_customer);
		return $this->db->update($this->table, $data);
	}

	public function delete(){
		return $this->db->delete($this->table, array('id_customer' => $this->id_customer));
	}
}
