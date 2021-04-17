<?php

use Mpdf\Tag\P;

defined('BASEPATH') OR exit('No direct script access allowed');
class Model_career extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();		
	}
    //Opsi
    //Kategori Loker
    function get_all_kategori_loker()
	{
		return $this->db->get("cc_mst_kategori_job")->result_array();
	}
    function insert_data_kategori_loker($data)
    {
        $this->db->insert("cc_mst_kategori_job", $data);

    }
    function get_profil_kategori_loker($id)
    {
        return $this->db->where("id", $id)->get("cc_mst_kategori_job")->row();
    }
    function update_data_kategori_loker($id, $data)
    {
        $this->db->where("id", $id);
        $this->db->update("cc_mst_kategori_job", $data);
    }
    function delete_data_kategori_loker($id)
    {
        $this->db->where("id", $id);
        $this->db->delete("cc_mst_kategori_job");
    }
    //kategori kegiatan
    function get_all_kategori_kegiatan()
	{
		return $this->db->get("cc_mst_kategori_kegiatan")->result_array();
	}
    function insert_data_kategori_kegiatan($data)
    {
        $this->db->insert("cc_mst_kategori_kegiatan", $data);

    }
    function get_profil_kategori_kegiatan($id)
    {
        return $this->db->where("id", $id)->get("cc_mst_kategori_kegiatan")->row();
    }
    function update_data_kategori_kegiatan($id, $data)
    {
        $this->db->where("id", $id);
        $this->db->update("cc_mst_kategori_kegiatan", $data);
    }
    function delete_data_kategori_kegiatan($id)
    {
        $this->db->where("id", $id);
        $this->db->delete("cc_mst_kategori_kegiatan");
    }
    //kategori informasi
    function get_all_kategori_informasi()
	{
		return $this->db->get("cc_mst_kategori_informasi")->result_array();
	}
    function insert_data_kategori_informasi($data)
    {
        $this->db->insert("cc_mst_kategori_informasi", $data);

    }
    function get_profil_kategori_informasi($id)
    {
        return $this->db->where("id", $id)->get("cc_mst_kategori_informasi")->row();
    }
    function update_data_kategori_informasi($id, $data)
    {
        $this->db->where("id", $id);
        $this->db->update("cc_mst_kategori_informasi", $data);
    }
    function delete_data_kategori_informasi($id)
    {
        $this->db->where("id", $id);
        $this->db->delete("cc_mst_kategori_informasi");
    }
    //Provinsi
    function get_all_provinsi()
	{
		return $this->db->get("mst_provinsi")->result_array();
	}
    function insert_data_provinsi($data)
    {
        $this->db->insert("mst_provinsi", $data);

    }
    function get_profil_provinsi($id)
    {
        return $this->db->where("id", $id)->get("mst_provinsi")->row();
    }
    function update_data_provinsi($id, $data)
    {
        $this->db->where("id", $id);
        $this->db->update("mst_provinsi", $data);
    }
    function delete_data_provinsi($id)
    {
        $this->db->where("id", $id);
        $this->db->delete("mst_provinsi");
    }
    //kabupaten
    function get_all_kabupaten($id_provinsi)
	{
		return $this->db->where("id_provinsi", $id_provinsi)->get("mst_kabupaten")->result_array();
	}
    function insert_data_kabupaten($data)
    {
        $this->db->insert("mst_kabupaten", $data);
    }
    function get_profil_kabupaten($id)
    {
        $this->db->select("a.*, b.nama_provinsi");
        $this->db->from("mst_kabupaten a");
        $this->db->from("mst_provinsi b");
        $this->db->where("a.id_provinsi = b.id");
        return $this->db->where("a.id", $id)->get()->row();
    }
    function update_data_kabupaten($id, $data)
    {
        $this->db->where("id", $id);
        $this->db->update("mst_kabupaten", $data);
    }
    function delete_data_kabupaten($id)
    {
        $this->db->where("id", $id);
        $this->db->delete("mst_kabupaten");
    }
    //Kecamatan
    function get_all_kecamatan($id_kabupaten)
	{
		return $this->db->where("id_kabupaten", $id_kabupaten)->get("mst_kecamatan")->result_array();
	}
    function insert_data_kecamatan($data)
    {
        $this->db->insert("mst_kecamatan", $data);
    }
    function get_profil_kecamatan($id)
    {
        $this->db->select("a.*, b.nama_kabupaten, c.nama_provinsi");
        $this->db->from("mst_kecamatan a");
        $this->db->from("mst_kabupaten b");
        $this->db->from("mst_provinsi c");
        $this->db->where("a.id_kabupaten = b.id");
        $this->db->where("a.id_provinsi = c.id");
        return $this->db->where("a.id", $id)->get()->row();
    }
    function update_data_kecamatan($id, $data)
    {
        $this->db->where("id", $id);
        $this->db->update("mst_kecamatan", $data);
    }
    function delete_data_kecamatan($id)
    {
        $this->db->where("id", $id);
        $this->db->delete("mst_kecamatan");
    }
    //Kelurahan
    function get_all_kelurahan($id_kecamatan)
	{
		return $this->db->where("id_kecamatan", $id_kecamatan)->get("mst_kelurahan")->result_array();
	}
    function insert_data_kalurahan($data)
    {
        $this->db->insert("mst_kelurahan", $data);
    }
    function get_profil_kelurahan($id)
    {
        $this->db->select("a.*, b.nama_kecamatan, c.nama_kabupaten, d.nama_provinsi");
        $this->db->from("mst_kelurahan a");
        $this->db->from("mst_kecamatan b");
        $this->db->from("mst_kabupaten c");
        $this->db->from("mst_provinsi d");
        $this->db->where("a.id_kecamatan = b.id");
        $this->db->where("a.id_kabupaten = c.id");
        $this->db->where("a.id_provinsi = d.id");
        return $this->db->where("a.id", $id)->get()->row();
    }
    function update_data_kelurahan($id, $data)
    {
        $this->db->where("id", $id);
        $this->db->update("mst_kelurahan", $data);
    }
    function delete_data_kelurahan($id)
    {
        $this->db->where("id", $id);
        $this->db->delete("mst_kelurahan");
    }
    //Informasi Loker
    function get_loker_all()
    {
        return $this->db->select("a.*, b.nama_kategori, c.nama_provinsi, d.nama_kabupaten")
                ->from("cc_loker a")
                ->from("cc_mst_kategori_job b")
                ->from("mst_provinsi c")
                ->from("mst_kabupaten d")
                ->where("a.id_kategori=b.id")
                ->where("a.id_provinsi=c.id")
                ->where("a.id_kabupaten=d.id")
                ->where("a.tampilkan", 1)
                ->order_by("a.tgl_posting", "desc")->get()->result_array();
        
    }
    function get_profil_loker($id)
    {
        return $this->db->where("id", $id)->get("cc_loker")->row();
    }
    function insert_data_loker($data)
    {
        $this->db->insert("cc_loker", $data);
    }
    function update_data_loker($id, $data)
    {
        $this->db->where("id", $id)->update("cc_loker", $data);
    }
    function delete_data_loker($id)
    {
        $this->db->where("id", $id)->delete("cc_loker");
    }
    function remove_gambar_loker($id)
    {
        $this->db->select("file_lampiran");
        $this->db->from("cc_loker");
        $this->db->where('id', $id);
        $res = $this->db->get();
        $img = $res->row();
        if(!empty($img->file_lampiran))
        {
            unlink(FCPATH.'../'.file_loker.$img->file_lampiran);
        }
    }
}