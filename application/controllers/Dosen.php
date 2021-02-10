<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('model_dosen', 'model_opsi'));
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
		$data['dsn_all'] = $this->model_dosen->get_dsn_all();
		$this->load->view('proses/dosen/index', $data);
	}
	
	public function edit_data()
	{
		$this->Model_security->get_security();
		$id_dosen = $this->uri->Segment(3);
		$data['profil'] = $this->model_dosen->get_profil_dosen($id_dosen);
		$data['list_jabfung'] = $this->model_opsi->get_master_jab_funsional();
		$data['list_jabakademik'] = $this->model_opsi->get_master_jab_akademik();
		$this->load->view('proses/dosen/edit', $data);

	}
	public function rubah_data()
	{
		$this->Model_security->get_security();
		$id_dosen = $this->input->post('id_tabel');
		$data['nidn'] = $this->input->post('inp_nidn');
		$data['nip'] = $this->input->post('inp_nip');
		$data['nbm'] = $this->input->post('inp_nbm');
		$data['nama_dosen'] = $this->input->post('inp_nama');
		$data['jabatan_fungsional'] = $this->input->post('pil_jabfung');
		$data['jabatan_akademik'] = $this->input->post('pil_jabakademik');
		$data['link_image'] = $this->input->post('inp_link_photo');
		$this->model_dosen->update_data($id_dosen, $data);
		$this->session->set_flashdata('konfirm', "Perubahan Biodata Dosen berhasil disimpan");
		redirect('dosen');
	}
}