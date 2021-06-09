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
        return $this->db->insert_id();
    }
    function insert_detail($data)
    {
        $this->db->insert("cbt_bank_soal_detail", $data);
    }
    function update_detail($id, $data)
    {
        $this->db->where("id", $id)->update("cbt_bank_soal_detail", $data);
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
        return $this->db->where("id_head", $id_h)->get("cbt_bank_soal_detail")->result_array();
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
    //bank soal
    function get_all_head_soal()
    {
        return $this->db->select("a.*, b.nama_ps, c.nama_matakuliah")
                ->from("cbt_bank_soal_head a")
                ->from("1_2_identitas_ps b")
                ->from("5_akademik_matakuliah c")
                ->where("a.id_prodi=b.id_ps")
                ->where("a.id_matakuliah=c.id_matakuliah")->get()->result_array();
    }
    function get_soal_per_prodi($id_prodi)
    {
        return $this->db->select("a.id, a.kode_soal, b.nama_matakuliah")
                ->from("cbt_bank_soal_head a")
                ->from("5_akademik_matakuliah b")
                ->where("a.id_matakuliah=b.id_matakuliah")
                ->where("a.id_prodi", $id_prodi)
                ->get()->result_array();
    }
    //jadwal ujian
    function insert_jadwal($data)
    {
        $this->db->insert("cbt_jadwal_ujian", $data);
    }
    function get_jadwal_ujian_all()
    {
        return $this->db->select("a.*, c.nama_tahun, d.nama_ps, e.nama_matakuliah")
            ->from("cbt_jadwal_ujian a")
            ->from("cbt_bank_soal_head b")
            ->from("umum_thn_akademik c")
            ->from("1_2_identitas_ps d")
            ->from("5_akademik_matakuliah e")
            ->where("a.id_soal=b.id")
            ->where("a.id_ta=c.id_thn_akademik")
            ->where("a.id_prodi=d.id_ps")
            ->where("b.id_matakuliah=e.id_matakuliah")
            ->order_by("a.tanggal_ujian", "desc")
            ->get()->result_array();
    }
    function get_head_jadwal_ujian($id)
    {
        return $this->db->select("a.*, b.team_dosen, c.nama_tahun, d.nama_ps, e.nama_matakuliah")
            ->from("cbt_jadwal_ujian a")
            ->from("cbt_bank_soal_head b")
            ->from("umum_thn_akademik c")
            ->from("1_2_identitas_ps d")
            ->from("5_akademik_matakuliah e")
            ->where("a.id_soal=b.id")
            ->where("a.id_ta=c.id_thn_akademik")
            ->where("a.id_prodi=d.id_ps")
            ->where("b.id_matakuliah=e.id_matakuliah")
            ->where("a.id", $id)
            ->get()->row();
    }
    //peserta
    function insert_peserta($data)
    {
        $this->db->insert("cbt_peserta", $data);
    }
    function get_peserta($idhead)
    {
        return $this->db->select("a.*, b.nim, b.nama_mahasiswa")
                ->from("cbt_peserta a")
                ->from("3_1_biodata_mahasiswa b")
                ->where("a.id_mahasiswa=b.id_mahasiswa")
                ->get()->result_array();
    }
    function cek_data_peserta($id_peserta, $id_h)
    {
        $res = $this->db->where("id", $id_h)->where("id_mahasiswa", $id_peserta)->get("cbt_peserta")->row();
        if(empty($res->id))
        {
            $hasil_cek=0;
        } else {
            $hasil_cek=1;
        }
        return $hasil_cek;
    }
}