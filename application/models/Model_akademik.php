<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_akademik extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();		
	}
    //matakuliah
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
}