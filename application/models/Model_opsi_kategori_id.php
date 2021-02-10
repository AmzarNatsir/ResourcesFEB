<?php 
defined("BASEPATH") OR exit ("No direct script access allowed");
/**
 * 
 */
class Model_opsi_kategori_id extends CI_Model
{
	
	private $_table = "opsi_kategori_id";
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
	public function remove_image($key)
	{
		$this->db->select('logo_id');
	    $this->db->from($this->_table);
	    $this->db->where($this->_id, $key);
	    $res = $this->db->get();
	    $img = $res->row();
	    if(!empty($img->logo_id)){
	    	unlink(FCPATH.'assets/upload/id_resources/'.$img->logo_id);
	    }
	}
}