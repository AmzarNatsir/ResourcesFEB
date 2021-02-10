<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Berita extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Model_berita', 'Model_opsi_kat_berita'));
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
		$data['list_kategori'] = $this->Model_opsi_kat_berita->get_all();
		$data['list_data'] = $this->Model_berita->get_all_data();
		$this->load->view('proses/home_page/berita/index', $data);
	}
	public function simpan_data()
	{
		if(!empty($_FILES['inp_file']['name']))
		{
			$bln = date("m");
			$nm_fl = $bln."-".time().date('dmY');
			$fl = $this->upload_file($nm_fl, "berita");
			if ($fl != false) 
			{
				$smp_file = $fl;
				$data['kategori'] = $this->input->post("pil_kategori");
				$data['judul'] = $this->input->post("inp_judul");
				$data['deskripsi'] = $this->input->post("inp_deskripsi");
				$data['isi'] = $this->input->post("inp_isi");
				$data['url'] = $this->input->post("inp_url");
				$data['status'] = $this->input->post("pil_tampilan");
				$data['post_date'] = date("Y-m-d");
				$data['file_img'] = $smp_file;
				$this->Model_berita->insert_data($data);
				$pesan = "Penyimpanan Data Baru berhasil dilakukan";
				$err = 1;
			}
			else
			{
				$pesan = "Upload File Gagal. Tipe File salah";
				$err = 2;
			}
		}
		else
		{
			$err = 3;
			$pesan = "File Image Slide tidak boleh kosong";
		}
		$this->session->set_flashdata('info', $pesan);
		redirect('berita');
	}
	public function edit_data()
	{
		$id_data = $this->uri->segment(3);
		$data['list_kategori'] = $this->Model_opsi_kat_berita->get_all();
		$data['res'] = $this->Model_berita->get_profil($id_data);
		$this->load->view("proses/home_page/berita/edit", $data);
	}
	public function rubah_data()
	{
		$id_data = $this->input->post("id_tabel");
		if(empty($_FILES['inp_file']['name']) && !empty($this->input->post('temp_file')))
		{
			$data['kategori'] = $this->input->post("pil_kategori");
			$data['judul'] = $this->input->post("inp_judul");
			$data['deskripsi'] = $this->input->post("inp_deskripsi");
			$data['isi'] = $this->input->post("inp_isi");
			$data['url'] = $this->input->post("inp_url");
			$data['status'] = $this->input->post("pil_tampilan");
			$this->Model_berita->update_data($id_data, $data);
			$pesan = "Perubahan data telah disimpan";
		} else {
			$bln = date("m");
			$nm_fl = $bln."-".time().date('dmY');
			$fl = $this->upload_file($nm_fl, "berita");
			if ($fl != false) 
			{
				$smp_file = $fl;
				$data['kategori'] = $this->input->post("pil_kategori");
				$data['judul'] = $this->input->post("inp_judul");
				$data['deskripsi'] = $this->input->post("inp_deskripsi");
				$data['isi'] = $this->input->post("inp_isi");
				$data['url'] = $this->input->post("inp_url");
				$data['status'] = $this->input->post("pil_tampilan");
				$data['file_img'] = $smp_file;
				$this->Model_berita->remove_image($id_data);
				$this->Model_berita->update_data($id_data, $data);
				$pesan = "Perubahan data telah disimpan";
			}
			else
			{
				$pesan = "Upload File Gagal. Tipe File salah";
			}
		}
		$this->session->set_flashdata('info', $pesan);
		redirect('berita');
	}
	function hapus_data()
	{
		$id_data = $this->input->post("id_data");
		$this->Model_berita->remove_image($id_data);
		$this->Model_berita->delete_data($id_data);
		echo "Data berhasil dihapus";
	}
	private function upload_file($nm_file, $folder)
	{
		$config['upload_path'] = './assets/upload/'.$folder.'/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['file_name'] = $nm_file;
		$config['remove_spaces'] = TRUE;
        $config['overwrite'] = TRUE;
	    $filename = $config['file_name'];

		$this->load->library('upload');
	    $this->upload->initialize($config);

	    if ( ! $this->upload->do_upload('inp_file'))
	    {
	        $error = array('error' => $this->upload->display_errors());
	        //print_r($error);
	        return false;
	    }
	    else
	    {
	        $data = array('upload_data' => $this->upload->data());
	       	return $filename.$data['upload_data']['file_ext'];
	    }
	}
}
