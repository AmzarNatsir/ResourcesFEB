<?php 
defined("BASEPATH") OR exit ("No direct script access allowed");
/**
 * 
 */
class Model_ka extends CI_Model
{
	function insert_head($data)
	{
		$this->db->insert("kalender_akademik_head", $data);
	}
	function update_head($id_head, $data)
	{
		$this->db->where('id', $id_head);
		$this->db->update('kalender_akademik_head', $data);
	}
	function get_profil_head($key)
	{
		return $this->db->where('id', $key)->get('kalender_akademik_head')->row();
	}
	function insert_detail($data)
	{
		$this->db->insert('kalender_akademik', $data);
	}
	function update_detail($key, $data)
	{
		$this->db->where('id', $key);
		$this->db->update('kalender_akademik', $data);
	}
	function delete_detail($key)
	{
		$this->db->where('id', $key);
		$this->db->delete('kalender_akademik');
	}
	function get_all_ta()
	{
		return $this->db->get("kalender_akademik_head")->result_array();
	}
	function get_all_ta_aktif()
	{
		return $this->db->where('status', 1)->get("kalender_akademik_head")->result_array();
	}
	function get_detail_ka($id_head)
	{
		return $this->db->where('id_head', $id_head)->get('kalender_akademik')->result_array();	
	}
	function get_profil_detail($id)
	{
		return $this->db->where('id', $id)->get('kalender_akademik')->row();
	}
}