<?php 
defined("BASEPATH") OR exit ("No direct script access allowed");
/**
 * 
 */
class Model_jadwal extends CI_Model
{
	public function __construct()
	{
		$this->load->database();		
	}
	//
	public function get_ta()
	{
		return $this->db->where("aktif_non", 1)->order_by('id_thn_akademik', 'desc')->get("umum_thn_akademik")->result_array();
	}
	public function get_prodi()
	{
		return $this->db->get("1_2_identitas_ps")->result_array();
	}
	public function get_matkul_per_prodi($id_prodi)
	{
		return $this->db->where("aktif", 1)->where("program_studi", $id_prodi)->order_by("kode_matakuliah", "asc")->get("5_akademik_matakuliah")->result_array();
	}
	public function get_profil_matkul($id_matkul)
	{
		return $this->db->where("id_matakuliah", $id_matkul)->get("5_akademik_matakuliah")->row();
	}
	public function get_jadwal()
	{
		$this->db->select("f.kode_matakuliah, f.nama_matakuliah, a.tanggal_mulai, a.jam_mulai, a.jam_akhir, b.nama_ps, c.nama_tahun, d.nama_kelas, e.nama_dosen, g.hari, h.nama_ruang")
			->from("5_kelas_kuliah a")
			->from("1_2_identitas_ps b")
			->from("umum_thn_akademik c")
			->from("5_kelas_tahun_akademik d")
			->from("4_1_biodata_dosen e")
			->from("5_akademik_matakuliah f")
			->from("jenis_5_hari g")
			->from("6_sarana_ruang h")
			->where("a.prodi=b.id_ps")
			->where("a.semester=c.id_thn_akademik")
			->where("a.nama_kelas=d.id_kelas_ta")
			->where("a.dosen=e.id_dosen")
			->where("a.mata_kuliah=f.id_matakuliah")
			->where("a.hari=g.id_hari")
			->where("a.ruang=h.id_ruang_kelas");
		return $this->db->get()->result_array();
	}
}