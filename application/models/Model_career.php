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
}