<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Slide extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Model_slide'));
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
		$data['list_data'] = $this->Model_slide->get_all_data();
		$this->load->view('proses/home_page/slider/index', $data);
	}
	
	public function simpan_data()
	{
		if(!empty($_FILES['inp_file']['name']))
		{
			$bln = date("m");
			$nm_fl = $bln."-".time().date('dmY');
			$fl = $this->upload_file($nm_fl, "slide");
			if ($fl != false) 
			{
				$smp_file = $fl;
				$data['id'] = uniqid();
				$data['judul'] = $this->input->post("inp_judul");
				$data['keterangan'] = $this->input->post("inp_deskripsi");
				$data['disp'] = 1; //tampil
				$data['posting'] = date("Y-m-d");
				$data['img_file'] = $smp_file;
				$this->Model_slide->insert_data($data);
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
		redirect('slide');
	}
	public function edit_data()
	{
		$id_data = $this->uri->segment(3);
		$data['res'] = $this->Model_slide->get_profil($id_data);
		$this->load->view("proses/home_page/slider/edit", $data);
	}
	public function rubah_data()
	{
		$id_data = $this->input->post("id_tabel");
		if(empty($_FILES['inp_file']['name']) && !empty($this->input->post('temp_file')))
		{
			$data['judul'] = $this->input->post("inp_judul");
			$data['keterangan'] = $this->input->post("inp_deskripsi");
			$data['disp'] = $this->input->post("pil_status");
			$this->Model_slide->update_data($id_data, $data);
			$pesan = "Perubahan data telah disimpan";
		} else {
			$bln = date("m");
			$nm_fl = $bln."-".time().date('dmY');
			$fl = $this->upload_file($nm_fl, "slide");
			if ($fl != false) 
			{
				$smp_file = $fl;
				$data['judul'] = $this->input->post("inp_judul");
				$data['keterangan'] = $this->input->post("inp_deskripsi");
				$data['disp'] = $this->input->post("pil_status");
				$data['img_file'] = $smp_file;
				$this->Model_slide->remove_image($id_data);
				$this->Model_slide->update_data($id_data, $data);
				$pesan = "Perubahan data telah disimpan";
			}
			else
			{
				$pesan = "Upload File Gagal. Tipe File salah";
			}
		}
		$this->session->set_flashdata('info', $pesan);
		redirect('slide');
	}
	function hapus_data()
	{
		$id_data = $this->input->post("id_data");
		$this->Model_slide->remove_image($id_data);
		$this->Model_slide->delete_data($id_data);
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
