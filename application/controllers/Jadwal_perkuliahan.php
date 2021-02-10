<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_perkuliahan extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('model_jadwal'));
		date_default_timezone_set("Asia/Makassar");
	}
	function _init()
	{
		$this->output->set_template('index');
	}
	public function index()
	{
		$this->Model_security->get_security();
		$this->_init();
		$data['list_jadwal'] = $this->model_jadwal->get_jadwal();
		$this->load->view('proses/jadwal_kuliah/index', $data);
	}
}