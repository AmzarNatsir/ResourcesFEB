<?php 
defined('BASEPATH') OR exit ('No direct script access allowed');
/**
 * 
 */
class Opsi extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Model_opsi_sikap', 'Model_opsi_pengetahuan', 'Model_opsi_keterampilan_umum', 'Model_opsi_keterampilan_khusus', 'Model_opsi_kat_faq', 'Model_opsi_kat_berita', 'Model_opsi_kategori_id', 'model_career'));
		date_default_timezone_set("Asia/Makassar");
	}
	private $_path_opsi_sikap = "opsi/aspek_sikap/";
	private $_path_opsi_pengetahuan = "opsi/aspek_pengetahuan/";
	private $_path_opsi_keterampilan_umum = "opsi/keterampilan_umum/";
	private $_path_opsi_keterampilan_khusus = "opsi/keterampilan_khusus/";
	private $_path_opsi_kat_faq = "opsi/kategori_faq/";
	private $_path_opsi_kat_berita = "opsi/kategori_berita/";
	private $_path_opsi_kategori_id = "opsi/kategori_id/";
	function _init()
	{
		$this->output->set_template('index');
	}
	//aspek sikap
	function aspek_sikap()
	{
		$this->Model_security->get_security();
		$this->_init();
		$data['list_data'] = $this->Model_opsi_sikap->get_all();
		$data['nom_urut'] = $this->Model_opsi_sikap->get_no_urut();
		$this->load->view($this->_path_opsi_sikap."index", $data);
	}
	function aspek_sikap_simpan()
	{
		$this->Model_security->get_security();
		$data['no_urut'] = $this->input->post("nomor_urut");
		$data['aspek_sikap'] = $this->input->post("nm_aspek_sikap");
		$this->Model_opsi_sikap->insert_data($data);
		$this->session->set_flashdata("konfirm", "Data berhasil disimpan");
		redirect("opsi/aspek_sikap");
	}
	function aspek_sikap_edit()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->uri->segment(3);
		$data['res'] = $this->Model_opsi_sikap->get_profil($id_tabel);
		$this->load->view($this->_path_opsi_sikap."edit", $data);
	}
	function aspek_sikap_rubah()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_tabel');
		$data['aspek_sikap'] = $this->input->post("nm_aspek_sikap");
		$this->Model_opsi_sikap->update_data($id_tabel, $data);
		$this->session->set_flashdata("konfirm", "Perubahan data berhasil disimpan");
		redirect("opsi/aspek_sikap");
	}
	function aspek_sikap_hapus()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_data');
		$this->Model_opsi_sikap->delete_data($id_tabel);
		echo "Data berhasil di hapus";
	}
	//aspek pengetahuan
	function aspek_pengetahuan()
	{
		$this->Model_security->get_security();
		$this->_init();
		$data['list_data'] = $this->Model_opsi_pengetahuan->get_all();
		$data['nom_urut'] = $this->Model_opsi_pengetahuan->get_no_urut();
		$this->load->view($this->_path_opsi_pengetahuan."index", $data);
	}
	function aspek_pengetahuan_simpan()
	{
		$this->Model_security->get_security();
		$data['no_urut'] = $this->input->post("nomor_urut");
		$data['aspek_pengetahuan'] = $this->input->post("nm_aspek_pengetahuan");
		$this->Model_opsi_pengetahuan->insert_data($data);
		$this->session->set_flashdata("konfirm", "Data berhasil disimpan");
		redirect("opsi/aspek_pengetahuan");
	}
	function aspek_pengetahuan_edit()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->uri->segment(3);
		$data['res'] = $this->Model_opsi_pengetahuan->get_profil($id_tabel);
		$this->load->view($this->_path_opsi_pengetahuan."edit", $data);
	}
	function aspek_pengetahuan_rubah()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_tabel');
		$data['aspek_pengetahuan'] = $this->input->post("nm_aspek_pengetahuan");
		$this->Model_opsi_pengetahuan->update_data($id_tabel, $data);
		$this->session->set_flashdata("konfirm", "Perubahan data berhasil disimpan");
		redirect("opsi/aspek_pengetahuan");
	}
	function aspek_pengetahuan_hapus()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_data');
		$this->Model_opsi_pengetahuan->delete_data($id_tabel);
		echo "Data berhasil di hapus";
	}
	//aspek keterampilan umum
	function keterampilan_umum()
	{
		$this->Model_security->get_security();
		$this->_init();
		$data['list_data'] = $this->Model_opsi_keterampilan_umum->get_all();
		$data['nom_urut'] = $this->Model_opsi_keterampilan_umum->get_no_urut();
		$this->load->view($this->_path_opsi_keterampilan_umum."index", $data);
	}
	function keterampilan_umum_simpan()
	{
		$this->Model_security->get_security();
		$data['no_urut'] = $this->input->post("nomor_urut");
		$data['keterampilan_umum'] = $this->input->post("nm_aspek_ku");
		$this->Model_opsi_keterampilan_umum->insert_data($data);
		$this->session->set_flashdata("konfirm", "Data berhasil disimpan");
		redirect("opsi/keterampilan_umum");
	}
	function keterampilan_umum_edit()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->uri->segment(3);
		$data['res'] = $this->Model_opsi_keterampilan_umum->get_profil($id_tabel);
		$this->load->view($this->_path_opsi_keterampilan_umum."edit", $data);
	}
	function keterampilan_umum_rubah()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_tabel');
		$data['keterampilan_umum'] = $this->input->post("nm_aspek_ku");
		$this->Model_opsi_keterampilan_umum->update_data($id_tabel, $data);
		$this->session->set_flashdata("konfirm", "Perubahan data berhasil disimpan");
		redirect("opsi/keterampilan_umum");
	}
	function keterampilan_umum_hapus()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_data');
		$this->Model_opsi_keterampilan_umum->delete_data($id_tabel);
		echo "Data berhasil di hapus";
	}
	//aspek keterampilan khusus
	function keterampilan_khusus()
	{
		$this->Model_security->get_security();
		$this->_init();
		$data['list_data'] = $this->Model_opsi_keterampilan_khusus->get_all();
		$data['nom_urut'] = $this->Model_opsi_keterampilan_khusus->get_no_urut();
		$this->load->view($this->_path_opsi_keterampilan_khusus."index", $data);
	}
	function keterampilan_khusus_simpan()
	{
		$this->Model_security->get_security();
		$data['no_urut'] = $this->input->post("nomor_urut");
		$data['keterampilan_khusus'] = $this->input->post("nm_aspek_kk");
		$this->Model_opsi_keterampilan_khusus->insert_data($data);
		$this->session->set_flashdata("konfirm", "Data berhasil disimpan");
		redirect("opsi/keterampilan_khusus");
	}
	function keterampilan_khusus_edit()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->uri->segment(3);
		$data['res'] = $this->Model_opsi_keterampilan_khusus->get_profil($id_tabel);
		$this->load->view($this->_path_opsi_keterampilan_khusus."edit", $data);
	}
	function keterampilan_khusus_rubah()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_tabel');
		$data['keterampilan_khusus'] = $this->input->post("nm_aspek_kk");
		$this->Model_opsi_keterampilan_khusus->update_data($id_tabel, $data);
		$this->session->set_flashdata("konfirm", "Perubahan data berhasil disimpan");
		redirect("opsi/keterampilan_khusus");
	}
	function keterampilan_khusus_hapus()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_data');
		$this->Model_opsi_keterampilan_khusus->delete_data($id_tabel);
		echo "Data berhasil di hapus";
	}
	//kategori faq
	public function kategori_faq()
	{
		$this->Model_security->get_security();
		$this->_init();
		$data['list_data'] = $this->Model_opsi_kat_faq->get_all();
		$this->load->view($this->_path_opsi_kat_faq."index", $data);
	}
	public function kategori_faq_simpan()
	{
		$this->Model_security->get_security();
		$data['nm_kat_faq'] = $this->input->post("nm_kategori");
		$this->Model_opsi_kat_faq->insert_data($data);
		$this->session->set_flashdata("konfirm", "Data berhasil disimpan");
		redirect("opsi/kategori_faq");
	}
	public function kategori_faq_edit()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->uri->segment(3);
		$data['res'] = $this->Model_opsi_kat_faq->get_profil($id_tabel);
		$this->load->view($this->_path_opsi_kat_faq."edit", $data);
	}
	public function kategori_faq_rubah()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_tabel');
		$data['nm_kat_faq'] = $this->input->post("nm_kategori");
		$this->Model_opsi_kat_faq->update_data($id_tabel, $data);
		$this->session->set_flashdata("konfirm", "Perubahan data berhasil disimpan");
		redirect("opsi/kategori_faq");
	}
	function kategori_faq_hapus()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_data');
		$this->Model_opsi_kat_faq->delete_data($id_tabel);
		echo "Data berhasil di hapus";
	}
	//kategori berita
	
	public function kategori_berita()
	{
		$this->Model_security->get_security();
		$this->_init();
		$data['list_data'] = $this->Model_opsi_kat_berita->get_all();
		$this->load->view($this->_path_opsi_kat_berita."index", $data);
	}
	public function kategori_berita_simpan()
	{
		$this->Model_security->get_security();
		$data['nm_kategori'] = $this->input->post("nm_kategori");
		$this->Model_opsi_kat_berita->insert_data($data);
		$this->session->set_flashdata("konfirm", "Data berhasil disimpan");
		redirect("opsi/kategori_berita");
	}
	public function kategori_berita_edit()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->uri->segment(3);
		$data['res'] = $this->Model_opsi_kat_berita->get_profil($id_tabel);
		$this->load->view($this->_path_opsi_kat_berita."edit", $data);
	}
	public function kategori_berita_rubah()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_tabel');
		$data['nm_kategori'] = $this->input->post("nm_kategori");
		$this->Model_opsi_kat_berita->update_data($id_tabel, $data);
		$this->session->set_flashdata("konfirm", "Perubahan data berhasil disimpan");
		redirect("opsi/kategori_berita");
	}
	function kategori_berita_hapus()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_data');
		$this->Model_opsi_kat_berita->delete_data($id_tabel);
		echo "Data berhasil di hapus";
	}
	//kategori ID
	public function kategori_id()
	{
		$this->Model_security->get_security();
		$this->_init();
		$data['list_data'] = $this->Model_opsi_kategori_id->get_all();
		$this->load->view($this->_path_opsi_kategori_id."index", $data);
	}
	public function kategori_id_simpan()
	{
		if(!empty($_FILES['inp_file']['name']))
		{
			$nm_fl = time().date('dmY');
			$fl = $this->upload_file($nm_fl, "id_resources");
			if ($fl != false) 
			{
				$smp_file = $fl;
				$data['nama_id'] = $this->input->post("nm_kategori");
				$data['logo_id'] = $smp_file;
				$this->Model_opsi_kategori_id->insert_data($data);
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
		redirect('opsi/kategori_id');
	}
	public function kategori_id_edit()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->uri->segment(3);
		$data['res'] = $this->Model_opsi_kategori_id->get_profil($id_tabel);
		$this->load->view($this->_path_opsi_kategori_id."edit", $data);
	}
	public function kategori_id_rubah()
	{
		$id_data = $this->input->post("id_tabel");
		if(empty($_FILES['inp_file']['name']) && !empty($this->input->post('temp_file')))
		{
			$data['nama_id'] = $this->input->post("nm_kategori");
			$this->Model_opsi_kategori_id->update_data($id_data, $data);
			$pesan = "Perubahan data telah disimpan";
		} else {
			$nm_fl = time().date('dmY');
			$fl = $this->upload_file($nm_fl, "id_resources");
			if ($fl != false) 
			{
				$smp_file = $fl;
				$data['nama_id'] = $this->input->post("nm_kategori");
				$data['logo_id'] = $smp_file;
				$this->Model_opsi_kategori_id->remove_image($id_data);
				$this->Model_opsi_kategori_id->update_data($id_data, $data);
				$pesan = "Perubahan data telah disimpan";
			}
			else
			{
				$pesan = "Upload File Gagal. Tipe File salah";
			}
		}
		$this->session->set_flashdata('info', $pesan);
		redirect('opsi/kategori_id');
	}
	public function kategori_id_hapus()
	{
		$id_data = $this->input->post("id_data");
		$this->Model_opsi_kategori_id->remove_image($id_data);
		$this->Model_opsi_kategori_id->delete_data($id_data);
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
	//Opsi Career
	public function kategori_loker()
	{
		$this->Model_security->get_security();
		$this->_init();
		$data['list_data'] = $this->model_career->get_all_kategori_loker();
		$this->load->view("opsi/career/kategori_loker/index", $data);
	}
	public function kategori_loker_simpan()
	{
		$this->Model_security->get_security();
		$data['nama_kategori'] = $this->input->post("nm_kategori");
		$this->model_career->insert_data_kategori_loker($data);
		$this->session->set_flashdata("konfirm", "Data berhasil disimpan");
		redirect("opsi/kategori_loker");
	}
	public function kategori_loker_edit()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->uri->segment(3);
		$data['res'] = $this->model_career->get_profil_kategori_loker($id_tabel);
		$this->load->view("opsi/career/kategori_loker/edit", $data);
	}
	public function kategori_loker_rubah()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_tabel');
		$data['nama_kategori'] = $this->input->post("nm_kategori");
		$this->model_career->update_data_kategori_loker($id_tabel, $data);
		$this->session->set_flashdata("konfirm", "Perubahan data berhasil disimpan");
		redirect("opsi/kategori_loker");
	}
	public function kategori_loker_hapus()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_data');
		$this->model_career->delete_data_kategori_loker($id_tabel);
		echo "Data berhasil di hapus";
	}
	//Opsi Career kategori kegiatan
	public function kategori_kegiatan()
	{
		$this->Model_security->get_security();
		$this->_init();
		$data['list_data'] = $this->model_career->get_all_kategori_kegiatan();
		$this->load->view("opsi/career/kategori_kegiatan/index", $data);
	}
	public function kategori_kegiatan_simpan()
	{
		$this->Model_security->get_security();
		$data['nama_kategori'] = $this->input->post("nm_kategori");
		$this->model_career->insert_data_kategori_kegiatan($data);
		$this->session->set_flashdata("konfirm", "Data berhasil disimpan");
		redirect("opsi/kategori_kegiatan");
	}
	public function kategori_kegiatan_edit()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->uri->segment(3);
		$data['res'] = $this->model_career->get_profil_kategori_kegiatan($id_tabel);
		$this->load->view("opsi/career/kategori_kegiatan/edit", $data);
	}
	public function kategori_kegiatan_rubah()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_tabel');
		$data['nama_kategori'] = $this->input->post("nm_kategori");
		$this->model_career->update_data_kategori_kegiatan($id_tabel, $data);
		$this->session->set_flashdata("konfirm", "Perubahan data berhasil disimpan");
		redirect("opsi/kategori_kegiatan");
	}
	public function kategori_kegiatan_hapus()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_data');
		$this->model_career->delete_data_kategori_kegiatan($id_tabel);
		echo "Data berhasil di hapus";
	}
	//Opsi Career kategori Informasi
	public function kategori_informasi_career()
	{
		$this->Model_security->get_security();
		$this->_init();
		$data['list_data'] = $this->model_career->get_all_kategori_informasi();
		$this->load->view("opsi/career/kategori_informasi/index", $data);
	}
	public function kategori_informasi_career_simpan()
	{
		$this->Model_security->get_security();
		$data['nama_kategori'] = $this->input->post("nm_kategori");
		$this->model_career->insert_data_kategori_informasi($data);
		$this->session->set_flashdata("konfirm", "Data berhasil disimpan");
		redirect("opsi/kategori_informasi_career");
	}
	public function kategori_informasi_career_edit()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->uri->segment(3);
		$data['res'] = $this->model_career->get_profil_kategori_informasi($id_tabel);
		$this->load->view("opsi/career/kategori_informasi/edit", $data);
	}
	public function kategori_informasi_career_rubah()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_tabel');
		$data['nama_kategori'] = $this->input->post("nm_kategori");
		$this->model_career->update_data_kategori_informasi($id_tabel, $data);
		$this->session->set_flashdata("konfirm", "Perubahan data berhasil disimpan");
		redirect("opsi/kategori_informasi_career");
	}
	public function kategori_informasi_career_hapus()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_data');
		$this->model_career->delete_data_kategori_informasi($id_tabel);
		echo "Data berhasil di hapus";
	}
	//Opsi Provinsi
	public function provinsi()
	{
		$this->Model_security->get_security();
		$this->_init();
		$data['list_data'] = $this->model_career->get_all_provinsi();
		$this->load->view("opsi/career/provinsi/index", $data);
	}
	public function provinsi_simpan()
	{
		$this->Model_security->get_security();
		$data['nama_provinsi'] = $this->input->post("nm_provinsi");
		$this->model_career->insert_data_provinsi($data);
		$this->session->set_flashdata("konfirm", "Data berhasil disimpan");
		redirect("opsi/provinsi");
	}
	public function provinsi_edit()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->uri->segment(3);
		$data['res'] = $this->model_career->get_profil_provinsi($id_tabel);
		$this->load->view("opsi/career/provinsi/edit", $data);
	}
	public function provinsi_rubah()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_tabel');
		$data['nama_provinsi'] = $this->input->post("nm_provinsi");
		$this->model_career->update_data_provinsi($id_tabel, $data);
		$this->session->set_flashdata("konfirm", "Perubahan data berhasil disimpan");
		redirect("opsi/provinsi");
	}
	public function provinsi_hapus()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_data');
		$this->model_career->delete_data_provinsi($id_tabel);
		echo "Data berhasil di hapus";
	}
	//Opsi Kabupaten
	public function kabupaten()
	{
		$this->Model_security->get_security();
		$this->_init();
		$data['list_provinsi'] = $this->model_career->get_all_provinsi();
		$this->load->view("opsi/career/kabupaten/index", $data);
	}
	public function kabupaten_add()
	{
		$this->Model_security->get_security();
		$id_provinsi = $this->uri->segment(3);
		$data['res_provinsi'] = $this->model_career->get_profil_provinsi($id_provinsi);
		$this->load->view("opsi/career/kabupaten/add", $data);
	}
	public function kabupaten_simpan()
	{
		$this->Model_security->get_security();
		$data['id_provinsi'] = $this->input->post("id_provinsi");
		$data['nama_kabupaten'] = $this->input->post("nm_kabupaten");
		$this->model_career->insert_data_kabupaten($data);
		$this->session->set_flashdata("konfirm", "Data berhasil disimpan");
		redirect("opsi/kabupaten");
	}
	public function kabupaten_edit()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->uri->segment(3);
		$data['res'] = $this->model_career->get_profil_kabupaten($id_tabel);
		$data['res_provinsi'] = $this->model_career->get_all_provinsi();
		$this->load->view("opsi/career/kabupaten/edit", $data);
	}
	public function kabupaten_rubah()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_tabel');
		$data['id_provinsi'] = $this->input->post("nm_provinsi");
		$data['nama_kabupaten'] = $this->input->post("nm_kabupaten");
		$this->model_career->update_data_kabupaten($id_tabel, $data);
		$this->session->set_flashdata("konfirm", "Perubahan data berhasil disimpan");
		redirect("opsi/kabupaten");
	}
	public function kabupaten_hapus()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_data');
		$this->model_career->delete_data_kabupaten($id_tabel);
		echo "Data berhasil di hapus";
	}
	public function filter_kabupaten()
	{
		//$this->Model_security->get_security();
		$id_provinsi = $this->uri->segment(3);
		$data['res_kabupaten'] = $this->model_career->get_all_kabupaten($id_provinsi);
		$this->load->view("opsi/career/kecamatan/filter_kabupaten", $data);
	}
	//Kecamatan
	public function kecamatan()
	{
		$this->Model_security->get_security();
		$this->_init();
		$data['list_provinsi'] = $this->model_career->get_all_provinsi();
		$this->load->view("opsi/career/kecamatan/index", $data);
	}
	public function kecamatan_add()
	{
		$this->Model_security->get_security();
		$id_kabupaten = $this->uri->segment(3);
		$data['res_kabupaten'] = $this->model_career->get_profil_kabupaten($id_kabupaten);
		$this->load->view("opsi/career/kecamatan/add", $data);
	}
	public function kecamatan_simpan()
	{
		$this->Model_security->get_security();
		$data['id_provinsi'] = $this->input->post("id_provinsi");
		$data['id_kabupaten'] = $this->input->post("id_kabupaten");
		$data['nama_kecamatan'] = $this->input->post("nm_kecamatan");
		$this->model_career->insert_data_kecamatan($data);
		$this->session->set_flashdata("konfirm", "Data berhasil disimpan");
		redirect("opsi/kecamatan");
	}
	public function kecamatan_edit()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->uri->segment(3);
		$id_provinsi= $this->model_career->get_profil_kecamatan($id_tabel)->id_provinsi;
		$data['res'] = $this->model_career->get_profil_kecamatan($id_tabel);
		$data['res_provinsi'] = $this->model_career->get_all_provinsi();
		$data['res_kabupaten'] = $this->model_career->get_all_kabupaten($id_provinsi);
		$this->load->view("opsi/career/kecamatan/edit", $data);
	}
	public function kecamatan_rubah()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_tabel');
		$data['id_provinsi'] = $this->input->post("nm_provinsi");
		$data['id_kabupaten'] = $this->input->post("nm_kabupaten");
		$data['nama_kecamatan'] = $this->input->post("nm_kecamatan");
		$this->model_career->update_data_kecamatan($id_tabel, $data);
		$this->session->set_flashdata("konfirm", "Perubahan data berhasil disimpan");
		redirect("opsi/kecamatan");
	}
	public function kecamatan_hapus()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_data');
		$this->model_career->delete_data_kecamatan($id_tabel);
		echo "Data berhasil di hapus";
	}
	public function filter_kecamatan()
	{
		//$this->Model_security->get_security();
		$id_kabupaten = $this->uri->segment(3);
		$data['res_kecamatan'] = $this->model_career->get_all_kecamatan($id_kabupaten);
		$this->load->view("opsi/career/kelurahan/filter_kecamatan", $data);
	}
	//Kelurahan
	public function kelurahan()
	{
		$this->Model_security->get_security();
		$this->_init();
		$data['list_provinsi'] = $this->model_career->get_all_provinsi();
		$this->load->view("opsi/career/kelurahan/index", $data);
	}
	public function kelurahan_add()
	{
		$this->Model_security->get_security();
		$id_kecamatan = $this->uri->segment(3);
		$data['res_kecamatan'] = $this->model_career->get_profil_kecamatan($id_kecamatan);
		$this->load->view("opsi/career/kelurahan/add", $data);
	}
	public function kelurahan_simpan()
	{
		$this->Model_security->get_security();
		$data['id_provinsi'] = $this->input->post("id_provinsi");
		$data['id_kabupaten'] = $this->input->post("id_kabupaten");
		$data['id_kecamatan'] = $this->input->post("id_kecamatan");
		$data['nama_kelurahan'] = $this->input->post("nm_kelurahan");
		$this->model_career->insert_data_kalurahan($data);
		$this->session->set_flashdata("konfirm", "Data berhasil disimpan");
		redirect("opsi/kelurahan");
	}
	public function kelurahan_edit()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->uri->segment(3);
		$id_provinsi= $this->model_career->get_profil_kelurahan($id_tabel)->id_provinsi;
		$id_kabupaten= $this->model_career->get_profil_kelurahan($id_tabel)->id_kabupaten;
		$data['res'] = $this->model_career->get_profil_kelurahan($id_tabel);
		$data['res_provinsi'] = $this->model_career->get_all_provinsi();
		$data['res_kabupaten'] = $this->model_career->get_all_kabupaten($id_provinsi);
		$data['res_kecamatan'] = $this->model_career->get_all_kecamatan($id_kabupaten);
		$this->load->view("opsi/career/kelurahan/edit", $data);
	}
	public function kelurahan_rubah()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_tabel');
		$data['id_provinsi'] = $this->input->post("nm_provinsi");
		$data['id_kabupaten'] = $this->input->post("nm_kabupaten");
		$data['id_kecamatan'] = $this->input->post("nm_kecamatan");
		$data['nama_kelurahan'] = $this->input->post("nm_kelurahan");
		$this->model_career->update_data_kelurahan($id_tabel, $data);
		$this->session->set_flashdata("konfirm", "Perubahan data berhasil disimpan");
		redirect("opsi/kelurahan");
	}
	public function kelurahan_hapus()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_data');
		$this->model_career->delete_data_kelurahan($id_tabel);
		echo "Data berhasil di hapus";
	}
}