<?php 
defined("BASEPATH") OR exit ("No direct script access allowed");
/**
 * 
 */
class Model_opsi_kat_berita extends CI_Model
{
	
	private $_table = "opsi_kategori_berita";
	private $_id = "id";
	function get_all()
	{
		return $this->db->get($this->_table)->result_array();
	}
	function get_profil($id)
	{
		return $this->db->get_where($this->_table, [$this->_id=>$id])->row();
	}
	function insert_data($data)
	{
		$this->db->insert($this->_table, $data);
	}
	function update_data($id, $data)
	{
		$this->db->where($this->_id, $id);
		$this->db->update($this->_table, $data);
	}
	function delete_data($id)
	{
		$this->db->where($this->_id, $id);
		$this->db->delete($this->_table);
	}
}