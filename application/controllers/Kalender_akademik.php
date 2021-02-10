<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kalender_akademik extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('model_ka'));
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
		$data['list_ta'] = $this->model_ka->get_all_ta();
		$this->load->view('proses/kalender_akademik/index', $data);
	}
	public function simpan_data_head()
	{
		$this->Model_security->get_security();
		$data['ta'] = $this->input->post('inp_ta');
		$data['semester'] = $this->input->post('pil_semester');
		$data['tgl_post'] = date("Y-m-d");
		$data['status'] = 1; //Aktif
		$this->model_ka->insert_head($data);
		$this->session->set_flashdata('info', "Data Tahun Akademik berhasil disimpan");
		redirect('kalender_akademik');
	}
	public function edit_head()
	{
		$this->Model_security->get_security();
		$id_head = $this->uri->segment(3);
		$data['head'] = $this->model_ka->get_profil_head($id_head);
		$this->load->view('proses/kalender_akademik/edit_head', $data);
	}
	public function rubah_data_head()
	{
		$this->Model_security->get_security();
		$id_head = $this->input->post('id_head');
		$data['ta'] = $this->input->post('inp_ta');
		$data['semester'] = $this->input->post('pil_semester');
		$data['status'] = $this->input->post('pil_aktif');
		$this->model_ka->update_head($id_head, $data);
		$this->session->set_flashdata('info', "Perubahan data Tahun Akademik berhasil disimpan");
		redirect('kalender_akademik');
	}
	public function add_kegiatan()
	{
		$this->Model_security->get_security();
		$id_head = $this->uri->segment(3);
		$data['id_head'] = $id_head;
		$this->load->view("proses/kalender_akademik/add_kegiatan", $data);
	}
	public function simpan_detail()
	{
		$this->Model_security->get_security();
		$id_head = $this->input->post('id_head');
		$data['id_head'] = $id_head;
		$data['kegiatan'] = $this->input->post('inp_deskripsi');
		$s_tgl_1 = explode("/", $this->input->post("tgl_start"));
		$data['tgl_awal'] = $s_tgl_1[2]."-".$s_tgl_1[1]."-".$s_tgl_1[0];
		$s_tgl_2 = explode("/", $this->input->post("tgl_end"));
		$data['tgl_akhir'] = $s_tgl_2[2]."-".$s_tgl_2[1]."-".$s_tgl_2[0];
		$data['warna'] = $this->input->post('inp_warna');
		$this->model_ka->insert_detail($data);
		$this->session->set_flashdata('info', "Data Kegiatan Akademik berhasil disimpan");
		redirect('kalender_akademik');
	}
	function edit_kegiatan()
	{
		$this->Model_security->get_security();
		$id_detail = $this->uri->segment(3);
		$data['res'] = $this->model_ka->get_profil_detail($id_detail);
		$this->load->view('proses/kalender_akademik/edit_kegiatan', $data);
	}
	function rubah_detail()
	{
		$this->Model_security->get_security();
		$id_detail = $this->input->post('id_detail');
		$data['kegiatan'] = $this->input->post('inp_deskripsi');
		$s_tgl_1 = explode("/", $this->input->post("tgl_start"));
		$data['tgl_awal'] = $s_tgl_1[2]."-".$s_tgl_1[1]."-".$s_tgl_1[0];
		$s_tgl_2 = explode("/", $this->input->post("tgl_end"));
		$data['tgl_akhir'] = $s_tgl_2[2]."-".$s_tgl_2[1]."-".$s_tgl_2[0];
		$data['warna'] = $this->input->post('inp_warna');
		$this->model_ka->update_detail($id_detail, $data);
		$this->session->set_flashdata('info', "Perubahan data Kegiatan Akademik berhasil disimpan");
		redirect('kalender_akademik');
	}
	function hapus_detail()
	{
		$id_detail = $this->input->post('id_data');
		$this->model_ka->delete_detail($id_detail);
		echo "Item kegiatan berhasil dihapus";
	}
}