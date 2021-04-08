<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Career extends CI_Controller {

	private $link_career = "http://localhost:8088/career.feb/";

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('model_career'));
		date_default_timezone_set("Asia/Makassar");
	}
	function _init()
	{
		$this->output->set_template('index');
	}
    public function lowongan_kerja()
    {
        $this->Model_security->get_security();
		$this->_init();
        $data['kat_loker'] = $this->model_career->get_all_kategori_loker();
        $data['all_loker'] = $this->model_career->get_loker_all();
		$data['provinsi'] = $this->model_career->get_all_provinsi();
        $this->load->view("proses/career_center/loker/index", $data);
    }
	public function tambah_lowongan_kerja()
	{
		$this->Model_security->get_security();
		$this->_init();
        $data['kat_loker'] = $this->model_career->get_all_kategori_loker();
		$data['provinsi'] = $this->model_career->get_all_provinsi();
        $this->load->view("proses/career_center/loker/add", $data);
	}
	public function tampilkan_kabupaten()
	{
		$id_provinsi = $this->uri->segment(3);
		$result = $this->model_career->get_all_kabupaten($id_provinsi);

		$html_view = "<option></option>";
		foreach($result as $kab) {
			$html_view .= "<option value=".$kab['id'].">".$kab['nama_kabupaten']."</option>";
		}
		echo $html_view;
	}
	public function simpan_lowongan_kerja()
	{
		$this->Model_security->get_security();
		$ada_file = $this->input->post("upload_gambar");
        $id_user = $this->session->userdata("idalumni");
        $arr_tgl_1 = explode("-", $this->input->post('tgl_star'));
		$arr_tgl_2 = explode("-", $this->input->post('tgl_end'));
		$tgl_awal = $arr_tgl_1[2]."-".$arr_tgl_1[1]."-".$arr_tgl_1[0];
		$tgl_akhir = $arr_tgl_2[2]."-".$arr_tgl_2[1]."-".$arr_tgl_2[0];
        $data['id_user'] = $id_user;
        $data['id_kategori'] = $this->input->post("pil_kategori");
        $data['nama_perusahaan'] = trim($this->input->post("inp_nama_perusahaan"));
        $data['deskripsi'] = trim($this->input->post("inp_deskripsi"));
        $data['alamat'] = trim($this->input->post("inp_alamat_perusahaan"));
        $data['id_provinsi'] = trim($this->input->post("pil_provinsi"));
        $data['id_kabupaten'] = trim($this->input->post("pil_kabupaten"));
        $data['kontak_person'] = trim($this->input->post("inp_kontak_person"));
        $data['tgl_mulai'] = $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;
        $data['sumber_link'] = trim($this->input->post("inp_sumber"));
        $data['ada_file'] = $ada_file;
        if($ada_file==1){
            if(!empty($_FILES["inp_gambar"]["name"]))
            {
                $nm_fl = time().date('dmY');
                $fl = $this->upload_gambar($nm_fl, "inp_gambar", "loker");
                if ($fl != false) 
                {
                    $smp_file = $fl;
                    $data['file_lampiran'] = $smp_file;
                }
            }
        }
        $data['tgl_posting'] = date("Y-m-d");
        $data['tampilkan'] = 1; //informasi ditampilkan
        $data['pengunjung'] = 0;
        $this->model_panel->insert_data_loker($data);
        $this->session->set_flashdata("konfirm", "Data berhasil disimpan");
        redirect("panel_career/manaj_loker_baru");
	}
	 //upload file
	 private function upload_gambar($nm_file, $inp_nama, $folder)
	 {
		 $config['upload_path'] = $this->link_career.'assets/upload/'.$folder.'/';
		 $config['allowed_types'] = 'jpg|jpeg|jpg|png';
		 $config['file_name'] = $nm_file;
		 $config['remove_spaces'] = TRUE;
		 $config['overwrite'] = TRUE;
		 $filename = $config['file_name'];
 
		 $this->load->library('upload');
		 $this->upload->initialize($config);
 
		 if ( ! $this->upload->do_upload($inp_nama))
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