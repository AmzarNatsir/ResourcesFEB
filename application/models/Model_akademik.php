<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_akademik extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();		
	}
    //matakuliah
    public function insert_matakuliah($data)
    {
        $this->db->insert("5_akademik_matakuliah", $data);
    }
    public function get_matakuliah_per_prodi($id_prodi)
    {
        return $this->db->select("a.*, b.jenis_matakuliah")
            ->from("5_akademik_matakuliah a")
            ->from("jenis_5_matakuliah b")
            ->where("a.jenis_mk=b.id_jenis_mk")
            ->where("a.program_studi", $id_prodi)
            ->where("a.aktif", 1)
            ->order_by("a.semester")
            ->order_by("a.kode_matakuliah")
            ->get()->result_array();
    }
    public function get_kode_matakuliah($kode)
    {
        $result = $this->db->where("kode_matakuliah", $kode)->get("5_akademik_matakuliah")->row();
        if(empty($result->id_matakuliah)){
            $hasil = "false";
        } else {
            $hasil = "true";
        }
        return $hasil;
    }
    //mahasiswa
    public function get_mahasiswa_filter($id_ta, $id_prodi)
    {
        return $this->db->where("thn_akademik", $id_ta)->where("prodi_mhs", $id_prodi)->where("status", 1)->get("3_1_biodata_mahasiswa")->result_array();
    }
    //dosen
    
}