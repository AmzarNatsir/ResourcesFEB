<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Career extends CI_Controller {

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
        $id_user = NULL; //admin
        //$arr_tgl_1 = explode("/", $this->input->post('tgl_star'));
		//$arr_tgl_2 = explode("/", $this->input->post('tgl_end'));
		//$tgl_awal = $arr_tgl_1[2]."-".$arr_tgl_1[1]."-".$arr_tgl_1[0];
		//$tgl_akhir = $arr_tgl_2[2]."-".$arr_tgl_2[1]."-".$arr_tgl_2[0];
		$tgl_awal = $this->input->post('tgl_star');
		$tgl_akhir = $this->input->post('tgl_end');
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
                $fl = $this->upload_gambar($nm_fl);
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
        $this->model_career->insert_data_loker($data);
        $this->session->set_flashdata("info", "Data berhasil disimpan");
        redirect("career/lowongan_kerja");
	}
	public function edit_lowongan_kerja()
	{
		$this->Model_security->get_security();
        $id_tabel = encrypt_decrypt('decrypt', $this->uri->segment(3));
        $result = $this->model_career->get_profil_loker($id_tabel);
        if(empty($result->id))
        {
            redirect("career/lowongan_kerja");
        } else {
            $this->_init();
            $data['kategori_loker'] = $this->model_career->get_all_kategori_loker();
            $data['provinsi'] = $this->model_career->get_all_provinsi();
            $data['kabupaten'] = $this->model_career->get_all_kabupaten($result->id_provinsi);
            $data['res'] = $result;
            $this->load->view("proses/career_center/loker/edit", $data);
        }
	}
	public function rubah_lowongan_kerja()
	{
		$this->Model_security->get_security();
        $ada_file = $this->input->post("upload_gambar");
        $id_tabel = $this->input->post("id_tabel");
		$tgl_awal = $this->input->post('tgl_star');
		$tgl_akhir = $this->input->post('tgl_end');
        if($ada_file==1) {
            if(!empty($_FILES["inp_gambar"]["name"]))
            {
                $nm_fl = time().date('dmY');
                $fl = $this->upload_gambar($nm_fl);
                if ($fl != false) 
                {
                    $smp_file = $fl;
                    $data['file_lampiran'] = $smp_file;
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
                    $data['tampilkan'] = $this->input->post("tampilkan_info");
                    $this->model_career->remove_gambar_loker($id_tabel);
                    $this->model_career->update_data_loker($id_tabel, $data);
                }
            } else {
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
                $data['tampilkan'] = $this->input->post("tampilkan_info");
                $this->model_career->update_data_loker($id_tabel, $data);
            }
        } else {
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
            $data['file_lampiran'] = NULL;
            $data['tampilkan'] = $this->input->post("tampilkan_info");
            $this->model_career->remove_gambar_loker($id_tabel);
            $this->model_career->update_data_loker($id_tabel, $data);
        }
        $this->session->set_flashdata("info", "Perubahan Data berhasil disimpan");
        redirect("career/lowongan_kerja");
	}
	public function hapus_lowongan_kerja()
    {
        $this->Model_security->get_security();
        $id_tabel = encrypt_decrypt('decrypt', $this->uri->segment(3));
        $this->model_career->remove_gambar_loker($id_tabel);
        $this->model_career->delete_data_loker($id_tabel);
        $this->session->set_flashdata("info", "Data berhasil dihapus");
        redirect("career/lowongan_kerja");
    }
    //upload file
    private function upload_gambar($nm_file)
    {
        $config['upload_path'] = '../'.file_loker;
        $config['allowed_types'] = 'jpg|jpeg|jpg|png';
        $config['file_name'] = $nm_file;
        $config['remove_spaces'] = TRUE;
        $config['overwrite'] = TRUE;
        $filename = $config['file_name'];

        $this->load->library('upload');
        $this->upload->initialize($config);

        if ( ! $this->upload->do_upload("inp_gambar"))
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
    //informasi kegiatan
    public function info_kegiatan()
    {
        $this->Model_security->get_security();
		$this->_init();
        //$data['kat_l'] = $this->model_career->get_all_kategori_loker();
        $data['all_kegiatan'] = $this->model_career->get_kegiatan_all();
        $this->load->view("proses/career_center/kegiatan/index", $data);
    }
    public function tambah_info_kegiatan()
    {
        $this->Model_security->get_security();
		$this->_init();
        $data['kat_kegiatan'] = $this->model_career->get_all_kategori_kegiatan();
        $this->load->view("proses/career_center/kegiatan/add", $data);
    }
    public function simpan_info_kegiatan()
    {
        $this->Model_security->get_security();
        $ada_file = $this->input->post("upload_gambar");
        $id_user = NULL;
        $data['id_user'] = $id_user;
        $data['id_kategori'] = $this->input->post("pil_kategori");
        $data['judul_kegiatan'] = trim($this->input->post("inp_nama"));
        $data['deskripsi'] = trim($this->input->post("inp_deskripsi"));
        $data['pelaksana'] = trim($this->input->post("inp_pelaksana"));
        $data['tgl_awal'] = $this->input->post('tgl_star');
        $data['tgl_akhir'] = $this->input->post('tgl_end');
        $data['tempat'] = trim($this->input->post("inp_tempat"));
        $data['sumber_link'] = trim($this->input->post("inp_sumber"));
        $data['ada_file'] = $ada_file;
        if($ada_file==1){
            if(!empty($_FILES["inp_gambar"]["name"]))
            {
                $nm_fl = time().date('dmY');
                $fl = $this->upload_gambar_kegiatan($nm_fl);
                if ($fl != false) 
                {
                    $smp_file = $fl;
                    $data['file_gambar'] = $smp_file;
                }
            }
        }
        $data['tgl_posting'] = date("Y-m-d");
        $data['tampilkan'] = 1; //informasi ditampilkan
        $data['pengunjung'] = 0;
        $this->model_career->insert_data_kegiatan($data);
        $this->session->set_flashdata("info", "Data berhasil disimpan");
        redirect("career/info_kegiatan");
    }
    public function edit_info_kegiatan()
    {
        $this->Model_security->get_security();
        $id_tabel = encrypt_decrypt('decrypt', $this->uri->segment(3));
        $result = $this->model_career->get_profil_kegiatan($id_tabel);
        if(empty($result->id))
        {
            redirect("career/info_kegiatan");
        } else {
            $this->_init();
            $data['kat_kegiatan'] = $this->model_career->get_all_kategori_kegiatan();
            $data['res'] = $result;
            $this->load->view("proses/career_center/kegiatan/edit", $data);
        }
    }
    public function rubah_info_kegiatan()
    {
        $this->Model_security->get_security();
        $ada_file = $this->input->post("upload_gambar");
        $id_tabel = $this->input->post("id_tabel");
        if($ada_file==1) {
            if(!empty($_FILES["inp_gambar"]["name"]))
            {
                $nm_fl = time().date('dmY');
                $fl = $this->upload_gambar_kegiatan($nm_fl);
                if ($fl != false) 
                {
                    $smp_file = $fl;
                    $data['file_gambar'] = $smp_file;
                    $data['id_kategori'] = $this->input->post("pil_kategori");
                    $data['judul_kegiatan'] = trim($this->input->post("inp_nama"));
                    $data['deskripsi'] = trim($this->input->post("inp_deskripsi"));
                    $data['pelaksana'] = trim($this->input->post("inp_pelaksana"));
                    $data['tgl_awal'] = $this->input->post('tgl_star');
                    $data['tgl_akhir'] = $this->input->post('tgl_end');
                    $data['tempat'] = trim($this->input->post("inp_tempat"));
                    $data['sumber_link'] = trim($this->input->post("inp_sumber"));
                    $data['ada_file'] = $ada_file;
                    $data['tampilkan'] = $this->input->post("tampilkan_info");
                    $this->model_career->remove_gambar_kegiatan($id_tabel);
                    $this->model_career->update_data_kegiatan($id_tabel, $data);
                }
            } else {
                $data['id_kategori'] = $this->input->post("pil_kategori");
                $data['judul_kegiatan'] = trim($this->input->post("inp_nama"));
                $data['deskripsi'] = trim($this->input->post("inp_deskripsi"));
                $data['pelaksana'] = trim($this->input->post("inp_pelaksana"));
                $data['tgl_awal'] = $this->input->post('tgl_star');
                $data['tgl_akhir'] = $this->input->post('tgl_end');
                $data['tempat'] = trim($this->input->post("inp_tempat"));
                $data['sumber_link'] = trim($this->input->post("inp_sumber"));
                $data['ada_file'] = $ada_file;
                $data['tampilkan'] = $this->input->post("tampilkan_info");
                $this->model_career->update_data_kegiatan($id_tabel, $data);
            }
        } else {
            $data['id_kategori'] = $this->input->post("pil_kategori");
            $data['judul_kegiatan'] = trim($this->input->post("inp_nama"));
            $data['deskripsi'] = trim($this->input->post("inp_deskripsi"));
            $data['pelaksana'] = trim($this->input->post("inp_pelaksana"));
            $data['tgl_awal'] = $this->input->post('tgl_star');
            $data['tgl_akhir'] = $this->input->post('tgl_end');
            $data['tempat'] = trim($this->input->post("inp_tempat"));
            $data['sumber_link'] = trim($this->input->post("inp_sumber"));
            $data['ada_file'] = $ada_file;
            $data['tampilkan'] = $this->input->post("tampilkan_info");
            $data['file_gambar'] = NULL;
            $data['tampilkan'] = $this->input->post("tampilkan_info");
            $this->model_career->remove_gambar_kegiatan($id_tabel);
            $this->model_career->update_data_kegiatan($id_tabel, $data);
        }
        $this->session->set_flashdata("info", "Perubahan Data berhasil disimpan");
        redirect("career/info_kegiatan");
    }
    public function hapus_info_kegiatan()
    {
        $this->Model_security->get_security();
        $id_tabel = encrypt_decrypt('decrypt', $this->uri->segment(3));
        $this->model_career->remove_gambar_kegiatan($id_tabel);
        $this->model_career->delete_data_kegiatan($id_tabel);
        $this->session->set_flashdata("info", "Data berhasil dihapus");
        redirect("career/info_kegiatan");
    }
    public function upload_gambar_kegiatan($nm_file)
    {
        $config['upload_path'] = '../'.file_kegiatan;
        $config['allowed_types'] = 'jpg|jpeg|jpg|png';
        $config['file_name'] = $nm_file;
        $config['remove_spaces'] = TRUE;
        $config['overwrite'] = TRUE;
        $filename = $config['file_name'];

        $this->load->library('upload');
        $this->upload->initialize($config);

        if ( ! $this->upload->do_upload("inp_gambar"))
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