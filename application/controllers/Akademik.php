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
}