<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cbt extends CI_Controller 
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
    //buat soal baru
    public function buat_soal()
    {
        $this->Model_security->get_security();
		$this->_init();
        $data['mst_prodi'] = $this->model_opsi->get_master_prodi();
		$this->load->view('proses/cbt/baut_soal/index', $data);
    }
    //bank soal
    public function bank_soal()
    {
        $this->Model_security->get_security();
		$this->_init();
        $data['mst_prodi'] = $this->model_opsi->get_master_prodi();
		$this->load->view('proses/cbt/bank_soal/index', $data);
    }
}