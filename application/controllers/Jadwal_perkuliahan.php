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
	public function tambah_data()
	{
		$this->Model_security->get_security();
		$this->_init();
		$data['list_ta'] = $this->model_jadwal->get_ta();
		$data['list_prodi'] = $this->model_jadwal->get_prodi();
		$this->load->view("proses/jadwal_kuliah/baru", $data);
	}
	public function tampilkan_matkul_per_prodi()
	{
		$id_prodi = $this->uri->segment(3);
		$res_matkul = $this->model_jadwal->get_matkul_per_prodi($id_prodi);
		echo "<option></option>";
		foreach($res_matkul as $list) {
			echo "<option value=".$list['id_matakuliah'].">".$list['kode_matakuliah']." | ".$list['nama_matakuliah']."</option>";
		}
	}
	public function tampilkan_profil_matkul()
	{
		$id_markul = $this->uri->segment(3);
		$res_matkul = $this->model_jadwal->get_profil_matkul($id_markul);
		echo $res_matkul->semester."/".$res_matkul->sks;
	}
}