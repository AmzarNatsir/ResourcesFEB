<?php 
defined('BASEPATH') OR exit ('No direct script access allowed');
class Rps extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('model_rps', 'Model_opsi_sikap', 'Model_opsi_pengetahuan', 'Model_opsi_keterampilan_umum', 'Model_opsi_keterampilan_khusus'));
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
		$data['list_rps'] = $this->model_rps->get_all_rps();
		$this->load->view("proses/rps/index", $data);
	}
	public function guidelines()
	{
		$this->Model_security->get_security();
		$this->_init();
		$data['sikap'] = $this->Model_opsi_sikap->get_all();
		$data['pengetahuan'] = $this->Model_opsi_pengetahuan->get_all();
		$data['ku'] = $this->Model_opsi_keterampilan_umum->get_all();
		$data['kk'] = $this->Model_opsi_keterampilan_khusus->get_all();
		$this->load->view("proses/rps/guidelines", $data);
	}
	public function add_identitas()
	{
		$this->Model_security->get_security();
		$this->_init();
		$data['list_ps'] = $this->model_rps->get_master_prodi();
		$data['list_dosen'] = $this->model_rps->get_all_dosen();
		$data['list_referensi'] = $this->model_rps->get_all_referensi();
		$this->load->view('proses/rps/add_1', $data);
	}
	public function list_mk()
	{
		$id_prodi = $this->uri->segment(3);
		$data['list_matkul'] = $this->model_rps->get_all_matakuliah_perprodi($id_prodi);
		$this->load->view("proses/rps/select_matakuliah", $data);
	}
	public function get_profil_mk()
	{
		$id_mk = $this->input->post("id_data");
		$result = $this->model_rps->get_profil_matakuliah($id_mk);
		$kode_mk = $result->kode_matakuliah;
		$jml_sks = $result->sks;
		$sms = $result->semester;
		echo $kode_mk."#".$jml_sks."#".$sms;
	}
	public function simpan_identitas()
	{
		$this->Model_security->get_security();
		$data['tahun'] = $this->input->post("pil_tahun");
		$data['id_prodi'] = $this->input->post("pil_prodi");
		$data['id_matkul'] = $this->input->post("pil_matkul");
		$data['prasyarat_matkul'] = $this->input->post("inp_prasyarat");
		$data['id_dosen'] = $this->input->post("pil_dosen");
		$data['deskripsi_matkul'] = $this->input->post("inp_deskripsi");
		$data['pokok_bahasan'] = $this->input->post("inp_desk_materi");
		$data['pil_referensi'] = $this->input->post("pil_ref_utama");
		$data['pil_pustaka_pendukung'] = $this->input->post("pil_ref_pendukung");
		$data['perangkat_lunak'] = $this->input->post("inp_perangkat_lunak");
		$data['perangkat_keras'] = $this->input->post("inp_perangkat_keras");
		$data['status_rps'] = 1; //Belum Terpublikasi
		$data['tgl_post'] = date("Y-m-d");
		$id_rps = $this->model_rps->insert_rps_identitas_desk($data);
		echo encrypt_decrypt('encrypt', $id_rps);
	}
	public function edit_identitas_matakuliah()
	{
		$this->Model_security->get_security();
		$this->_init();
		$id_rps = encrypt_decrypt('decrypt', $this->uri->segment(3));
		$all_dosen = array();
		$result = $this->model_rps->get_data_head_rps($id_rps);
		//dosen pengambpuh
		$arr_dosen = explode(",", $result->id_dosen);
		for ($i=0; $i < count($arr_dosen); $i++) { 
			$all_dosen[] = $this->model_rps->get_profil_dosen($arr_dosen[$i])->nama_dosen;
		}
		$data['dt_head'] = $this->model_rps->get_data_head_rps($id_rps);
		$data['list_dsn'] = $all_dosen;
		$data['list_dosen'] = $this->model_rps->get_all_dosen();
		$data['list_referensi'] = $this->model_rps->get_all_referensi();
		$this->load->view('proses/rps/edit_1', $data);
	}
	public function rubah_identitas()
	{
		$this->Model_security->get_security();
		$id_rps = encrypt_decrypt('decrypt', $this->input->post("id_rps"));
		$data['deskripsi_matkul'] = $this->input->post("inp_deskripsi");
		$data['pokok_bahasan'] = $this->input->post("inp_desk_materi");
		$data['pil_referensi'] = $this->input->post("pil_ref_utama");
		$data['pil_pustaka_pendukung'] = $this->input->post("pil_ref_pendukung");
		$data['perangkat_lunak'] = $this->input->post("inp_perangkat_lunak");
		$data['perangkat_keras'] = $this->input->post("inp_perangkat_keras");
		$data['prasyarat_matkul'] = $this->input->post("inp_prasyarat");
		$this->model_rps->update_rps_head($id_rps, $data);
		echo encrypt_decrypt('encrypt', $id_rps);
	}
	public function hapus_rps()
	{
		$this->Model_security->get_security();
		$id_rps = encrypt_decrypt('decrypt', $this->uri->segment(3));
		$cek_head_rps = $this->model_rps->get_data_head_rps($id_rps);
		$cek_head_cpmk = $this->model_rps->get_all_rps_cpmk($id_rps);
		$cek_head_matriks = $this->model_rps->get_data_rps_matriks($id_rps);

		$this->model_rps->delete_head_rps($id_rps);
		if(count($cek_head_cpmk)) {
			$this->model_rps->delete_cpmk_rps($id_rps);
		}
		if(count($cek_head_matriks)) { 
			$this->model_rps->delete_rps_matriks($id_rps);
		}
		$this->session->set_flashdata("konfirm", "Data RPS berhasil dihapus");
		redirect("rps");
	}
	public function add_capaian_pembelajaran()
	{
		$this->Model_security->get_security();
		$this->_init();
		$id_rps = encrypt_decrypt('decrypt', $this->uri->segment(3));
		$all_dosen = array();
		$result = $this->model_rps->get_data_head_rps($id_rps);
		//dosen pengambpuh
		$arr_dosen = explode(",", $result->id_dosen);
		for ($i=0; $i < count($arr_dosen); $i++) { 
			$all_dosen[] = $this->model_rps->get_profil_dosen($arr_dosen[$i])->nama_dosen;
		}
		$data['dt_head'] = $this->model_rps->get_data_head_rps($id_rps);
		$data['list_dsn'] = $all_dosen;
		$data['list_aspek_sikap'] = $this->model_rps->get_all_rps_aspek_sikap();
		$data['list_aspek_pengetahuan'] = $this->model_rps->get_all_rps_aspek_pengetahuan();
		$data['list_aspek_ku'] = $this->model_rps->get_all_rps_aspek_ku();
		$data['list_aspek_kk'] = $this->model_rps->get_all_rps_aspek_kk();
		$this->load->view('proses/rps/add_2', $data);
	}
	public function simpan_capaian_pembelajaran()
	{
		$this->Model_security->get_security();
		$id_head = encrypt_decrypt('decrypt', $this->input->post("id_rps"));
		$data['pil_aspek_sikap'] = $this->input->post("pil_asp_sikap");
		$data['pil_aspek_pengetahuan'] = $this->input->post("pil_asp_pengetahuan");
		$data['pil_aspek_ku'] = $this->input->post("pil_asp_ku");
		$data['pil_aspek_kk'] = $this->input->post("pil_asp_kk");
		$this->model_rps->update_rps_head($id_head, $data);
		echo "Data Capaian Pembelajaran Lulusan Program Studi (CPL-PRODI) berhasil disimpan. Tahap berikutnya adalah penyusunan Capaian Pembelajaran Matakuliah (CP-MK)";
	}
	public function edit_capaian_pembelajaran()
	{
		$this->Model_security->get_security();
		$this->_init();
		$id_rps = encrypt_decrypt('decrypt', $this->uri->segment(3));
		$all_dosen = array();
		$all_pil_aspek_sikap = array();
		$all_pil_aspek_pengetahuan = array();
		$all_pil_aspek_ku = array();
		$all_pil_aspek_kk = array();
		$result = $this->model_rps->get_data_head_rps($id_rps);
		//dosen pengambpuh
		$arr_dosen = explode(",", $result->id_dosen);
		for ($i=0; $i < count($arr_dosen); $i++) { 
			$all_dosen[] = $this->model_rps->get_profil_dosen($arr_dosen[$i])->nama_dosen;
		}
		//aspek sikap
		$arr_aspek_sikap = explode(",", $result->pil_aspek_sikap);
		for ($i=0; $i < count($arr_aspek_sikap); $i++) { 
			$all_pil_aspek_sikap[] = $arr_aspek_sikap[$i];
		}
		//aspek pengetahuan
		$arr_aspek_pengetahuan = explode(",", $result->pil_aspek_pengetahuan);
		for ($i=0; $i < count($arr_aspek_pengetahuan); $i++) { 
			$all_pil_aspek_pengetahuan[] = $arr_aspek_pengetahuan[$i];
		}
		//aspek ku
		$arr_aspek_ku = explode(",", $result->pil_aspek_ku);
		for ($i=0; $i < count($arr_aspek_ku); $i++) { 
			$all_pil_aspek_ku[] = $arr_aspek_ku[$i];
		}
		//aspek kk
		$arr_aspek_kk = explode(",", $result->pil_aspek_kk);
		for ($i=0; $i < count($arr_aspek_kk); $i++) { 
			$all_pil_aspek_kk[] = $arr_aspek_kk[$i];
		}

		$data['list_dsn'] = $all_dosen;
		$data['list_pil_asp_sikap'] = $all_pil_aspek_sikap;
		$data['list_pil_asp_pengetahuan'] = $all_pil_aspek_pengetahuan;
		$data['list_pil_asp_ku'] = $all_pil_aspek_ku;
		$data['list_pil_asp_kk'] = $all_pil_aspek_kk;
		$data['dt_head'] = $this->model_rps->get_data_head_rps($id_rps);
		$data['list_aspek_sikap'] = $this->model_rps->get_all_rps_aspek_sikap();
		$data['list_aspek_pengetahuan'] = $this->model_rps->get_all_rps_aspek_pengetahuan();
		$data['list_aspek_ku'] = $this->model_rps->get_all_rps_aspek_ku();
		$data['list_aspek_kk'] = $this->model_rps->get_all_rps_aspek_kk();
		$data['list_cpmk'] = $this->model_rps->get_all_rps_cpmk($id_rps);
		$this->load->view('proses/rps/edit_2', $data);
	}
	public function rubah_capaian_pembelajaran()
	{
		$this->Model_security->get_security();
		$id_head = encrypt_decrypt('decrypt', $this->input->post("id_rps"));
		$data['pil_aspek_sikap'] = $this->input->post("pil_asp_sikap");
		$data['pil_aspek_pengetahuan'] = $this->input->post("pil_asp_pengetahuan");
		$data['pil_aspek_ku'] = $this->input->post("pil_asp_ku");
		$data['pil_aspek_kk'] = $this->input->post("pil_asp_kk");
		$this->model_rps->update_rps_head($id_head, $data);
		echo "Perubahan data capaian pembelajaran program studi (CP-PRODI) berhasil disimpan";
	}
	public function add_capaian_pembelajaran_mk()
	{
		$this->Model_security->get_security();
		$this->_init();
		$id_rps = encrypt_decrypt('decrypt', $this->uri->segment(3));
		$all_dosen = array();
		$result = $this->model_rps->get_data_head_rps($id_rps);
		//dosen pengambpuh
		$arr_dosen = explode(",", $result->id_dosen);
		for ($i=0; $i < count($arr_dosen); $i++) { 
			$all_dosen[] = $this->model_rps->get_profil_dosen($arr_dosen[$i])->nama_dosen;
		}
		
		$data['dt_head'] = $this->model_rps->get_data_head_rps($id_rps);
		$data['list_dsn'] = $all_dosen;
		$data['list_aspek_sikap'] = $this->model_rps->get_all_rps_aspek_sikap();
		$data['list_aspek_pengetahuan'] = $this->model_rps->get_all_rps_aspek_pengetahuan();
		$data['list_aspek_ku'] = $this->model_rps->get_all_rps_aspek_ku();
		$data['list_aspek_kk'] = $this->model_rps->get_all_rps_aspek_kk();
		$data['nom_urut'] = $this->model_rps->get_no_urut_cp_mk($id_rps);
		$data['list_cpmk'] = $this->model_rps->get_all_rps_cpmk($id_rps);
		$this->load->view('proses/rps/add_3', $data);
	}
	public function simpan_capaian_pembelajaran_mk()
	{
		$this->Model_security->get_security();
		$id_head = encrypt_decrypt('decrypt', $this->input->post("id_rps"));
		$data['no_urut'] = $this->input->post("inp_no_urut");
		$data['id_rps'] = $id_head;
		$data['deskripsi'] = $this->input->post("inp_deskripsi");
		$data['unsur_s'] = $this->input->post("pil_asp_sikap");
		$data['unsur_p'] = $this->input->post("pil_asp_pengetahuan");
		$data['unsur_ku'] = $this->input->post("pil_asp_ku");
		$data['unsur_kk'] = $this->input->post("pil_asp_kk");
		$this->model_rps->insert_cpmk($data);
		echo "Data Capaian Pembelajaran Matakuliah (CP-MK) berhasil disimpan.";
	}
	public function edit_cp_mk()
	{
		$this->Model_security->get_security();
		$id_cpmk = $this->uri->segment(3);
		$all_pil_aspek_sikap = array();
		$all_pil_aspek_pengetahuan = array();
		$all_pil_aspek_ku = array();
		$all_pil_aspek_kk = array();
		$result = $this->model_rps->get_profil_rps_cpmk($id_cpmk);
		//aspek sikap
		$arr_aspek_sikap = explode(",", $result->unsur_s);
		for ($i=0; $i < count($arr_aspek_sikap); $i++) { 
			$all_pil_aspek_sikap[] = $arr_aspek_sikap[$i];
		}
		//aspek pengetahuan
		$arr_aspek_pengetahuan = explode(",", $result->unsur_p);
		for ($i=0; $i < count($arr_aspek_pengetahuan); $i++) { 
			$all_pil_aspek_pengetahuan[] = $arr_aspek_pengetahuan[$i];
		}
		//aspek ku
		$arr_aspek_ku = explode(",", $result->unsur_ku);
		for ($i=0; $i < count($arr_aspek_ku); $i++) { 
			$all_pil_aspek_ku[] = $arr_aspek_ku[$i];
		}
		//aspek kk
		$arr_aspek_kk = explode(",", $result->unsur_kk);
		for ($i=0; $i < count($arr_aspek_kk); $i++) { 
			$all_pil_aspek_kk[] = $arr_aspek_kk[$i];
		}

		$data['list_aspek_sikap'] = $this->model_rps->get_all_rps_aspek_sikap();
		$data['list_aspek_pengetahuan'] = $this->model_rps->get_all_rps_aspek_pengetahuan();
		$data['list_aspek_ku'] = $this->model_rps->get_all_rps_aspek_ku();
		$data['list_aspek_kk'] = $this->model_rps->get_all_rps_aspek_kk();
		$data['res_cpmk'] = $this->model_rps->get_profil_rps_cpmk($id_cpmk);
		$data['pil_unsur_s'] = $all_pil_aspek_sikap;
		$data['pil_unsur_p'] = $all_pil_aspek_pengetahuan;
		$data['pil_unsur_ku'] = $all_pil_aspek_ku;
		$data['pil_unsur_kk'] = $all_pil_aspek_kk;
		$this->load->view('proses/rps/edit_2_cpmk', $data);
	}
	public function rubah_cp_mk()
	{
		$this->Model_security->get_security();
		$id_cpmk = $this->input->post("id_cpmk");
		$data['deskripsi'] = $this->input->post("inp_deskripsi");
		$data['unsur_s'] = $this->input->post("pil_u_sikap");
		$data['unsur_p'] = $this->input->post("pil_u_pengetahuan");
		$data['unsur_ku'] = $this->input->post("pil_u_ku");
		$data['unsur_kk'] = $this->input->post("pil_u_kk");
		$this->model_rps->update_cpmk($id_cpmk, $data);
		echo "Perubahan Data Capaian Pembelajaran Matakuliah (CP-MK) berhasil disimpan.";
	}
	public function hapus_cp_mk()
	{
		$this->Model_security->get_security();
		$id_rps = encrypt_decrypt('decrypt', $this->input->post('id_rps'));
		$id_cpmk = $this->input->post("id_data");
		$this->model_rps->delete_cpmk($id_cpmk);
		//refresh nomor urut pertemuan
		$all_cpmk = $this->model_rps->get_all_rps_cpmk($id_rps);
		if(count($all_cpmk)>0)
		{
			$no_urut=1;
			foreach ($all_cpmk as $dt) 
			{
				$key = $dt['id_cpmk'];
				$data['no_urut'] = $no_urut;
				$this->model_rps->update_no_urut_cpmk($key, $id_rps, $data);
				$no_urut++;
			}
		}

		echo "Item capaian pembelajaran matakuliah berhasil dihapus";
	}
	public function add_matriks_pembelajaran()
	{
		$this->Model_security->get_security();
		$this->_init();
		$id_rps = encrypt_decrypt('decrypt', $this->uri->segment(3));
		$all_dosen = array();
		$result = $this->model_rps->get_data_head_rps($id_rps);
		//dosen pengambpuh
		$arr_dosen = explode(",", $result->id_dosen);
		for ($i=0; $i < count($arr_dosen); $i++) { 
			$all_dosen[] = $this->model_rps->get_profil_dosen($arr_dosen[$i])->nama_dosen;
		}
		$data['dt_head'] = $this->model_rps->get_data_head_rps($id_rps);
		$data['list_dsn'] = $all_dosen;
		$data['list_matriks'] = $this->model_rps->get_data_rps_matriks($id_rps);
		$data['no_urut'] = $this->model_rps->get_pertemuan_ke($id_rps);
		$this->load->view('proses/rps/add_4', $data);
	}
	public function simpan_matriks_pembelajaran()
	{
		$this->Model_security->get_security();
		$pil_sub = ($this->input->post('pil_sub_item')=="true")?1:2;
		$id_head_rps = encrypt_decrypt('decrypt', $this->input->post("id_rps"));
		if($pil_sub==1)
		{
			$data['id_rps'] = $id_head_rps;
			$data['sub'] = $pil_sub;
			$data['nama_sub'] = $this->input->post('nama_sub');
			$data['pertemuan_ke'] = $this->input->post('nom_pertemuan');
			$sts_exec = $this->model_rps->insert_rps_matriks_rencana_pembelajaran($data);
		} else {
			$data['id_rps'] = $id_head_rps;
			$data['sub'] = $pil_sub;
			$data['pertemuan_ke'] = $this->input->post('nom_pertemuan');
			$data['capaian_pembelajaran'] = $this->input->post('capaian');
			$data['bahasan_kajian'] = $this->input->post('bahasan');
			$data['metode_pembelajaran'] = $this->input->post('metode');
			$data['indikator_penilaian'] = $this->input->post('indikator_penilaian');
			$data['teknik_penilaian'] = $this->input->post('teknik_penilaian');
			$data['bobot_tagihan'] = $this->input->post('bobot_tagihan');
			$sts_exec = $this->model_rps->insert_rps_matriks_rencana_pembelajaran($data);
		}
		echo $sts_exec;
	}
	public function edit_matriks_pembelajaran()
	{
		$this->Model_security->get_security();
		$this->_init();
		$id_rps = encrypt_decrypt('decrypt', $this->uri->segment(3));
		$all_dosen = array();
		$result = $this->model_rps->get_data_head_rps($id_rps);
		//dosen pengambpuh
		$arr_dosen = explode(",", $result->id_dosen);
		for ($i=0; $i < count($arr_dosen); $i++) { 
			$all_dosen[] = $this->model_rps->get_profil_dosen($arr_dosen[$i])->nama_dosen;
		}
		$data['dt_head'] = $this->model_rps->get_data_head_rps($id_rps);
		$data['list_dsn'] = $all_dosen;
		$data['list_matriks'] = $this->model_rps->get_data_rps_matriks($id_rps);
		$data['no_urut'] = $this->model_rps->get_pertemuan_ke($id_rps);
		$this->load->view('proses/rps/edit_4', $data);
	}
	public function edit_matriks_pembelajaran_baris()
	{
		$id_item_matriks = $this->uri->segment(3);
		$data['dt_matriks'] = $this->model_rps->get_data_rps_matriks_per_baris($id_item_matriks);
		$this->load->view('proses/rps/edit_4_item', $data);

	}
	public function rubah_matriks_pembelajaran_baris()
	{
		$this->Model_security->get_security();
		$pil_sub = ($this->input->post('pil_sub_item')=="true")?1:2;
		$id_rps = encrypt_decrypt('decrypt', $this->input->post("id_rps"));
		$id_matriks = $this->input->post("id_matriks");
		if($pil_sub==1)
		{
			$data['nama_sub'] = $this->input->post('nama_sub');
			$sts_exec = $this->model_rps->update_rps_matriks_rencana_pembelajaran($id_matriks, $id_rps, $data);
		} else {
			$data['capaian_pembelajaran'] = $this->input->post('capaian');
			$data['bahasan_kajian'] = $this->input->post('bahasan');
			$data['metode_pembelajaran'] = $this->input->post('metode');
			$data['indikator_penilaian'] = $this->input->post('indikator_penilaian');
			$data['teknik_penilaian'] = $this->input->post('teknik_penilaian');
			$data['bobot_tagihan'] = $this->input->post('bobot_tagihan');
			$sts_exec = $this->model_rps->update_rps_matriks_rencana_pembelajaran($id_matriks, $id_rps, $data);
		}
		echo $sts_exec;
	}
	public function hapus_matriks_pembelajaran_baris()
	{
		$this->Model_security->get_security();
		$id_rps = encrypt_decrypt('decrypt', $this->input->post("id_rps"));
		$id_matriks = $this->input->post("id_data");
		$this->model_rps->delete_rps_row_matriks($id_rps, $id_matriks);
		$all_matriks = $this->model_rps->get_data_rps_matriks($id_rps);
		if(count($all_matriks)>0)
		{
			$no_urut=1;
			foreach ($all_matriks as $dt) 
			{
				$key = $dt['id_rps_matriks'];
				$data['pertemuan_ke'] = $no_urut;
				$this->model_rps->update_rps_matriks_rencana_pembelajaran($key, $id_rps, $data);
				$no_urut++;
			}
		}
		echo "Item matriks rencana pembelajaran berhasil dihapus";
	}
	public function simpan_matriks_pembelajaran_catatan()
	{
		$this->Model_security->get_security();
		$id_rps = encrypt_decrypt('decrypt', $this->input->post("id_rps"));
		$data['catatan'] = $this->input->post("inp_catatan");
		$this->model_rps->update_rps_head($id_rps, $data);
		echo "Catatan matriks rencana pembelajaran berhasil disimpan.";
	}
	public function detail()
	{
		$this->Model_security->get_security();
		$this->_init();
		$all_dosen = array();
		$all_aspek_sikap = array();
		$all_aspek_pengetahuan = array();
		$all_aspek_ku = array();
		$all_aspek_kk = array();
		$all_referensi = array();
		$kontak_dosen = array();
		$id_rps = encrypt_decrypt('decrypt', $this->uri->segment(3));
		$result = $this->model_rps->get_data_detail_rps($id_rps);
		//dosen pengambpuh
		if(!empty($result->id_dosen)){
			$arr_dosen = explode(",", $result->id_dosen);
			for ($i=0; $i < count($arr_dosen); $i++) { 
				$all_dosen[] = $this->model_rps->get_profil_dosen($arr_dosen[$i])->nama_dosen;
			}
		}
		//aspek sikap
		if(!empty($result->pil_aspek_sikap)){
			$arr_aspek_sikap = explode(",", $result->pil_aspek_sikap);
			for ($i=0; $i < count($arr_aspek_sikap); $i++) { 
				$hasil = $this->model_rps->get_profil_aspek_sikap($arr_aspek_sikap[$i]);
				$all_aspek_sikap[] = array("kode"=>"S-".$hasil->no_urut, "desk"=>$hasil->aspek_sikap);
				//$all_aspek_sikap[] = $hasil->aspek_sikap." (S-".$hasil->no_urut.")";
			}
		}
		//aspek pengetahuan
		if(!empty($result->pil_aspek_pengetahuan)){
			$arr_aspek_pengetahuan = explode(",", $result->pil_aspek_pengetahuan);
			for ($i=0; $i < count($arr_aspek_pengetahuan); $i++) { 
				$hasil = $this->model_rps->get_profil_aspek_pengetahuan($arr_aspek_pengetahuan[$i]);
				$all_aspek_pengetahuan[] = array("kode"=>"P-".$hasil->no_urut, "desk"=>$hasil->aspek_pengetahuan);
				//$all_aspek_pengetahuan[] = $hasil->aspek_pengetahuan." (P-".$hasil->no_urut.")";
			}
		}
		//aspek ku
		if(!empty($result->pil_aspek_ku)){
			$arr_aspek_ku = explode(",", $result->pil_aspek_ku);
			for ($i=0; $i < count($arr_aspek_ku); $i++) { 
				$hasil = $this->model_rps->get_profil_aspek_ku($arr_aspek_ku[$i]);
				$all_aspek_ku[] = array("kode"=>"KU-".$hasil->no_urut, "desk"=>$hasil->keterampilan_umum);
				//$all_aspek_ku[] = $hasil->keterampilan_umum." (KU-".$hasil->no_urut.")";
			}
		}
		//aspek kk
		if(!empty($result->pil_aspek_kk)){
			$arr_aspek_kk = explode(",", $result->pil_aspek_kk);
			for ($i=0; $i < count($arr_aspek_kk); $i++) { 
				$hasil = $this->model_rps->get_profil_aspek_kk($arr_aspek_kk[$i]);
				$all_aspek_kk[] = array("kode"=>"KK-".$hasil->no_urut, "desk"=>$hasil->keterampilan_khusus);
				//$all_aspek_kk[] = $hasil->keterampilan_khusus." (KK-".$hasil->no_urut.")";
			}
		}
		//pilihan referensi
		if(!empty($result->pil_referensi)){
			$arr_referensi = explode(",", $result->pil_referensi);
			for ($i=0; $i < count($arr_referensi); $i++) { 
				$hasil = $this->model_rps->get_profil_referensi($arr_referensi[$i]);
				if($hasil->id_kategori==1)
				{
					$all_referensi[] = $hasil->penulis.", ".$hasil->judul.", ".$hasil->tahun.", ".$hasil->penerbit.", ISBN : ".$hasil->isbn." (Kategori : Buku)";
				} else if($hasil->id_kategori==2)
				{
					$all_referensi[] = $hasil->penulis.", ".$hasil->judul.", ".$hasil->tahun.", ".$hasil->nama_jurnal.", ISSN : ".$hasil->issn." (Kategori : Jurnal)";
				} else {
					$all_referensi[] = $hasil->penulis.", ".$hasil->nama_halaman_web.", ".$hasil->tahun.", ".$hasil->nama_url." (Kategori : Website)";
				}
			}
		}
		//alamat dosen pengambpuh
		$arr_dosen = explode(",", $result->id_dosen);
		for ($i=0; $i < count($arr_dosen); $i++) { 
			$hasil = $this->model_rps->get_profil_dosen($arr_dosen[$i]);
			$kontak_dosen[] = "<b>".$hasil->nama_dosen."</b><br>Alamat : ".$hasil->alamat."<br>No.Tlp/HP : ".$hasil->no_tlp."<br>Email : ".$hasil->email;
		}
		$data['list_dsn'] = $all_dosen;
		$data['list_aspek_sikap'] = $all_aspek_sikap;
		$data['list_aspek_pengetahuan'] = $all_aspek_pengetahuan;
		$data['list_aspek_ku'] = $all_aspek_ku;
		$data['list_aspek_kk'] = $all_aspek_kk;
		$data['list_referensi'] = $all_referensi;
		$data['dt_rps'] = $this->model_rps->get_data_detail_rps($id_rps);
		$data['list_matriks'] = $this->model_rps->get_data_rps_matriks($id_rps);
		$data['list_bobot'] = $this->model_rps->get_data_bobot_penilaian($id_rps);
		$data['kontak_dosen'] = $kontak_dosen;
		$data['list_cpmk'] = $this->model_rps->get_all_rps_cpmk($id_rps);
		$this->load->view('proses/rps/detail', $data);
	}
	public function cetak()
	{
		$all_dosen = array();
		$all_aspek_sikap = array();
		$all_aspek_pengetahuan = array();
		$all_aspek_ku = array();
		$all_aspek_kk = array();
		$all_referensi = array();
		$kontak_dosen = array();
		$id_rps = encrypt_decrypt('decrypt', $this->uri->segment(3));
		$result = $this->model_rps->get_data_detail_rps($id_rps);
		//if(!empty($result->ketua_team))
		//{
		//	$ketua_team = $this->model_rps->get_profil_dosen($result->ketua_team)->row()->nama_dosen;
		//} else {
		//	$ketua_team="";
		//}
		//dosen pengambpuh
		if(!empty($result->id_dosen)){
			$arr_dosen = explode(",", $result->id_dosen);
			for ($i=0; $i < count($arr_dosen); $i++) { 
				$all_dosen[] = $this->model_rps->get_profil_dosen($arr_dosen[$i])->nama_dosen;
			}
		}
		//aspek sikap
		if(!empty($result->pil_aspek_sikap)){
			$arr_aspek_sikap = explode(",", $result->pil_aspek_sikap);
			for ($i=0; $i < count($arr_aspek_sikap); $i++) { 
				$hasil = $this->model_rps->get_profil_aspek_sikap($arr_aspek_sikap[$i]);
				$all_aspek_sikap[] = array("kode"=>"S-".$hasil->no_urut, "desk"=>$hasil->aspek_sikap);
				//$all_aspek_sikap[] = $hasil->aspek_sikap." (S-".$hasil->no_urut.")";
			}
		}
		//aspek pengetahuan
		if(!empty($result->pil_aspek_pengetahuan)){
			$arr_aspek_pengetahuan = explode(",", $result->pil_aspek_pengetahuan);
			for ($i=0; $i < count($arr_aspek_pengetahuan); $i++) { 
				$hasil = $this->model_rps->get_profil_aspek_pengetahuan($arr_aspek_pengetahuan[$i]);
				$all_aspek_pengetahuan[] = array("kode"=>"P-".$hasil->no_urut, "desk"=>$hasil->aspek_pengetahuan);
				//$all_aspek_pengetahuan[] = $hasil->aspek_pengetahuan." (P-".$hasil->no_urut.")";
			}
		}
		//aspek ku
		if(!empty($result->pil_aspek_ku)){
			$arr_aspek_ku = explode(",", $result->pil_aspek_ku);
			for ($i=0; $i < count($arr_aspek_ku); $i++) { 
				$hasil = $this->model_rps->get_profil_aspek_ku($arr_aspek_ku[$i]);
				$all_aspek_ku[] = array("kode"=>"KU-".$hasil->no_urut, "desk"=>$hasil->keterampilan_umum);
				//$all_aspek_ku[] = $hasil->keterampilan_umum." (KU-".$hasil->no_urut.")";
			}
		}
		//aspek kk
		if(!empty($result->pil_aspek_kk)){
			$arr_aspek_kk = explode(",", $result->pil_aspek_kk);
			for ($i=0; $i < count($arr_aspek_kk); $i++) { 
				$hasil = $this->model_rps->get_profil_aspek_kk($arr_aspek_kk[$i]);
				$all_aspek_kk[] = array("kode"=>"KK-".$hasil->no_urut, "desk"=>$hasil->keterampilan_khusus);
				//$all_aspek_kk[] = $hasil->keterampilan_khusus." (KK-".$hasil->no_urut.")";
			}
		}
		//pilihan referensi
		if(!empty($result->pil_referensi)){
			$arr_referensi = explode(",", $result->pil_referensi);
			for ($i=0; $i < count($arr_referensi); $i++) { 
				$hasil = $this->model_rps->get_profil_referensi($arr_referensi[$i]);
				if($hasil->id_kategori==1)
				{
					$all_referensi[] = $hasil->penulis.", ".$hasil->judul.", ".$hasil->tahun.", ".$hasil->penerbit.", ISBN : ".$hasil->isbn." (Kategori : Buku)";
				} else if($hasil->id_kategori==2)
				{
					$all_referensi[] = $hasil->penulis.", ".$hasil->judul.", ".$hasil->tahun.", ".$hasil->nama_jurnal.", ISSN : ".$hasil->issn." (Kategori : Jurnal)";
				} else {
					$all_referensi[] = $hasil->penulis.", ".$hasil->nama_halaman_web.", ".$hasil->tahun.", ".$hasil->nama_url." (Kategori : Website)";
				}
			}
		}
		//alamat dosen pengambpuh
		$arr_dosen = explode(",", $result->id_dosen);
		for ($i=0; $i < count($arr_dosen); $i++) { 
			$hasil = $this->model_rps->get_profil_dosen($arr_dosen[$i]);
			$kontak_dosen[] = "<b>".$hasil->nama_dosen."</b><br>Alamat : ".$hasil->alamat."<br>No.Tlp/HP : ".$hasil->no_tlp."<br>Email : ".$hasil->email;
		}
		$data['list_dsn'] = $all_dosen;
		$data['list_aspek_sikap'] = $all_aspek_sikap;
		$data['list_aspek_pengetahuan'] = $all_aspek_pengetahuan;
		$data['list_aspek_ku'] = $all_aspek_ku;
		$data['list_aspek_kk'] = $all_aspek_kk;
		$data['list_referensi'] = $all_referensi;
		$data['dt_rps'] = $this->model_rps->get_data_detail_rps($id_rps);
		$data['list_matriks'] = $this->model_rps->get_data_rps_matriks($id_rps);
		$data['list_bobot'] = $this->model_rps->get_data_bobot_penilaian($id_rps);
		$data['kontak_dosen'] = $kontak_dosen;
		$data['list_cpmk'] = $this->model_rps->get_all_rps_cpmk($id_rps);
		$this->output->unset_template();
		$html = $this->load->view('proses/rps/print',$data,TRUE);
		$pdfFilePath = "output_rps.pdf";
		// setingan kertas margin,dll
		$this->m_pdf->pdf->AddPage('L','Legal', 0, '', 10, 20, 15, 15, 10, 10);
		//$this->m_pdf->pdf->AddPage('utf-8','Legal', 0, '', 10, 10, 15, 10, 9, 9, 'L');
        $this->m_pdf->pdf->WriteHTML($html);
		//$this->m_pdf->pdf->Output($pdfFilePath, "D");
		$this->m_pdf->pdf->Output();
	}
	//Rubah Status RPS
	public function edit_status_rps()
	{
		$this->Model_security->get_security();
		$id_rps = encrypt_decrypt('decrypt', $this->uri->segment(3));
		$result = $this->model_rps->get_data_head_rps($id_rps);
		$data['res'] = $result;
		$this->load->view('proses/rps/edit_status', $data);
	}
	public function rubah_status_rps()
	{
		$this->Model_security->get_security();
		$id_rps = $this->input->post('id_tabel');
		$data['status_rps'] = $this->input->post('pil_status_publikasi');
		$this->model_rps->update_rps_head($id_rps, $data);
		$this->session->set_flashdata("konfirm", "Status publikasi RPS berhasil dirubah");
		redirect("rps");
	}
	//Create Team Teaching
	public function team_teaching()
	{
		$this->Model_security->get_security();
		$this->_init();
		$data['list_ps'] = $this->model_rps->get_master_prodi();
		$data['list_rps'] = $this->model_rps->get_all_rps();
		$data['list_dosen'] = $this->model_rps->get_all_dosen();
		$this->load->view('proses/rps/team_teaching/index', $data);
	}
	public function team_teaching_cek_matkul_proses()
	{
		$tahun_kurikulum = $this->input->post("pil_tahun");
		$prodi = $this->input->post("pil_prodi");
		$matkul = $this->input->post("pil_mk");
		$result = $this->model_rps->cek_matakuliah_rps($tahun_kurikulum, $prodi, $matkul);
		if(count($result)>=1)
		{
			$pesan = 1; //true
		} else {
			$pesan = 2; //false
		}
		echo $pesan;
	}
	public function team_teaching_simpan()
	{
		$this->Model_security->get_security();
		$data['tahun'] = $this->input->post("pil_tahun");
		$data['id_prodi'] = $this->input->post("pil_ps");
		$data['id_matkul'] = $this->input->post("pil_matkul");
		$data['ketua_team'] = $this->input->post("pil_ketua_team");
		$data['id_dosen'] = join(",", $this->input->post("pil_anggota_team"));
		$data['status_rps'] = 1; //Belum Terpublikasi
		$data['tgl_post'] = date("Y-m-d");
		$this->model_rps->insert_rps_identitas_desk($data);
		$this->session->set_flashdata("konfirm", "Penyusunan team teaching rps telah disimpan");
		redirect("rps/team_teaching");
	}
	public function team_teaching_edit()
	{
		$this->Model_security->get_security();
		$id_rps = encrypt_decrypt('decrypt', $this->uri->segment(3));
		$res = $this->model_rps->get_data_head_rps($id_rps);
		$data['list_ps'] = $this->model_rps->get_master_prodi();
		$data['list_rps'] = $this->model_rps->get_all_rps();
		$data['list_dosen'] = $this->model_rps->get_all_dosen();
		$data['list_mk'] = $this->model_rps->get_all_matakuliah_perprodi($res->id_prodi);
		$data['dt_rps'] = $this->model_rps->get_data_head_rps($id_rps);
		$this->load->view('proses/rps/team_teaching/edit', $data);
	}
	public function team_teaching_rubah()
	{
		$this->Model_security->get_security();
		$id_rps = $this->input->post('id_tabel');
		$data['ketua_team'] = $this->input->post("pil_ketua_team");
		$data['id_dosen'] = join(",", $this->input->post("pil_anggota_team"));
		$this->model_rps->update_rps_head($id_rps, $data);
		$this->session->set_flashdata("konfirm", "Perubahan data team teaching rps telah disimpan");
		redirect("rps/team_teaching");
	}
}