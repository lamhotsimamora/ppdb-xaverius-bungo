<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pembelian extends CI_Model
{

	// Definisi field/colomn tabel
	public $id_pembelian;
	public $id_customer;
	public $id_rumah;
	public $tgl_bayar_DP;
	public $DP;
	//

	// Definisi nama tabel
	protected $table      = 't_pembelian';
	protected $view      = 'view_pembelian';
	protected $primaryKey = 'id_pembelian';
	protected $useAutoIncrement = true;

	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';

	public function loadData()
	{
		$this->db->select('*')
			->from($this->view);
		$obj = $this->db->get();
		$data  = $obj->result();
		return $data;
	}

	public function search()
	{
		$this->db->select('*')
			->from($this->table)
			->where(['tgl_bayar_DP' => $this->tgl_bayar_DP]);

		$obj = $this->db->get();
		$data  = $obj->result();

		return (count($data) > 0) ? true : false;
	}


	public function add()
	{
		$data = array(
			'id_customer' => $this->id_customer,
			'id_rumah' => $this->id_rumah,
			'tgl_bayar_DP' => $this->tgl_bayar_DP,
			'DP' => $this->DP,
		);
		return $this->db->insert($this->table, $data);
	}

	public function update()
	{
		$data = array(
			'id_customer' => $this->id_customer,
			'id_rumah' => $this->id_rumah,
			'tgl_bayar_DP' => $this->tgl_bayar_DP,
			'DP' => $this->DP,
		);
		$this->db->where('id_pembelian', $this->id_pembelian);
		return $this->db->update($this->table, $data);
	}

	public function delete(){
		return $this->db->delete($this->table, array('id_pembelian' => $this->id_pembelian));
	}
}
