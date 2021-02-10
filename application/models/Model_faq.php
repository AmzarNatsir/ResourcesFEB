<?php 
defined("BASEPATH") OR exit ("No direct script access allowed");
/**
 * 
 */
class Model_faq extends CI_Model
{
	
	private $_table = "faq_main";
	private $ID = "id_faq";
	private $_table_opsi = "faq_kategori";
	private $ID_opsi = "id_kat_faq";
	function insert_data($data)
	{
		$this->db->insert($this->_table, $data);
	}
	function update_data($key, $data)
	{
		$this->db->where($this->ID, $key);
		$this->db->update($this->_table, $data);
	}
	function delete_data($key)
	{
		$this->db->where($this->ID, $key);
		$this->db->delete($this->_table);
	}
	function get_all_data()
	{
		$this->db->select("a.id_faq, a.pertanyaan, a.jawaban, b.nm_kat_faq");
		$this->db->from($this->_table." a");
		$this->db->from($this->_table_opsi." b");
		$this->db->where("a.".$this->ID_opsi."=b.".$this->ID_opsi);
		return $this->db->get()->result_array();
	}
	function get_profil($key)
	{
		return $this->db->get_where($this->_table, [$this->ID=>$key])->row();
	}
}