<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_dosen extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();		
	}
	function get_dsn_all()
	{
		$this->db->select("a.*, b.jenjang, c.nama_jabatan, d.status_dosen, e.img_profil, e.file_cv, f.nama_jabfung");
		$this->db->from("4_1_biodata_dosen a");
		$this->db->join("jenis_1_jenjang b", "a.pend_terakhir=b.id", "left");
		$this->db->join("jenis_2_jabatan c", "a.jabatan_akademik=c.id_jabatan", "left");
		$this->db->join("jenis_4_stat_dos d", "a.status_dosen=d.id_stat", "left");
		$this->db->join("reg_dosen e", "a.id_dosen=e.id_dosen", "left");
		$this->db->join("jenis_4_jabfung f", "a.jabatan_fungsional=f.id_jabfung", "left");
		$this->db->order_by("a.id_dosen", "asc");
		return $this->db->get()->result_array();
	}
	function get_profil_dosen($key)
	{
		$this->db->select("a.*, b.jenjang, c.nama_jabatan, d.status_dosen, e.img_profil, e.file_cv, f.nama_jabfung");
		$this->db->from("4_1_biodata_dosen a");
		$this->db->join("jenis_1_jenjang b", "a.pend_terakhir=b.id", "left");
		$this->db->join("jenis_2_jabatan c", "a.jabatan_akademik=c.id_jabatan", "left");
		//$this->db->join("jenis_2_status d", "a.status_dosen=d.id_status_j", "left");
		$this->db->join("jenis_4_stat_dos d", "a.status_dosen=d.id_stat", "left");
		$this->db->join("reg_dosen e", "a.id_dosen=e.id_dosen", "left");
		$this->db->join("jenis_4_jabfung f", "a.jabatan_fungsional=f.id_jabfung", "left");
		$this->db->where("a.id_dosen", $key);
		return $this->db->get()->row();
	}
	public function update_data($key, $data)
	{
		$this->db->where("id_dosen", $key);
		$this->db->update("4_1_biodata_dosen", $data);
	}
}