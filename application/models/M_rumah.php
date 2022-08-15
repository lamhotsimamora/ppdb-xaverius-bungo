<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_rumah extends CI_Model
{

	// Definisi field/colomn tabel
	public $id_rumah;
	public $nama_rumah;
	public $id_type;
	public $harga_rumah;
	public $id_developer;
	public $detail;
	//

	// Definisi nama tabel
	protected $table      = 't_rumah';
	protected $view      = 'view_rumah';
	protected $primaryKey = 'id_rumah';
	protected $useAutoIncrement = true;

	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';


	public function search()
	{
		$this->db->select('*')
			->from($this->table)
			//->where(['nama_rumah' => $this->nama_rumah]);
			->like('nama_rumah', $this->nama_rumah);

		$obj = $this->db->get();
		$data  = $obj->result();
		return $data;
		//return (count($data) > 0) ? true : false;
	}

	public function loadData()
	{
		$this->db->select('*')
			->from($this->view);
		$obj = $this->db->get();
		$data  = $obj->result();
		return $data;
	}

	public function add()
	{

		$data = array(
			'nama_rumah' => $this->nama_rumah,
			'id_type' => $this->id_type,
			'harga_rumah' => $this->harga_rumah,
			'id_developer' => $this->id_developer,
			'detail' => $this->detail,
		);
		return $this->db->insert($this->table, $data);
	}

	public function update()
	{
		$data = array(
			'nama_rumah' => $this->nama_rumah,
			'id_type' => $this->id_type,
			'harga_rumah' => $this->harga_rumah,
			'id_developer' => $this->id_developer,
			'detail' => $this->detail,
		);

		$this->db->where('id_rumah', $this->id_rumah);
		return $this->db->update($this->table, $data);
	}

	public function delete(){
		return $this->db->delete($this->table, array('id_rumah' => $this->id_rumah));
	}
}
