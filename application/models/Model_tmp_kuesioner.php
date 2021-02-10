<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_tmp_kuesioner extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();		
	}
	//kategori kuesioner
	function get_all_kat_kue()
	{
		return $this->db->get("opt_kategori_kue")->result_array();
	}
	function insert_kuesioner_h($data)
	{
		$this->db->insert("tmp_kuesioner_h", $data);
		$last_id = $this->db->insert_id();
		return $last_id;
	}
	function update_kuesioner_h($key, $data)
	{
		$this->db->where("id", $key);
		$this->db->update("tmp_kuesioner_h", $data);
	}
	function insert_kuesioner_d($data)
	{
		$this->db->insert("tmp_kuesioner_d", $data);
	}
	function update_kuesioner_d($key, $data)
	{
		$this->db->where("id", $key);
		$this->db->update("tmp_kuesioner_d", $data);
	}
	function delete_kuesioner_h($key)
	{
		$this->db->where("id", $key);
		$this->db->delete("tmp_kuesioner_h");
	}
	function delete_kuesioner_subtema($key)
	{
		$this->db->where("idh", $key);
		$this->db->delete("tmp_kuesioner_subtema");
	}
	function delete_kuesioner_d($key)
	{
		$this->db->where("idh", $key);
		$this->db->delete("tmp_kuesioner_d");
	}
	function delete_kuesioner_d_per_row($key)
	{
		$this->db->where("id", $key);
		$this->db->delete("tmp_kuesioner_d");
	}
	//subtema
	public function insert_kuesioner_subtema($data)
	{
		$this->db->insert("tmp_kuesioner_subtema", $data);
	}
	function get_data_kuesioner_sub_tema($key)
	{
		$this->db->where("idh", $key);
		return $this->db->get("tmp_kuesioner_subtema")->result_array();
	}
	function get_data_pertanyaan_subtema($id_head, $id_subtema)
	{
		$this->db->where("idh", $id_head);
		$this->db->where("id_subtema", $id_subtema);
		return $this->db->get("tmp_kuesioner_d")->result_array();
	}
	function get_data_pertanyaan_subtema_row($id_head)
	{
		$this->db->select("a.*, b.tema_kue, b.jenis_kuesioner, b.jumlah_pilihan, b.status, b.sub_tema as pil_subtema, b.kat_kue");
		$this->db->from("tmp_kuesioner_subtema a");
		$this->db->from("tmp_kuesioner_h b");
		$this->db->where("a.idh=b.id");
		$this->db->where("a.id", $id_head);
		return $this->db->get()->row();
	}
	//end sub tema
	function get_all_kuesioner()
	{
		$this->db->order_by("id", "desc");
		return $this->db->get("tmp_kuesioner_h")->result_array();
	}
	function get_data_kuesioner_h($key)
	{
		$this->db->where("id", $key);
		$sql_str = $this->db->get("tmp_kuesioner_h");
		$exec = $sql_str->result();
		$row = $exec[0];
		return $row;
	}
	function get_data_kuesioner_d($key)
	{
		$this->db->where("idh", $key);
		return $this->db->get("tmp_kuesioner_d")->result_array();
	}
	function get_data_kuesioner_d_subtema($key, $id_subtema)
	{
		$this->db->where("idh", $key);
		$this->db->where("id_subtema", $id_subtema);
		return $this->db->get("tmp_kuesioner_d")->result_array();
	}
	function get_data_kuesioner_d_row($key)
	{
		$this->db->select("a.*, b.tema_kue, b.jenis_kuesioner, b.status");
		$this->db->from("tmp_kuesioner_d a");
		$this->db->from("tmp_kuesioner_h b");
		$this->db->where("a.idh=b.id");
		$this->db->where("a.id", $key);
		return $this->db->get()->row();

	}
}