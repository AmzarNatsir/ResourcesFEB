<?php 
defined("BASEPATH") OR exit ("No direct script access allowed");
/**
 * 
 */
class Model_opsi_keterampilan_umum extends CI_Model
{
	
	private $_table = "opsi_rps_aspek_ku";
	private $_id = "id_ku";
	
	function get_no_urut()
	{
		$result = $this->db->get($this->_table)->num_rows();
		if($result>0)
		{
			$this->db->select("no_urut");
			$this->db->from($this->_table);
			$this->db->order_by("no_urut", "desc");
			$this->db->limit(1);
			$exec = $this->db->get()->result();
			$row = $exec[0];
			$hasil = $row->no_urut+1;
		} else {
			$hasil = 1;
		}
		return $hasil;
	}
	function get_all()
	{
		$this->db->order_by("no_urut", "asc");
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