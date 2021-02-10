<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_formulir_kkp extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();		
	}
	public function get_all_permohonan_today()
	{
		$this->db->select("a.*, b.nim, b.nama_mahasiswa, c.nama_ps, d.nama_tahun")
				->from("formulir_kkp a")
				->from("3_1_biodata_mahasiswa b")
				->from("1_2_identitas_ps c")
				->from("umum_thn_akademik d")
				->where("a.id_mahasiswa=b.id_mahasiswa")
				->where("b.prodi_mhs=c.id_ps")
				->where("b.thn_akademik=d.id_thn_akademik")
				->where("a.tgl_post", date('Y-m-d'));
		return $this->db->get()->result_array();
	}
	public function get_filter_permohonan($id_ta, $id_ps)
	{
		if($id_ta==0 && $id_ps<>0)
		{
			$this->db->select("a.*, b.nim, b.nama_mahasiswa, c.nama_ps, d.nama_tahun")
			->from("formulir_kkp a")
			->from("3_1_biodata_mahasiswa b")
			->from("1_2_identitas_ps c")
			->from("umum_thn_akademik d")
			->where("a.id_mahasiswa=b.id_mahasiswa")
			->where("b.prodi_mhs=c.id_ps")
			->where("b.thn_akademik=d.id_thn_akademik")
			->where("b.prodi_mhs", $id_ps);
		} else if($id_ta<>0 && $id_ps==0) {
			$this->db->select("a.*, b.nim, b.nama_mahasiswa, c.nama_ps, d.nama_tahun")
			->from("formulir_kkp a")
			->from("3_1_biodata_mahasiswa b")
			->from("1_2_identitas_ps c")
			->from("umum_thn_akademik d")
			->where("a.id_mahasiswa=b.id_mahasiswa")
			->where("b.prodi_mhs=c.id_ps")
			->where("b.thn_akademik=d.id_thn_akademik")
			->where("b.thn_akademik", $id_ta);
		} else {
			$this->db->select("a.*, b.nim, b.nama_mahasiswa, c.nama_ps, d.nama_tahun")
			->from("formulir_kkp a")
			->from("3_1_biodata_mahasiswa b")
			->from("1_2_identitas_ps c")
			->from("umum_thn_akademik d")
			->where("a.id_mahasiswa=b.id_mahasiswa")
			->where("b.prodi_mhs=c.id_ps")
			->where("b.thn_akademik=d.id_thn_akademik")
			->where("b.thn_akademik", $id_ta)
			->where("b.prodi_mhs", $id_ps);
		}
		return $this->db->get()->result_array();
	}
	public function get_all_permohonan()
	{
		$this->db->select("a.*, b.nim, b.nama_mahasiswa, c.nama_ps, d.nama_tahun")
				->from("formulir_kkp a")
				->from("3_1_biodata_mahasiswa b")
				->from("1_2_identitas_ps c")
				->from("umum_thn_akademik d")
				->where("a.id_mahasiswa=b.id_mahasiswa")
				->where("b.prodi_mhs=c.id_ps")
				->where("b.thn_akademik=d.id_thn_akademik");
		return $this->db->get()->result_array();
	}
	public function get_profil_permohonan($id_permohonan)
	{
		$this->db->select("a.*, b.nim, b.nama_mahasiswa, b.tempat_lahir, b.tgl_lahir, b.daerah_asal, b.alamat, b.no_tlp, c.nama_ps, d.nama_tahun")
		->from("formulir_kkp a")
		->from("3_1_biodata_mahasiswa b")
		->from("1_2_identitas_ps c")
		->from("umum_thn_akademik d")
		->where("a.id_mahasiswa=b.id_mahasiswa")
		->where("b.prodi_mhs=c.id_ps")
		->where("b.thn_akademik=d.id_thn_akademik")
		->where("a.id", $id_permohonan);
		return $this->db->get()->row();
	}
}