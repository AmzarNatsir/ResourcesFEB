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
	public function get_jadwal()
	{
		$this->db->select("f.kode_matakuliah, f.nama_matakuliah, a.tanggal_mulai, a.jam_mulai, a.jam_akhir, b.nama_ps, c.nama_tahun, d.nama_kelas, e.nama_dosen, g.hari, h.nama_bangunan, i.jenis_ruang")
			->from("5_kelas_kuliah a")
			->from("1_2_identitas_ps b")
			->from("umum_thn_akademik c")
			->from("5_kelas_tahun_akademik d")
			->from("4_1_biodata_dosen e")
			->from("5_akademik_matakuliah f")
			->from("jenis_5_hari g")
			->from("6_sarana_bangunan h")
			->from("jenis_6_ruang i")
			->where("a.prodi=b.id_ps")
			->where("a.semester=c.id_thn_akademik")
			->where("a.nama_kelas=d.id_kelas_ta")
			->where("a.dosen=e.id_dosen")
			->where("a.mata_kuliah=f.id_matakuliah")
			->where("a.hari=g.id_hari")
			->where("a.gedung=h.id_gedung")
			->where("a.ruang=i.id_jenis");
		return $this->db->get()->result_array();
	}
}