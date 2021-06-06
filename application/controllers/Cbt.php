<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cbt extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('model_akademik', 'model_dosen', 'model_opsi', 'model_cbt'));
		date_default_timezone_set("Asia/Makassar");
	}
	function _init()
	{
		$this->output->set_template('index');
	}
    //buat soal baru
    public function buat_soal()
    {
        $this->Model_security->get_security();
		$this->_init();
        $data['mst_prodi'] = $this->model_opsi->get_master_prodi();
		$data['list_dosen'] = $this->model_dosen->get_dsn_all();
		$this->load->view('proses/cbt/buat_soal/index', $data);
    }
	public function tampilkan_matkul_per_prodi()
	{
		$id_prodi = $this->uri->segment(3);
		$res_matkul = $this->model_akademik->get_matakuliah_per_prodi($id_prodi);
		echo "<option></option>";
		foreach($res_matkul as $list) {
			echo "<option value=".$list['id_matakuliah'].">".$list['kode_matakuliah']." | ".$list['nama_matakuliah']."</option>";
		}
	}
	public function tampilkan_soal_per_matakuliah()
	{
		$id_matkul = $this->input->post("id_mk");
		$res['list_soal'] = $this->model_cbt->get_soal_per_matakuliah($id_matkul);
		$this->load->view("proses/cbt/buat_soal/list_soal_per_matkul", $res);
	}
	public function cek_kode_soal()
    {
        $kode = $this->input->post("kode");
        $result = $this->model_cbt->get_kode_soal($kode);
        echo $result;
    }
	public function simpan_soal_head()
	{
		$this->Model_security->get_security();
		$data['id_prodi'] = $this->input->post('pil_ps');
		$data['id_matakuliah'] = $this->input->post('pil_matkul');
		$data['team_dosen'] = join(",", $this->input->post('pil_dosen'));
		$data['kode_soal'] = $this->input->post('inp_kode_soal');
		$data['aktif'] = 1;
		$data['tanggal_post'] = date("Y-m-d");
		$id_h = $this->model_cbt->insert_soal_head($data);
		$this->session->set_flashdata('info', "Data tahap awal berhasil disimpan. Silahkan lanjutkan tahap kedua yaitu pembuatan soal.");
		redirect('cbt/tambah_soal/'.encrypt_decrypt('encrypt', $id_h));
	}
	
	public function tambah_soal()
	{
		$this->Model_security->get_security();
		$this->_init();
		$id_h = encrypt_decrypt('decrypt', $this->uri->segment(3));
		$res = $this->model_cbt->get_head_soal($id_h);
		if(empty($res->id)) {
			redirect("cbt/buat_soal");
		} else {
			$data["dt_h"] = $this->model_cbt->get_head_soal($id_h);
			$this->load->view('proses/cbt/buat_soal/add_soal_2', $data);
		}
	}
	public function simpan_data()
	{
		$sts_simpan="";
		$kat_soal_gambar = "";
		$pesan_err = "";
		$id_head = encrypt_decrypt('decrypt', $this->input->post('id_soal'));
		if($this->input->post('pil_soal_gbr')=='on')
		{
			$nm_fl_soal = $id_head."-".time().date('dmY');
			if(empty($_FILES['soal_gambar']['name']))
			{
				$pesan_err = "File Soal Gambar Tidak Boleh Kosong!";
				$sts_simpan=2;
			}
			else
			{
				$fl_1 = $this->upload_file_soal($nm_fl_soal, "head", "soal_gambar");
				if ($fl_1 != false) 
				{
					$fl_soal = $fl_1;
					$kat_soal_gambar=1;
					$sts_simpan=1;
				}
				else
				{
					$pesan_err = "Proses Upload File Gambar Soal Gagal Disimpan. Tipe File salah";
					$sts_simpan=2;
				}
			}
		}
		else
		{
			$fl_soal="";
			$sts_simpan=1;
			$kat_soal_gambar=2;
		}
		if($this->input->post('j_a')==1)
		{
			$fl_pil_a="";
			$sts_simpan=1;
		}
		else
		{
			$nm_fl_a = $id_head."-a-".time().date('dmY');
			if(empty($_FILES['file_a']['name']))
			{
				$pesan_err = "File Pilihan Jawaban (a) Tidak Boleh Kosong!";
				$sts_simpan=2;
			}
			else
			{
				$fl_a = $this->upload_file_soal($nm_fl_a, "detail", "file_a");
				if ($fl_a != false) 
				{
					$fl_pil_a = $fl_a;
					$sts_simpan=1;
				}
				else
				{
					$pesan_err = "Proses Upload File Pilihan Jawaban (a) Gagal Disimpan. Tipe File salah";
					$sts_simpan=2;
				}
			}	
		}
		if($this->input->post('j_b')==1)
		{
			$fl_pil_b="";
			$sts_simpan=1;
		}
		else
		{
			$nm_fl_b = $id_head."-b-".time().date('dmY');
			if(empty($_FILES['file_b']['name']))
			{
				$pesan_err = "File Pilihan Jawaban (b) Tidak Boleh Kosong!";
				$sts_simpan=2;
			}
			else
			{
				$fl_b = $this->upload_file_soal($nm_fl_b, "detail", "file_b");
				if ($fl_b != false) 
				{
					$fl_pil_b = $fl_b;
					$sts_simpan=1;
				}
				else
				{
					$pesan_err = "Proses Upload File Pilihan Jawaban (b) Gagal Disimpan. Tipe File salah";
					$sts_simpan=2;
				}
			}	
		}
		if($this->input->post('j_c')==1)
		{
			$fl_pil_c="";
			$sts_simpan=1;
		}
		else
		{
			$nm_fl_c = $id_head."-c-".time().date('dmY');
			if(empty($_FILES['file_c']['name']))
			{
				$pesan_err = "File Pilihan Jawaban (c) Tidak Boleh Kosong!";
				$sts_simpan=2;
			}
			else
			{
				$fl_c = $this->upload_file_soal($nm_fl_c, "detail", "file_c");
				if ($fl_c != false) 
				{
					$fl_pil_c = $fl_c;
					$sts_simpan=1;
				}
				else
				{
					$pesan_err = "Proses Upload File Pilihan Jawaban (c) Gagal Disimpan. Tipe File salah";
					$sts_simpan=2;
				}
			}	
		}
		if($this->input->post('j_d')==1)
		{
			$fl_pil_d="";
			$sts_simpan=1;
		}
		else
		{
			$nm_fl_d = $id_head."-d-".time().date('dmY');
			if(empty($_FILES['file_d']['name']))
			{
				$pesan_err = "File Pilihan Jawaban (d) Tidak Boleh Kosong!";
				$sts_simpan=2;
			}
			else
			{
				$fl_d = $this->upload_file_soal($nm_fl_d, "detail", "file_d");
				if ($fl_d != false) 
				{
					$fl_pil_d = $fl_d;
					$sts_simpan=1;
				}
				else
				{
					$pesan_err = "Proses Upload File Pilihan Jawaban (d) Gagal Disimpan. Tipe File salah";
					$sts_simpan=2;
				}
			}	
		}
		if($sts_simpan==1)
		{
			$detail['id_head'] = $id_head;
			$detail['kat_soal'] = 1;
			$detail['soal_teks'] = $this->input->post('v_isi_soal');
			$detail['kat_gambar'] = $kat_soal_gambar;
			$detail['soal_gambar'] = $fl_soal;
			$detail['jawaban'] = $this->input->post('jawaban');
			$detail['s_a'] = $this->input->post('j_a');
			$detail['s_b'] = $this->input->post('j_b');
			$detail['s_c'] = $this->input->post('j_c');
			$detail['s_d'] = $this->input->post('j_d');
			$detail['a_1'] = $this->input->post('v_isi_pil_a');
			$detail['a_2'] = $fl_pil_a;
			$detail['b_1'] = $this->input->post('v_isi_pil_b');
			$detail['b_2'] = $fl_pil_b;
			$detail['c_1'] = $this->input->post('v_isi_pil_c');
			$detail['c_2'] = $fl_pil_c;
			$detail['d_1'] = $this->input->post('v_isi_pil_d');
			$detail['d_2'] = $fl_pil_d;
			$this->model_cbt->insert_detail($detail);
			$pesan = "Data Telah Disimpan. Lanjutkan penginputan soal berikutnya";
			$err=1;
		}
		else
		{
			$pesan = $pesan_err;
			$err=2;			
		}
		echo $pesan."-".$err;
	}
	public function edit_soal_detail()
	{
		$this->Model_security->get_security();
		$id_d = encrypt_decrypt('decrypt', $this->uri->segment(3));
		$res = $this->model_cbt->get_detail_soal_row($id_d);
		if(empty($res->id)) {
			redirect("cbt/buat_soal");
		} else {
			$this->_init();
			$data["dt_h"] = $this->model_cbt->get_head_soal($res->id_head);
			$data['res'] = $res;
			$this->load->view("proses/cbt/buat_soal/edit_soal", $data);
		}
	}
	public function rubah_soal_detail()
	{
		$sts_simpan="";
		$kat_soal_gambar = "";
		$pesan_err = "";
		$id_head = encrypt_decrypt('decrypt', $this->input->post('id_soal'));
		$id_detail = $this->input->post('id_detail');
		if($this->input->post('pil_soal_gbr')=='on')
		{
			$nm_fl_soal = $id_head."-".time().date('dmY');
			if(empty($_FILES['soal_gambar']['name']))
			{
				if(empty($this->input->post('file_soal_gbr')))
				{
					$pesan_err = "File Soal Gambar Tidak Boleh Kosong!";
					$sts_simpan=2;
				}
				else
				{
					$fl_soal = $this->input->post('file_soal_gbr');
					$kat_soal_gambar=1;
					$sts_simpan=1;	
				}
			}
			else
			{
				$fl_1 = $this->upload_file_soal($nm_fl_soal, "head", "soal_gambar");
				if ($fl_1 != false) 
				{
					$fl_soal = $fl_1;
					$kat_soal_gambar=1;
					$sts_simpan=1;

				}
				else
				{
					$pesan_err = "Proses Upload File Gambar Soal Gagal Disimpan. Tipe File salah";
					$sts_simpan=2;
				}
			}
		}
		else
		{
			$fl_soal="";
			$sts_simpan=1;
			$kat_soal_gambar=2;
		}
		if($this->input->post('j_a')==1)
		{
			$fl_pil_a="";
			$sts_simpan=1;
		}
		else
		{
			$nm_fl_a = $id_head."-a-".time().date('dmY');
			if(empty($_FILES['file_a']['name']))
			{
				if(empty($this->input->post('file_pil_gbr_a')))
				{
					$pesan_err = "File Pilihan Jawaban (a) Tidak Boleh Kosong!";
					$sts_simpan=2;
				}
				else
				{
					$fl_pil_a = $this->input->post('file_pil_gbr_a');
					$sts_simpan=1;
				}
			}
			else
			{
				$fl_a = $this->upload_file_soal($nm_fl_a, "detail", "file_b");
				if ($fl_a != false) 
				{
					$fl_pil_a = $fl_a;
					$sts_simpan=1;
				}
				else
				{
					$pesan_err = "Proses Upload File Pilihan Jawaban (a) Gagal Disimpan. Tipe File salah";
					$sts_simpan=2;
				}
			}	
		}
		if($this->input->post('j_b')==1)
		{
			$fl_pil_b="";
			$sts_simpan=1;
		}
		else
		{
			$nm_fl_b = $id_head."-b-".time().date('dmY');
			if(empty($_FILES['file_b']['name']))
			{
				if(empty($this->input->post('file_pil_gbr_b')))
				{
					$pesan_err = "File Pilihan Jawaban (b) Tidak Boleh Kosong!";
					$sts_simpan=2;
				}
				else
				{
					$fl_pil_b = $this->input->post('file_pil_gbr_b');
					$sts_simpan=1;
				}
			}
			else
			{
				$fl_b = $this->upload_file_soal($nm_fl_b, "detail", "file_b");
				if ($fl_b != false) 
				{
					$fl_pil_b = $fl_b;
					$sts_simpan=1;
				}
				else
				{
					$pesan_err = "Proses Upload File Pilihan Jawaban (b) Gagal Disimpan. Tipe File salah";
					$sts_simpan=2;
				}
			}	
		}
		if($this->input->post('j_c')==1)
		{
			$fl_pil_c="";
			$sts_simpan=1;
		}
		else
		{
			$nm_fl_c = $id_head."-c-".time().date('dmY');
			if(empty($_FILES['file_c']['name']))
			{
				if(empty($this->input->post('file_pil_gbr_c')))
				{
					$pesan_err = "File Pilihan Jawaban (c) Tidak Boleh Kosong!";
					$sts_simpan=2;
				}
				else
				{
					$fl_pil_c = $this->input->post('file_pil_gbr_c');
					$sts_simpan=1;
				}
			}
			else
			{
				$fl_c = $this->upload_file_soal($nm_fl_c, "detail", "file_c");
				if ($fl_c != false) 
				{
					$fl_pil_c = $fl_c;
					$sts_simpan=1;
				}
				else
				{
					$pesan_err = "Proses Upload File Pilihan Jawaban (c) Gagal Disimpan. Tipe File salah";
					$sts_simpan=2;
				}
			}	
		}
		if($this->input->post('j_d')==1)
		{
			$fl_pil_d="";
			$sts_simpan=1;
		}
		else
		{
			$nm_fl_d = $id_head."-d-".time().date('dmY');
			if(empty($_FILES['file_d']['name']))
			{
				if(empty($this->input->post('file_pil_gbr_d')))
				{
					$pesan_err = "File Pilihan Jawaban (d) Tidak Boleh Kosong!";
					$sts_simpan=2;
				}
				else
				{
					$fl_pil_d = $this->input->post('file_pil_gbr_d');
					$sts_simpan=1;
				}
			}
			else
			{
				$fl_d = $this->upload_file_soal($nm_fl_d, "detail", "file_d");
				if ($fl_d != false) 
				{
					$fl_pil_d = $fl_d;
					$sts_simpan=1;
				}
				else
				{
					$pesan_err = "Proses Upload File Pilihan Jawaban (d) Gagal Disimpan. Tipe File salah";
					$sts_simpan=2;
				}
			}	
		}
		if($sts_simpan==1)
		{
			$key = $id_detail;
			//$detail['id_head'] = $id_head;
			//$detail['kat_soal'] = 1;
			$detail['soal_teks'] = $this->input->post('v_isi_soal');
			$detail['kat_gambar'] = $kat_soal_gambar;
			$detail['soal_gambar'] = $fl_soal;
			$detail['jawaban'] = $this->input->post('jawaban');
			$detail['s_a'] = $this->input->post('j_a');
			$detail['s_b'] = $this->input->post('j_b');
			$detail['s_c'] = $this->input->post('j_c');
			$detail['s_d'] = $this->input->post('j_d');

			if($this->input->post('j_a')==1)
			{
				$detail['a_1'] = $this->input->post('v_isi_pil_a');
				$detail['a_2'] = $fl_pil_a;
			}
			else
			{
				$detail['a_1'] = "";
				$detail['a_2'] = $fl_pil_a;
			}
			if($this->input->post('j_b')==1)
			{
				$detail['b_1'] = $this->input->post('v_isi_pil_b');
				$detail['b_2'] = $fl_pil_b;
			}
			else
			{
				$detail['b_1'] = "";
				$detail['b_2'] = $fl_pil_b;
			}
			if($this->input->post('j_c')==1)
			{
				$detail['c_1'] = $this->input->post('v_isi_pil_c');
				$detail['c_2'] = $fl_pil_c;
			}
			else
			{
				$detail['c_1'] = "";
				$detail['c_2'] = $fl_pil_c;
			}

			if($this->input->post('j_d')==1)
			{
				$detail['d_1'] = $this->input->post('v_isi_pil_d');
				$detail['d_2'] = $fl_pil_d;
			}
			else
			{
				$detail['d_1'] = "";
				$detail['d_2'] = $fl_pil_d;
			}
			//hapus file sebelumnya
			if(!empty($this->input->post('file_soal_gbr')) && $kat_soal_gambar==1 && !empty($_FILES['soal_gambar']['name']) || !empty($this->input->post('file_soal_gbr')) && $kat_soal_gambar=2 && !empty($_FILES['soal_gambar']['name']))
			{
				$this->model_cbt->remove_file_soal($key, 'head', 'soal_gambar');
			}

			if(!empty($this->input->post('file_pil_gbr_a')) && $this->input->post('j_a')==1 || !empty($this->input->post('file_pil_gbr_a')) && $this->input->post('j_a')==2 && !empty($_FILES['file_a']['name']))
			{
				$this->model_cbt->remove_file_soal($key, 'detail', 'a_2');
			}
			if(!empty($this->input->post('file_pil_gbr_b')) && $this->input->post('j_b')==1 || !empty($this->input->post('file_pil_gbr_b')) && $this->input->post('j_b')==2 && !empty($_FILES['file_b']['name']))
			{
				$this->model_cbt->remove_file_soal($key, 'detail', 'b_2');
			}
			if(!empty($this->input->post('file_pil_gbr_c')) && $this->input->post('j_c')==1 || !empty($this->input->post('file_pil_gbr_c')) && $this->input->post('j_c')==2 && !empty($_FILES['file_c']['name']))
			{
				$this->model_cbt->remove_file_soal($key, 'detail', 'c_2');
			}
			if(!empty($this->input->post('file_pil_gbr_d')) && $this->input->post('j_d')==1 || !empty($this->input->post('file_pil_gbr_d')) && $this->input->post('j_d')==2 && !empty($_FILES['file_d']['name']))
			{
				$this->model_cbt->remove_file_soal($key, 'detail', 'd_2');
			}
			$this->model_cbt->update_detail($key, $detail);
			$pesan = "Perubahan Data Soal Telah Disimpan.";
			$err=1;
		}
		else
		{
			$pesan = $pesan_err;
			$err=2;			
		}
		echo $pesan."-".$err;
	}
	public function hapus_soal_detail()
	{
		$this->Model_security->get_security();
		$id_d = encrypt_decrypt('decrypt', $this->uri->segment(3));
		$res = $this->model_cbt->get_detail_soal_row($id_d);
		if(empty($res->id)) {
			redirect("cbt/buat_soal");
		} else {
			$id_head = encrypt_decrypt('encrypt', $res->id_head);
			if($res->kat_gambar==1)
			{
				$this->model_cbt->remove_file_soal($id_d, 'head', 'soal_gambar');
			}
			if($res->s_a==2)
			{
				$this->model_cbt->remove_file_soal($id_d, 'detail', 'a_2');	
			}
			if($res->s_b==2)
			{
				$this->model_cbt->remove_file_soal($id_d, 'detail', 'b_2');	
			}
			if($res->s_c==2)
			{
				$this->model_cbt->remove_file_soal($id_d, 'detail', 'c_2');	
			}
			if($res->s_d==2)
			{
				$this->model_cbt->remove_file_soal($id_d, 'detail', 'd_2');	
			}

			$this->model_cbt->delete_detail_soal($id_d);
			$this->session->set_flashdata('info', "Detail Soal berhasil dihapus");
			redirect("cbt/daftar_soal/".$id_head);
		}
	}
	public function daftar_soal()
	{
		$this->Model_security->get_security();
		$this->_init();
		$id_h = encrypt_decrypt('decrypt', $this->uri->segment(3));
		$res = $this->model_cbt->get_head_soal($id_h);
		if(empty($res->id)) {
			redirect("cbt/buat_soal");
		} else {
			$data["dt_h"] = $this->model_cbt->get_head_soal($id_h);
			$data['dt_d'] = $this->model_cbt->get_detail_soal($id_h);
			$this->load->view('proses/cbt/buat_soal/list_soal', $data);
		}
	}
	function upload_file_soal($nm_file, $folder, $el_name)
	{
		$config['upload_path'] = 'assets/upload/cbt/'.$folder;
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['file_name'] = $nm_file;
		$config['remove_spaces'] = TRUE;
        $config['overwrite'] = TRUE;
	    $filename = $config['file_name'];

		$this->load->library('upload');
	    $this->upload->initialize($config);

	    if ( ! $this->upload->do_upload($el_name))
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
    //bank soal
    public function bank_soal()
    {
        $this->Model_security->get_security();
		$this->_init();
        $data['mst_prodi'] = $this->model_opsi->get_master_prodi();
		$data['head_soal'] = $this->model_cbt->get_all_head_soal();
		$this->load->view('proses/cbt/bank_soal/index', $data);
    }
	public function bank_soal_detail()
	{
		$this->Model_security->get_security();
		$this->_init();
		$id_h = encrypt_decrypt('decrypt', $this->uri->segment(3));
		$res = $this->model_cbt->get_head_soal($id_h);
		if(empty($res->id)) {
			redirect("cbt/bank_soal");
		} else {
			$data["dt_h"] = $this->model_cbt->get_head_soal($id_h);
			$data['dt_d'] = $this->model_cbt->get_detail_soal($id_h);
			$this->load->view('proses/cbt/bank_soal/detail_soal', $data);
		}
	}
	//jadwal ujian
	public function buat_jadwal_baru()
	{
		$this->Model_security->get_security();
		$this->_init();
		$data['mst_prodi'] = $this->model_opsi->get_master_prodi();
		$data['head_soal'] = $this->model_cbt->get_all_head_soal();
		$data['mst_ta'] = $this->model_opsi->get_master_thn_akademik();
		$data['kode_ujian'] = struuid(false);
		$this->load->view('proses/cbt/jadwal_ujian/baru/index', $data);
	}
	public function tampilkan_soal_per_prodi_jadwal()
	{
		$id_prodi = $this->input->post("id_prodi");
		$res_soal = $this->model_cbt->get_soal_per_prodi($id_prodi);
		$html_v = "<option></option>";
		foreach($res_soal as $list_soal) {
			$html_v .= "<option value=".$list_soal['id'].">".$list_soal['kode_soal']." | ".$list_soal['nama_matakuliah']."</option>";
		}
		echo $html_v;
	}
	public function tampilkan_team_penyusun_soal_jadwal()
	{
		$id_soal = $this->input->post("id_soal");
		$res_data = $this->model_cbt->get_head_soal($id_soal);
		$arr_dosen = explode(",", $res_data->team_dosen);
		for ($i=0; $i < count($arr_dosen); $i++) 
		{ 
			$all_dosen[] = $this->model_dosen->get_profil_dosen($arr_dosen[$i])->nama_dosen;
		}
		$nom=1;
		$team="";
		foreach ($all_dosen as $key => $value) {
			$team .= $nom.". ".$value."<br>";
			$nom++;
		}
		unset($all_dosen);
		echo $team;
	}
	public function simpan_jadwal()
	{
		$data['kode_ujian'] = $this->input->post("inp_kode_ujian");
		$data['id_ta'] = $this->input->post("pil_ta");
		$data['id_prodi'] = $this->input->post("pil_ps");
		$data['id_soal'] = $this->input->post("pil_soal");
		$arr_tgl = explode("/", $this->input->post('inp_tanggal'));
		$data['tanggal_ujian'] =  $arr_tgl[2]."-".$arr_tgl[1]."-".$arr_tgl[0];
		$data['jam_ujian'] = $this->input->post("inp_jam");
		$data['lama_pengerjaan'] = $this->input->post("inp_lama_pengerjaan");
		$data['range_a_1'] = $this->input->post("a_1");
		$data['range_a_2'] = $this->input->post("a_2");
		$data['range_b_1'] = $this->input->post("b_1");
		$data['range_b_2'] = $this->input->post("b_2");
		$data['range_c_1'] = $this->input->post("c_1");
		$data['range_c_2'] = $this->input->post("c_2");
		$data['range_d_1'] = $this->input->post("d_1");
		$data['range_d_2'] = $this->input->post("d_2");
		$data['status'] = 1; //jadwal aktif
		$this->model_cbt->insert_jadwal($data);
		$this->session->set_flashdata('info', "Jadwal Ujian berhasil disimpan");
		redirect("cbt/buat_jadwal_baru");
	}
	public function jadwal_ujian()
	{
		$this->Model_security->get_security();
		$this->_init();
		$data['list_jadwal'] = $this->model_cbt->get_jadwal_ujian_all();
		$this->load->view('proses/cbt/jadwal_ujian/daftar/index', $data);
	}
	public function jadwal_ujian_detail()
	{
		$this->Model_security->get_security();
		$this->_init();
		$id_h = encrypt_decrypt('decrypt', $this->uri->segment(3));
		$data['head_jadwal'] = $this->model_cbt->get_head_jadwal_ujian($id_h);
		$this->load->view('proses/cbt/jadwal_ujian/daftar/detail', $data);
	}
	public function tambah_peserta()
	{
		$id_jadwal = $this->input->post("id_jadwal");
		$res_head = $this->model_cbt->get_head_jadwal_ujian($id_jadwal);
		$data['head_jadwal'] = $res_head;
		$data['list_mahasiswa'] = $this->model_akademik->get_mahasiswa_filter($res_head->id_ta, $res_head->id_prodi);
		$this->load->view("proses/cbt/jadwal_ujian/peserta/add_peserta", $data);
	}
}