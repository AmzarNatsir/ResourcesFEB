<?php 
defined("BASEPATH") OR exit ("No direct script access allowed");
/**
 * 
 */
class Model_mitra extends CI_Model
{
	
	private $_table = "inf_mitra";
	private $ID = "id";
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
		return $this->db->get($this->_table)->result_array();
	}
	function get_profil($key)
	{
		return $this->db->get_where($this->_table, [$this->ID=>$key])->row();
	}
	public function remove_image($key)
	{
		$this->db->select('img_file');
	    $this->db->from($this->_table);
	    $this->db->where($this->ID, $key);
	    $res = $this->db->get();
	    $img = $res->row();
	    if(!empty($img->img_file)){
	    	unlink(FCPATH.'assets/upload/mitra/'.$img->img_file);
	    }
	}
}