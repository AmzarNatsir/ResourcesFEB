<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Mitra extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('model_mitra'));
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
		$data['list_data'] = $this->model_mitra->get_all_data();
		$this->load->view('proses/home_page/mitra/index', $data);
	}
	
	public function simpan_data()
	{
		if(!empty($_FILES['inp_file']['name']))
		{
			$bln = date("m");
			$nm_fl = $bln."-".time().date('dmY');
			$fl = $this->upload_file($nm_fl, "mitra");
			if ($fl != false) 
			{
				$smp_file = $fl;
				$data['id'] = uniqid();
				$data['keterangan'] = $this->input->post("inp_keterangan");
				$data['img_file'] = $smp_file;
				$this->model_mitra->insert_data($data);
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
		redirect('mitra');
	}
	public function edit_data()
	{
		$id_data = $this->uri->segment(3);
		$data['res'] = $this->model_mitra->get_profil($id_data);
		$this->load->view("proses/home_page/mitra/edit", $data);
	}
	public function rubah_data()
	{
		$id_data = $this->input->post("id_tabel");
		if(empty($_FILES['inp_file']['name']) && !empty($this->input->post('temp_file')))
		{
			$data['keterangan'] = $this->input->post("inp_keterangan");
			$this->model_mitra->update_data($id_data, $data);
			$pesan = "Perubahan data telah disimpan";
		} else {
			$bln = date("m");
			$nm_fl = $bln."-".time().date('dmY');
			$fl = $this->upload_file($nm_fl, "mitra");
			if ($fl != false) 
			{
				$smp_file = $fl;
				$data['keterangan'] = $this->input->post("inp_keterangan");
				$data['img_file'] = $smp_file;
				$this->model_mitra->remove_image($id_data);
				$this->model_mitra->update_data($id_data, $data);
				$pesan = "Perubahan data telah disimpan";
			}
			else
			{
				$pesan = "Upload File Gagal. Tipe File salah";
			}
		}
		$this->session->set_flashdata('info', $pesan);
		redirect('mitra');
	}
	function hapus_data()
	{
		$id_data = $this->input->post("id_data");
		$this->model_mitra->remove_image($id_data);
		$this->model_mitra->delete_data($id_data);
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
