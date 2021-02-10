<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Faq extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Model_faq', 'Model_opsi_kat_faq'));
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
		$data['list_kategori'] = $this->Model_opsi_kat_faq->get_all();
		$data['list_data'] = $this->Model_faq->get_all_data();
		$this->load->view('proses/home_page/faq/index', $data);
	}
	public function simpan_data()
	{
		$data['id_kat_faq'] = $this->input->post("pil_kategori");
		$data['pertanyaan'] = $this->input->post("inp_pertanyaan");
		$data['jawaban'] = $this->input->post("inp_jawaban");
		$data['status'] = 1;
		$data['tgl_post'] = date("Y-m-d");
		$this->Model_faq->insert_data($data);
		$this->session->set_flashdata('info', "Data berhasil disimpan");
		redirect('faq');
	}
	public function edit_data()
	{
		$id_data = $this->uri->segment(3);
		$data['list_kategori'] = $this->Model_opsi_kat_faq->get_all();
		$data['res'] = $this->Model_faq->get_profil($id_data);
		$this->load->view("proses/home_page/faq/edit", $data);
	}
	public function rubah_data()
	{
		$key = $this->input->post("id_tabel");
		$data['id_kat_faq'] = $this->input->post("pil_kategori");
		$data['pertanyaan'] = $this->input->post("inp_pertanyaan");
		$data['jawaban'] = $this->input->post("inp_jawaban");
		$this->Model_faq->update_data($key, $data);
		$this->session->set_flashdata('info', "Perubahan data berhasil disimpan");
		redirect('faq');
	}
	public function hapus_data()
	{
		$id_data = $this->input->post("id_data");
		$this->Model_faq->delete_data($id_data);
		echo "Data berhasil dihapus";
	}
}