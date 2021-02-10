<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_user extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();		
	}
	public function update_akun_mhs($id, $data)
	{
		$this->db->where("id", $id);
		$this->db->update("reg_mahasiswa", $data);
	}
	function get_profil_akun_mhs($id)
	{
		$this->db->select("a.*, b.nama_mahasiswa");
		$this->db->from("reg_mahasiswa a");
		$this->db->from("3_1_biodata_mahasiswa b");
		$this->db->where("a.id_mahasiswa=b.id_mahasiswa");
		$this->db->where("a.id", $id);
		return $this->db->get()->row();
	}
	function get_all_mahasiswa()
	{
		$this->db->select("a.*, b.nama_mahasiswa");
		$this->db->from("reg_mahasiswa a");
		$this->db->from("3_1_biodata_mahasiswa b");
		$this->db->where("a.id_mahasiswa=b.id_mahasiswa");
		$this->db->where("a.status", 1);
		return $this->db->get()->result_array();
	}
	function get_all_mahasiswa_aktif()
	{
		$this->db->select("a.*, b.nama_mahasiswa");
		$this->db->from("reg_mahasiswa a");
		$this->db->from("3_1_biodata_mahasiswa b");
		$this->db->where("a.id_mahasiswa=b.id_mahasiswa");
		$this->db->where("a.status", 1);
		return $this->db->get()->result_array();
	}
	function get_all_mahasiswa_belum_aktif()
	{
		$this->db->select("a.*, b.nama_mahasiswa");
		$this->db->from("reg_mahasiswa a");
		$this->db->from("3_1_biodata_mahasiswa b");
		$this->db->where("a.id_mahasiswa=b.id_mahasiswa");
		$this->db->where("a.status", 0);
		return $this->db->get()->result_array();
	}
	function get_akun_search($search)
	{
		$query = $this
                ->db
                ->select("a.*, b.nama_mahasiswa")
                ->from("reg_mahasiswa a")
                ->from("3_1_biodata_mahasiswa b")
                ->where("a.id_mahasiswa=b.id_mahasiswa")
                ->like('a.nim',$search)
                //->or_like('b.nama_mahasiswa',$search)
                ->limit(50)
                ->get();
     
        if($query->num_rows()>0)
        {
            return $query->result_array(); 
        }
        else
        {
            return null;
        }
	}
	//User Dosen
	function insert_akun_dosen($data)
	{
		$this->db->insert("reg_dosen", $data);
	}
	public function update_akun_dosen($id, $data)
	{
		$this->db->where("id", $id);
		$this->db->update("reg_dosen", $data);
	}
	function get_all_dosen_aktif()
	{
		$this->db->select("a.*, b.nama_dosen");
		$this->db->from("reg_dosen a");
		$this->db->from("4_1_biodata_dosen b");
		$this->db->where("a.id_dosen=b.id_dosen");
		$this->db->where("a.status", 1);
		return $this->db->get()->result_array();
	}
	function get_all_dosen_belum_aktif()
	{
		$this->db->select("a.*, b.nama_dosen");
		$this->db->from("reg_dosen a");
		$this->db->from("4_1_biodata_dosen b");
		$this->db->where("a.id_dosen=b.id_dosen");
		$this->db->where("a.status", 0);
		return $this->db->get()->result_array();
	}
	function get_all_dosen()
	{
		$this->db->where("status_aktif", 1);
		return $this->db->get("4_1_biodata_dosen")->result_array();
	}
	public function get_akun_dosen($nidn)
	{
		$this->db->where("nidn", $nidn);
		return $this->db->get("reg_dosen")->result_array();
	}
	public function get_profil_akun_dosen($id_akun)
	{
		$this->db->select("a.*, b.nama_dosen");
		$this->db->from("reg_dosen a");
		$this->db->from("4_1_biodata_dosen b");
		$this->db->where("a.id_dosen=b.id_dosen");
		$this->db->where("a.id", $id_akun);
		return $this->db->get()->row();
	}
	//akun pegawai
	function insert_akun_pegawai($data)
	{
		$this->db->insert("reg_pegawai", $data);
	}
	public function update_akun_pegawai($id, $data)
	{
		$this->db->where("id", $id);
		$this->db->update("reg_pegawai", $data);
	}
	function get_all_pegawai_aktif()
	{
		$this->db->select("a.*, b.nama_pegawai");
		$this->db->from("reg_pegawai a");
		$this->db->from("2_1_pegawai b");
		$this->db->where("a.id_pegawai=b.id_pegawai");
		$this->db->where("a.status", 1);
		return $this->db->get()->result_array();
	}
	function get_all_pegawai()
	{
		$this->db->where("aktif_non", 1);
		return $this->db->get("2_1_pegawai")->result_array();
	}
	public function get_akun_pegawai($id_pegawai)
	{
		$this->db->where("id_pegawai", $id_pegawai);
		return $this->db->get("reg_pegawai")->result_array();
	}
	public function get_profil_akun_pegawai($id_akun)
	{
		$this->db->select("a.*, b.nama_pegawai");
		$this->db->from("reg_pegawai a");
		$this->db->from("2_1_pegawai b");
		$this->db->where("a.id_pegawai=b.id_pegawai");
		$this->db->where("a.id", $id_akun);
		return $this->db->get()->row();
	}
}