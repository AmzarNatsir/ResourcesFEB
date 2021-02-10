<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Kuesioner extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Model_kuesioner', 'Model_tmp_kuesioner'));
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
		$data['list'] = $this->Model_tmp_kuesioner->get_all_kuesioner();
		$this->load->view('proses/home_page/kuesioner/index', $data);
	}
	function baru()
	{
		$this->Model_security->get_security();
		$this->_init();
		$data['list_kat_kue'] = $this->Model_tmp_kuesioner->get_all_kat_kue();
		$this->load->view('proses/home_page/kuesioner/add', $data);
	}
	function simpan_kue_h()
	{
		$this->Model_security->get_security();
		if($this->input->post("check_subtema")=="on")
		{
			$sts_subtema=2;
		} else {
			$sts_subtema=1;
		}
		$nom=1;
		foreach ($this->input->post("pil_display") as $key => $value) 
		{
			if($nom==1)
			{
				$temp_pil_displ = $value;
			} else {
				$temp_pil_displ = $temp_pil_displ.",".$value;
			}
			$nom++;
		}
		$data['tgl_posting'] = date("Y-m-d");
		$data['id_user'] = 1; //admin
		$data['kat_kue'] = $this->input->post("pil_kriteria_kuesioner");
		$data['jenis_kue'] = 1;
		$data['jenis_kuesioner'] = $this->input->post("pil_jenis_kuesioner");
		$data['jumlah_pilihan'] = $this->input->post("pil_jumlah_pilihan");
		$data['sub_tema'] = $sts_subtema;
		$s_tgl_1 = explode("/", $this->input->post("tgl_start"));
		$data['tgl_start'] = $s_tgl_1[2]."-".$s_tgl_1[1]."-".$s_tgl_1[0];
		$s_tgl_2 = explode("/", $this->input->post("tgl_end"));
		$data['tgl_end'] = $s_tgl_2[2]."-".$s_tgl_2[1]."-".$s_tgl_2[0];;
		$data['tema_kue'] = $this->input->post("tema_kuesioner");
		$data['ket_kue_awal'] = $this->input->post("ket_kuesioner_awal");
		$data['ket_kue_akhir'] = $this->input->post("ket_kuesioner_akhir");
		$data['display'] = $temp_pil_displ;
		$data['status'] = 3; //status belum aktif
		$id_h = $this->Model_tmp_kuesioner->insert_kuesioner_h($data);
		if($sts_subtema==2)
		{
			foreach($this->input->post('subtema_kuesioner') as $key => $val){
				$data_sub['idh'] = $id_h;
				$data_sub['sub_tema'] = $this->input->post('subtema_kuesioner')[$key];
                $this->Model_tmp_kuesioner->insert_kuesioner_subtema($data_sub);
            }
		}
		$this->session->set_flashdata('info', "Data header kuesioner berhasil disimpan");
		redirect("kuesioner/pertanyaan/".encrypt_decrypt('encrypt', $id_h));
	}
	function pertanyaan()
	{
		$this->Model_security->get_security();
		$this->_init();
		if(empty($this->uri->segment(3)))
		{
			redirect('kuesioner','refresh');
		} else {
			$id_head = encrypt_decrypt('decrypt', $this->uri->segment(3));
			$data['dt_hk'] = $this->Model_tmp_kuesioner->get_data_kuesioner_h($id_head);
			$data['dt_dk'] = $this->Model_tmp_kuesioner->get_data_kuesioner_d($id_head);
			if($this->Model_tmp_kuesioner->get_data_kuesioner_h($id_head)->sub_tema==1)
			{
				$this->load->view('proses/home_page/kuesioner/add_pertanyaan_1', $data);
			} else {
				$data['list_subtema'] = $this->Model_tmp_kuesioner->get_data_kuesioner_sub_tema($id_head);
				$this->load->view('proses/home_page/kuesioner/add_pertanyaan_2', $data);
			}
		}
	}
	function pertanyaan_subtema()
	{
		$this->Model_security->get_security();
		if(empty($this->uri->segment(3)))
		{
			redirect('kuesioner','refresh');
		} else {
			$id_subtema = $this->uri->segment(3);
			$data['dt_subtema'] = $this->Model_tmp_kuesioner->get_data_pertanyaan_subtema_row($id_subtema);
			//$data['dt_dk'] = $this->Model_tmp_kuesioner->get_data_kuesioner_d($id_head);
			$this->load->view('proses/home_page/kuesioner/add_pertanyaan_3', $data);
		}
	}
	function simpan_kue_d()
	{
		$id_h = $this->input->post("id_head");
		$jenis_kuesioner_head = $this->input->post("pil_jenis_kue_head");
		$kriteria_kue = $this->input->post("pil_kriteria_kue");
		if($jenis_kuesioner_head==1)
		{
			$jml_pilihan = $this->input->post("jumlah_pil_head");
			$jenis_kuesioner_detail = "1";
		} 
		else if ($jenis_kuesioner_head==2)
		{
			$jml_pilihan = "0";
			$jenis_kuesioner_detail = "2";
		} else {
			$jenis_kuesioner_detail = $this->input->post("pil_jenis_kuesioner");
			$jml_pilihan = $this->input->post("pil_jumlah_pilihan");
		}
		if($this->input->post("sub_tema")==1)
		{
			$id_sub_tema = 0;
		} else {
			$id_sub_tema = $this->input->post("id_subtema");
		}
		if ($jenis_kuesioner_head==2)
		{
			$data['idh'] = $id_h;
			$data['pertanyaan'] = $this->input->post("inp_pertanyaan");
			$data['tipe_jawaban'] = $jenis_kuesioner_detail;
			$data['jumlah_pilihan'] = $jml_pilihan;
			$data['id_subtema'] = $id_sub_tema;
			$this->Model_tmp_kuesioner->insert_kuesioner_d($data);
		} else {
			$data['idh'] = $id_h;
			$data['pertanyaan'] = $this->input->post("inp_pertanyaan");
			$data['tipe_jawaban'] = $jenis_kuesioner_detail;
			$data['jumlah_pilihan'] = $jml_pilihan;
			$data['id_subtema'] = $id_sub_tema;
			if($jml_pilihan==1)
			{
				$data['pil_1'] = $this->input->post("p_j_1");
				$data['pil_2'] = $this->input->post("p_j_2");
			} 
			elseif($jml_pilihan==2)
			{
				$data['pil_1'] = $this->input->post("p_j_1");
				$data['pil_2'] = $this->input->post("p_j_2");
				$data['pil_3'] = $this->input->post("p_j_3");
			} 
			elseif($jml_pilihan==3)
			{
				$data['pil_1'] = $this->input->post("p_j_1");
				$data['pil_2'] = $this->input->post("p_j_2");
				$data['pil_3'] = $this->input->post("p_j_3");
				$data['pil_4'] = $this->input->post("p_j_4");
			} 
			elseif($jml_pilihan==4)
			{
				$data['pil_1'] = $this->input->post("p_j_1");
				$data['pil_2'] = $this->input->post("p_j_2");
				$data['pil_3'] = $this->input->post("p_j_3");
				$data['pil_4'] = $this->input->post("p_j_4");
				$data['pil_5'] = $this->input->post("p_j_5");
			} 
			else
			{
				$data['pil_1'] = $this->input->post("p_j_1");
				$data['pil_2'] = $this->input->post("p_j_2");
				$data['pil_3'] = $this->input->post("p_j_3");
				$data['pil_4'] = $this->input->post("p_j_4");
				$data['pil_5'] = $this->input->post("p_j_5");
				$data['pil_6'] = $this->input->post("p_j_6");
			}
			$this->Model_tmp_kuesioner->insert_kuesioner_d($data);
		}
		$this->session->set_flashdata('info', "Pertanyaan berhasil disimpan");
		redirect("kuesioner/pertanyaan/".encrypt_decrypt('encrypt', $id_h));
	}
	public function edit_pertanyaan()
	{
		$this->Model_security->get_security();
		//$this->_init();
		if(empty($this->uri->segment(3)))
		{
			redirect('kuesioner','refresh');
		} else {
			$key = encrypt_decrypt('decrypt', $this->uri->segment(3));
			$data['dt_dk'] = $this->Model_tmp_kuesioner->get_data_kuesioner_d_row($key);
			$this->load->view('proses/home_page/kuesioner/edt_pertanyaan', $data);
		}
	}
	public function edit_pertanyaan_subtema()
	{
		$this->Model_security->get_security();
		if(empty($this->uri->segment(3)))
		{
			redirect('kuesioner','refresh');
		} else {
			$key = encrypt_decrypt('decrypt', $this->uri->segment(3));
			$id_subtema = $this->Model_tmp_kuesioner->get_data_kuesioner_d_row($key)->id_subtema;
			$data['dt_dk'] = $this->Model_tmp_kuesioner->get_data_kuesioner_d_row($key);
			$data['dt_subtema'] = $this->Model_tmp_kuesioner->get_data_pertanyaan_subtema_row($id_subtema);
			$this->load->view('proses/home_page/kuesioner/edt_pertanyaan_2', $data);
		}
	}
	function rubah_kue_d()
	{
		$id_h = $this->input->post("id_head");
		$id_d = $this->input->post("id_detail");
		$id_jenis_kuesioner = $this->input->post("id_jenis_kues");
		$id_jumlah_pilihan = $this->input->post("id_jumlah_pilihan");
		if($id_jenis_kuesioner==2)
		{
			$data['pertanyaan'] = $this->input->post("inp_pertanyaan");
			$this->Model_tmp_kuesioner->update_kuesioner_d($id_d, $data);
		} else {
			$data['pertanyaan'] = $this->input->post("inp_pertanyaan");
			if($id_jumlah_pilihan==1)
			{
				$data['pil_1'] = $this->input->post("p_j_1");
				$data['pil_2'] = $this->input->post("p_j_2");
			} elseif($id_jumlah_pilihan==2) {
				$data['pil_1'] = $this->input->post("p_j_1");
				$data['pil_2'] = $this->input->post("p_j_2");
				$data['pil_3'] = $this->input->post("p_j_3");
			} elseif($id_jumlah_pilihan==3) {
				$data['pil_1'] = $this->input->post("p_j_1");
				$data['pil_2'] = $this->input->post("p_j_2");
				$data['pil_3'] = $this->input->post("p_j_3");
				$data['pil_4'] = $this->input->post("p_j_4");
			} elseif($id_jumlah_pilihan==4) {
				$data['pil_1'] = $this->input->post("p_j_1");
				$data['pil_2'] = $this->input->post("p_j_2");
				$data['pil_3'] = $this->input->post("p_j_3");
				$data['pil_4'] = $this->input->post("p_j_4");
				$data['pil_5'] = $this->input->post("p_j_5");
			} else {
				$data['pil_1'] = $this->input->post("p_j_1");
				$data['pil_2'] = $this->input->post("p_j_2");
				$data['pil_3'] = $this->input->post("p_j_3");
				$data['pil_4'] = $this->input->post("p_j_4");
				$data['pil_5'] = $this->input->post("p_j_5");
				$data['pil_6'] = $this->input->post("p_j_6");
			}
			$this->Model_tmp_kuesioner->update_kuesioner_d($id_d, $data);
		}
		$this->session->set_flashdata('info', "Perubahan pertanyaan berhasil disimpan");
		redirect("kuesioner/pertanyaan/".encrypt_decrypt('encrypt', $id_h));
	}
	public function hapus_pertanyaan()
	{
		$this->Model_security->get_security();
		$key = encrypt_decrypt('decrypt', $this->input->post("id_data"));
		$this->Model_tmp_kuesioner->delete_kuesioner_d_per_row($key);
		echo "Data kuesioner berhasil dihapus";
	}
	public function edit_kuesioner_head()
	{
		$this->Model_security->get_security();
		$this->_init();
		if(empty($this->uri->segment(3)))
		{
			redirect('kuesioner','refresh');
		} else {
			$id_head = encrypt_decrypt('decrypt', $this->uri->segment(3));
			$data['dt_hk'] = $this->Model_tmp_kuesioner->get_data_kuesioner_h($id_head);
			$this->load->view('proses/home_page/kuesioner/edt_head_kuesioner', $data);
		}
	}
	function rubah_kue_h()
	{
		$this->Model_security->get_security();
		if(count($this->input->post("pil_display"))<=0)
		{
			redirect("kuesioner");
		}
		$nom=1;
		foreach ($this->input->post("pil_display") as $key => $value) 
		{
			if($nom==1)
			{
				$temp_pil_displ = $value;
			} else {
				$temp_pil_displ = $temp_pil_displ.",".$value;
			}
			$nom++;
		}
		$key = $this->input->post("id_head");
		$s_tgl_1 = explode("/", $this->input->post("tgl_start"));
		$data['tgl_start'] = $s_tgl_1[2]."-".$s_tgl_1[1]."-".$s_tgl_1[0];
		$s_tgl_2 = explode("/", $this->input->post("tgl_end"));
		$data['tgl_end'] = $s_tgl_2[2]."-".$s_tgl_2[1]."-".$s_tgl_2[0];
		$data['tema_kue'] = $this->input->post("tema_kuesioner");
		$data['ket_kue_awal'] = $this->input->post("ket_kuesioner_awal");
		$data['ket_kue_akhir'] = $this->input->post("ket_kuesioner_akhir");
		$data['display'] = $temp_pil_displ;
		$data['status'] = $this->input->post("pil_status");
		$this->Model_tmp_kuesioner->update_kuesioner_h($key, $data);
		$this->session->set_flashdata('info', "Perubahan head kuesioner berhasil disimpan");
		redirect("kuesioner");
	}
	public function hapus_kuesioner()
	{
		$this->Model_security->get_security();
		$key = encrypt_decrypt('decrypt', $this->input->post("id_data"));
		$this->Model_tmp_kuesioner->delete_kuesioner_h($key);
		$resilt_subtema = $this->Model_tmp_kuesioner->get_data_kuesioner_sub_tema($key);
		if(count($resilt_subtema)>0)
		{
			$this->Model_tmp_kuesioner->delete_kuesioner_subtema($key);
		}
		if(count($this->Model_tmp_kuesioner->get_data_kuesioner_d($key))>0)
		{
			$this->Model_tmp_kuesioner->delete_kuesioner_d($key);
		}
		echo "Data kuesioner berhasil dihapus";
	}
	public function hasil_kuesioner()
	{
		$this->Model_security->get_security();
		$this->_init();
		if(empty($this->uri->segment(3)))
		{
			redirect('kuesioner','refresh');
		} else {
			$id_head = encrypt_decrypt('decrypt', $this->uri->segment(3));
			$result_dt = $this->Model_tmp_kuesioner->get_data_kuesioner_h($id_head);
			if($result_dt->kat_kue==1)
			{
				$data['dt_hk'] = $this->Model_tmp_kuesioner->get_data_kuesioner_h($id_head);
				$data['dt_subtema'] = $this->Model_tmp_kuesioner->get_data_kuesioner_sub_tema($id_head);
				$data['dt_dk'] = $this->Model_tmp_kuesioner->get_data_kuesioner_d($id_head);
				if(count($this->Model_tmp_kuesioner->get_data_kuesioner_sub_tema($id_head))<=0)
				{
					$this->load->view('proses/home_page/kuesioner/result_kuesioner_likert', $data);
				} else {
					$this->load->view('proses/home_page/kuesioner/result_kuesioner_likert_subtema', $data);
				}
			} elseif($result_dt->kat_kue==2)
			{
				$data['dt_hk'] = $this->Model_tmp_kuesioner->get_data_kuesioner_h($id_head);
				$data['dt_subtema'] = $this->Model_tmp_kuesioner->get_data_kuesioner_sub_tema($id_head);
				$data['dt_dk'] = $this->Model_tmp_kuesioner->get_data_kuesioner_d($id_head);
				if(count($this->Model_tmp_kuesioner->get_data_kuesioner_sub_tema($id_head))<=0)
				{
					$this->load->view('proses/home_page/kuesioner/result_kuesioner_gutman', $data);
				} else {
					$this->load->view('proses/home_page/kuesioner/result_kuesioner_gutman_subtema', $data);
				}
			} else {
				$data['dt_hk'] = $this->Model_tmp_kuesioner->get_data_kuesioner_h($id_head);
				$data['dt_subtema'] = $this->Model_tmp_kuesioner->get_data_kuesioner_sub_tema($id_head);
				$data['dt_dk'] = $this->Model_tmp_kuesioner->get_data_kuesioner_d($id_head);
				if(count($this->Model_tmp_kuesioner->get_data_kuesioner_sub_tema($id_head))<=0)
				{
					$this->load->view('proses/home_page/kuesioner/result_kuesioner_standar', $data);
				} else {
					$this->load->view('proses/home_page/kuesioner/result_kuesioner_standar_subtema', $data);
				}
			}
			
		}
	}
}