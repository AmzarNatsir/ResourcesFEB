<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_opsi extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();		
	}
	//Master
	function get_master_prodi()
	{
		$sql_str = $this->db->query("select a.*, b.jenjang as nm_jenjang from 1_2_identitas_ps a, jenis_1_jenjang b where a.jenjang=b.id order by id_ps");
		return $sql_str->result_array();
	}
	function get_master_agama()
	{
		$sql_str = $this->db->query("Select * from umum_agama order by id");
		return $sql_str->result_array();
	}
	function get_master_jenjang_pendidikan()
	{
		$sql_str = $this->db->query("Select * from jenis_1_jenjang order by id");
		return $sql_str->result_array();
	}
	function get_master_status_dosen()
	{
		$sql_str = $this->db->query("Select * from jenis_2_status order by id_status_j");
		return $sql_str->result_array();
	}
	function get_master_jab_funsional()
	{
		$sql_str = $this->db->query("Select * from jenis_4_jabfung order by id_jabfung");
		return $sql_str->result_array();
	}
	function get_master_jab_akademik()
	{
		$sql_str = $this->db->query("Select * from jenis_2_jabatan order by id_jabatan");
		return $sql_str->result_array();
	}
	function get_master_jenis_kelamin()
	{
		$sql_str = $this->db->query("Select * from umum_jenis_kelamin order by id");
		return $sql_str->result_array();
	}
	function get_master_sertifikasi()
	{
		$sql_str = $this->db->query("Select * from jenis_4_sertifikasi order by id");
		return $sql_str->result_array();
	}
	function get_master_thn_akademik()
	{
		$sql_str = $this->db->query("Select * from umum_thn_akademik where aktif_non=1 order by id_thn_akademik desc");
		return $sql_str->result_array();
	}
	function get_master_mandiri_tim()
	{
		return $this->db->get("jenis_4_mandiri_tim")->result_array();
	}
	function get_master_wujud_hasil()
	{
		return $this->db->get("jenis_4_wujud_hasil")->result_array();
	}
	function get_master_sumber_dana()
	{
		return $this->db->get("umum_sumber_dana")->result_array();
	}
	function get_master_level_jurnal()
	{
		return $this->db->get("jenis_4_level_jurnal")->result_array();
	}
	function get_master_bentuk_publikasi()
	{
		return $this->db->get("jenis_4_jenis_publikasi")->result_array();
	}
	function get_master_tingkat_publikasi()
	{
		return $this->db->get("jenis_4_level_jurnal")->result_array();
	}
	function get_master_lembaga_index()
	{
		return $this->db->get("jenis_4_lembaga_sitasi")->result_array();
	}
	function get_master_level_nas_intl()
	{
		return $this->db->get("umum_level_nas_intl")->result_array();
	}
	function get_master_status_kehadiran()
	{
		return $this->db->get("jenis_4_stat_hadirsemlok")->result_array();
	}
	function get_master_jenis_kegiatan()
	{
		return $this->db->get("jenis_4_jenis_semlok")->result_array();
	}
	function get_master_jenis_sertifikasi()
	{
		return $this->db->get("jenis_4_sertifikasi")->result_array();
	}
	function get_master_lvl_sertifikasi($key)
	{
		$this->db->where("jenis_sertifikasi", $key);
		return $this->db->get("jenis_4_level_sert")->result_array();
	}
	function get_master_lvl_pakar()
	{
		return $this->db->get("jenis_4_level")->result_array();
	}
	function get_master_dalam_luar_negeri()
	{
		return $this->db->get("jenis_4_dlm_negeri")->result_array();
	}
	function get_master_status_mahasiswa()
	{
		return $this->db->get("jenis_3_status_mhs")->result_array();
	}
	function get_master_ps_non_ps()
	{
		$arr_ps_non_ps = array("1"=>"Terkait Prodi", "2"=>"Tidak Terkait Prodi");
		return $arr_ps_non_ps;
	}
	function get_master_jenis_pengabdian()
	{
		return $this->db->get("jenis_4_pengabdian")->result_array();
	}
	function get_master_fasilitas_penunjang()
	{
		return $this->db->get("jenis_4_penunjang_abdi")->result_array();
	}
	function get_master_jenjang_dosen()
	{
		return $this->db->get("jenis_4_pend_dos")->result_array();
	}
	function get_all_dosen()
	{
		return $this->db->get("4_1_biodata_dosen")->result_array();
	}
	function get_all_kategori_id()
	{
		return $this->db->get("opsi_kategori_id")->result_array();
	}
	//matakuliah
	function get_all_matakuliah()
	{
		return $this->db->get("5_akademik_matakuliah")->result_array();
	}
	function get_jenis_matakuliah()
	{
		return $this->db->get("jenis_5_matakuliah")->result_array();
	}
	function get_semester()
	{
		return $this->db->get("jenis_5_semester")->result_array();
	}
}