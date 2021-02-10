<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_Kuesioner extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();		
	}
	function get_all_kuesioner()
	{
		$this->db->select("a.*, b.kat_kuesioner");
		$this->db->from("tmp_kuesioner_h a, opt_kategori_kue b");
		$this->db->where("a.kat_kue=b.id");
		$this->db->order_by('a.id', 'desc');
		return $this->db->get()->result_array();
	}
	
	function get_ques()
	{
		$this->db->select("*");
		$this->db->from("tmp_kuesioner_h");
		$this->db->where("status", 1);
		$this->db->limit(1);
		return $this->db->get()->result_array();
	}
	function get_profil_ques($key)
	{
		$this->db->where("id", $key);
		$exec = $this->db->get("tmp_kuesioner_h")->result();
		$row = $exec[0];
		return $row;
	}
	function get_detail_kue($key)
	{
		$this->db->where("idh", $key);
		return $this->db->get("tmp_kuesioner_d")->result_array();
	}
	function get_pilihan_kue($key)
	{
		$this->db->where("id", $key);
		$exec = $this->db->get("tmp_kuesioner_d")->result();
		$row = $exec[0];
		return $row;
	}
	function insert_kuesioner_h($data)
	{
		$this->db->insert("kuesioner_h", $data);
		$last_id = $this->db->insert_id();
		return $last_id;
	}
	function update_kuesioner_h($key1, $key2, $data)
	{
		$this->db->where("id_user", $key1);
		$this->db->where("id_kue", $key2);
		$this->db->update("kuesioner_h", $data);
	}
	function insert_kuesioner_d($data)
	{
		$this->db->insert("kuesioner_d", $data);
	}
	function update_kuesioner_d($key, $data)
	{
		$this->db->where("id_d_kue", $key);
		$this->db->update("kuesioner_d", $data);
	}
	function get_pilihan_user($id_kuesioner, $id_pertanyaan, $id_user)
	{
		$this->db->select("*");
		$this->db->from("kuesioner_h a");
		$this->db->from("kuesioner_d b");
		$this->db->where("a.id_kue_head=b.id_kue_detail");
		$this->db->where("a.id_user", $id_user);
		$this->db->where("a.id_kue", $id_kuesioner);
		$this->db->where("b.id_pertanyaan", $id_pertanyaan);
		return $this->db->get()->num_rows();
	}
	function get_jawaban_user($id_pertanyaan, $id_kuesioner, $id_user)
	{
		$this->db->from("kuesioner_h a");
		$this->db->from("kuesioner_d b");
		$this->db->where("a.id_kue_head=b.id_kue_detail");
		$this->db->where("a.id_user", $id_user);
		$this->db->where("a.id_kue", $id_kuesioner);
		$this->db->where("b.id_pertanyaan", $id_pertanyaan);
		$jml_data = $this->db->get()->num_rows();
		if($jml_data==0)
		{
			$hsl="0";
		}	
		else
		{
			$this->db->from("kuesioner_h a");
			$this->db->from("kuesioner_d b");
			$this->db->where("a.id_kue_head=b.id_kue_detail");
			$this->db->where("a.id_user", $id_user);
			$this->db->where("a.id_kue", $id_kuesioner);
			$this->db->where("b.id_pertanyaan", $id_pertanyaan);
			$exec = $this->db->get()->result();
			$row = $exec[0];
			$hsl = $row->pilihan;
		}
		return $hsl;
	}
	function cek_head_kue($id_kues, $id_user)
	{
		$this->db->where("id_kue", $id_kues);
		$this->db->where("id_user", $id_user);
		return $this->db->get("kuesioner_h")->result_array();
	}
	function get_profil_pilihan_head($id_kues, $id_user)
	{
		$this->db->where("id_kue", $id_kues);
		$this->db->where("id_user", $id_user);
		$exec = $this->db->get("kuesioner_h")->result();
		$row = $exec[0];
		return $row;
	}
	function cek_detail_kue($id_kue_detail, $id_kues, $id_pertanyaan)
	{
		$this->db->where("id_kue_detail", $id_kue_detail);
		$this->db->where("id_kue", $id_kues);
		$this->db->where("id_pertanyaan", $id_pertanyaan);
		return $this->db->get("kuesioner_d")->result_array();
	}
	function get_profil_pilihan_detail($id_kue_detail, $id_kues, $id_pertanyaan)
	{
		$this->db->where("id_kue_detail", $id_kue_detail);
		$this->db->where("id_kue", $id_kues);
		$this->db->where("id_pertanyaan", $id_pertanyaan);
		$exec = $this->db->get("kuesioner_d")->result();
		$row = $exec[0];
		return $row;
	}
	//cek hasil kues user
	function get_hasil_kues_user($id_user, $id_kuesioner)
	{
		$this->db->where("id_kue", $id_kuesioner);
		$this->db->where("id_user", $id_user);
		$this->db->where("status", 1); //jika user telah melakukan survey
		return $this->db->get("kuesioner_h")->result_array();
	}
	function get_count_jawaban_kues($id_kues, $id_pertanyaan, $jawaban)
	{
		$this->db->where("id_kue", $id_kues);
		$this->db->where("id_pertanyaan", $id_pertanyaan);
		$this->db->where("pilihan", $jawaban);
		return count($this->db->get("kuesioner_d")->result_array());
	}
	//ceh jumlah responden
	function get_jumlah_responden($id_kuesioner)
	{
		$this->db->where("id_kue", $id_kuesioner);
		return $this->db->get("kuesioner_h")->result_array();
	}
	//admin kues
	function get_count_jawaban_kues_admin($id_kues, $id_pertanyaan, $jawaban, $kat_user)
	{
		$this->db->select("a.jenis_user, b.*");
		$this->db->from("kuesioner_h a");
		$this->db->from("kuesioner_d b");
		$this->db->where("a.id_kue_head = b.id_kue_detail");
		$this->db->where("a.jenis_user", $kat_user);
		$this->db->where("a.id_kue", $id_kues);
		$this->db->where("b.id_pertanyaan", $id_pertanyaan);
		$this->db->where("b.pilihan", $jawaban);
		return count($this->db->get("")->result_array());
	}
	function get_jumlah_responden_visi_misi($id_kuesioner, $id_pertanyaan)
	{
		$arr_kat = array('1', '3');
		$this->db->where("id_kue", $id_kuesioner);
		$this->db->where("id_pertanyaan", $id_pertanyaan);
		$this->db->where_in("kategori_responden", $arr_kat);
		return $this->db->get("kuesioner_vmt")->result_array();
		//$row = $exec[0];
		//return $row;
	}
	function get_jumlah_responden_visi_misi_graph($id_kuesioner, $id_pertanyaan, $id_jenis)
	{
		//$arr_kat = array('1', '3');
		$this->db->where("id_kue", $id_kuesioner);
		$this->db->where("id_pertanyaan", $id_pertanyaan);
		$this->db->where("kategori_responden", $id_jenis);
		$exec = $this->db->get("kuesioner_vmt")->result();
		$row = $exec[0];
		return $row;
	}
	function get_jumlah_responden_visi_misi_2($id_kuesioner, $id_pertanyaan, $jenis_res)
	{
		$this->db->where("id_kue", $id_kuesioner);
		$this->db->where("id_pertanyaan", $id_pertanyaan);
		$this->db->where("kategori_responden", $jenis_res);
		return $this->db->get("kuesioner_vmt")->result_array();
	}
	//hasil
	public function get_responden($id_head, $id_pertanyaan)
	{
		$this->db->select("a.*, b.id_kue");
		$this->db->from("kuesioner_d a");
		$this->db->from("kuesioner_h b");
		$this->db->where("a.id_kue_head=b.id_kue_head");
		$this->db->where("b.id_kue", $id_head);
		$this->db->where("a.id_pertanyaan", $id_pertanyaan);
		return $this->db->get()->result_array();
	}
	public function get_responden_pilihan($id_head, $id_pertanyaan, $pilihan)
	{
		$this->db->select("a.*, b.id_kue");
		$this->db->from("kuesioner_d a");
		$this->db->from("kuesioner_h b");
		$this->db->where("a.id_kue_head=b.id_kue_head");
		$this->db->where("b.id_kue", $id_head);
		$this->db->where("a.id_pertanyaan", $id_pertanyaan);
		$this->db->where("a.pilihan", $pilihan);
		return $this->db->get()->result_array();
	}
}