<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akademik extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('model_akademik', 'model_opsi'));
		date_default_timezone_set("Asia/Makassar");
	}
	function _init()
	{
		$this->output->set_template('index');
	}
    //matakuliah
	public function matakuliah()
	{
		$this->Model_security->get_security();
		$this->_init();
        $data['mst_prodi'] = $this->model_opsi->get_master_prodi();
		$this->load->view('proses/akademik/matakuliah/index', $data);
	}
    public function tampilkan_matakuliah()
    {
        $this->Model_security->get_security();
        $id_prodi = $this->uri->segment(3);
        $data['res_matkul'] = $this->model_akademik->get_matakuliah_per_prodi($id_prodi);
        $this->load->view("proses/akademik/matakuliah/v_matakuliah", $data);
    }
    public function tambah_matakuliah()
    {
        $this->Model_security->get_security();
		$this->_init();
        $data['mst_prodi'] = $this->model_opsi->get_master_prodi();
        $data['jenis_matkul'] = $this->model_opsi->get_jenis_matakuliah();
        $data['semester'] = $this->model_opsi->get_semester();
        $this->load->view("proses/akademik/matakuliah/add_matakuliah", $data);
    }
    public function cek_kode_matakuliah()
    {
        $kode = $this->input->post("kode");
        $result = $this->model_akademik->get_kode_matakuliah($kode);
        echo $result;
    }
    public function simpan_matakuliah()
    {
        $this->Model_security->get_security();
        $data['program_studi'] = $this->input->post("pil_ps");
        $data['kode_matakuliah'] = $this->input->post("inp_kode_matkul");
        $data['jenis_mk'] = $this->input->post("pil_jenis");
        $data['nama_matakuliah'] = $this->input->post("inp_nama_matkul");
        $data['semester'] = $this->input->post("pil_semester");
        $data['sks'] = $this->input->post("inp_sks");
        $data['jumlah_pertemuan'] = $this->input->post("inp_jumlah_pertemuan");
        $data['jumlah_menit_pertemuan'] = $this->input->post("inp_menit_pertemuan");
        $data['aktif'] = 1;
        $this->model_akademik->insert_matakuliah($data);
        $this->session->set_flashdata('info', "Matakuliah baru berhasil disimpan");
		redirect('akademik/matakuliah');
    }
}