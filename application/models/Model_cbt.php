<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_cbt extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();		
	}
    //soal
    function get_soal_per_matakuliah($id_matkul)
    {
        return $this->db->where("id_matakuliah", $id_matkul)->get("cbt_bank_soal_head")->result_array();
    }
    function get_kode_soal($kode)
    {
        $result = $this->db->where("kode_soal", $kode)->get("cbt_bank_soal_head")->row();
        if(empty($result->id)){
            $hasil = "false";
        } else {
            $hasil = "true";
        }
        return $hasil;
    }
    function insert_soal_head($data)
    {
        $this->db->insert("cbt_bank_soal_head", $data);
    }
    function insert_detail($data)
    {
        $this->db->insert("cbt_bank_soal_detail", $data);
    }
    function delete_detail_soal($id)
    {
        $this->db->where("id", $id)->delete("cbt_bank_soal_detail");
    }
    function get_head_soal($id_h)
    {
        return $this->db->select("a.*, b.nama_ps, c.nama_matakuliah")
                ->from("cbt_bank_soal_head a")
                ->from("1_2_identitas_ps b")
                ->from("5_akademik_matakuliah c")
                ->where("a.id_prodi=b.id_ps")
                ->where("a.id_matakuliah=c.id_matakuliah")
                ->where("a.id", $id_h)->get()->row();
    }
    function get_detail_soal($id_h)
    {
        return $this->db->where("id_head", $id_h)->get("cbt_bank_soal_detail", $id_h)->result_array();
    }
    function get_detail_soal_row($id_d)
    {
        return $this->db->where("id", $id_d)->get("cbt_bank_soal_detail")->row();
    }
    function remove_file_soal($id, $folder, $nm_field)
    {
        $this->db->select($nm_field);
        $this->db->from("cbt_bank_soal_detail");
        $this->db->where('id', $id);
        $res = $this->db->get();
        $img = $res->row();
        if(!empty($img->$nm_field))
        {
            unlink(FCPATH.'assets/upload/cbt/'.$folder."/".$img->$nm_field);
        }
    }
}