<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {

	function __construct()
	{
      parent::__construct();
      $this->load->model(array('model_user', 'model_ka'));
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
		$data['all_dosen'] = $this->model_user->get_all_dosen();
		$data['dsn_aktif'] = $this->model_user->get_all_dosen_aktif();
		$data['mhs_aktif'] = $this->model_user->get_all_mahasiswa_aktif();
		$data['mhs_blm_aktif'] = $this->model_user->get_all_mahasiswa_belum_aktif();
		$data['all_pegawai'] = $this->model_user->get_all_pegawai();
		$data['pegawai_aktif'] = $this->model_user->get_all_pegawai_aktif();
		$data['res_head_ka'] = $this->model_ka->get_all_ta_aktif();
		$this->load->view('home/index', $data);
	}
	//kalender akademik
	public function get_detail_kegiatan()
	{
		$id_head = $this->uri->segment(3);
		$result = $this->model_ka->get_detail_ka($id_head);
		if(count($result)>0)
		{
			
			foreach ($result as $list) {
				$arr_kegiatan[] = array(
				"title" => $list['kegiatan'],
				"start" => date_format(date_create($list['tgl_awal']), "Y-m-d"),
				"end" => date_format(date_create($list['tgl_akhir']), "Y-m-d"),
				"backgroundColor" => $list['warna'], //"#f56954",
				"borderColor" => $list['warna']
				);
			}
		}
		echo json_encode($arr_kegiatan);
	}

	public function akun_mahasiswa()
	{
		$this->Model_security->get_security();
		$this->_init();
		//$data['mhs_all'] = $this->model_user->get_all_mahasiswa();
		$this->load->view('home/mhs_aktif');
	}
	public function hasil_pencarian_akun()
	{
		$this->Model_security->get_security();
		if(is_null($this->input->get('id')))
        {
        	$this->_init();
			//$data['mhs_all'] = $this->model_user->get_all_mahasiswa();
			$this->load->view('home/mhs_aktif');
        }
        else
        { 
	        $data['mhs_all']=$this->model_user->get_akun_search($this->input->get('id')); 
	        $this->load->view('home/hasil_pencarian_akun',$data);
        }
	}
	public function edit_akun_mahasiswa()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->uri->segment(3);
		$data['res'] = $this->model_user->get_profil_akun_mhs($id_tabel);
		$this->load->view("home/edit_akun_mhs", $data);
	}
	public function rubah_akun_mahasiswa()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->input->post('id_tabel');
		$data['status'] = $this->input->post("pil_status");
		$data['tgl_aktif'] = date('Y-m-d');
		$this->model_user->update_akun_mhs($id_tabel, $data);
		$this->session->set_flashdata("konfirm", "Perubahan data berhasil disimpan");
		redirect("home/akun_mahasiswa");
	}
	public function reset_akun_mahasiswa()
	{
		$this->Model_security->get_security();
		$id_tabel = $this->uri->segment(3);
		$data['res'] = $this->model_user->get_profil_akun_mhs($id_tabel);
		$this->load->view("home/reset_akun_mhs", $data);
	}
	public function simpan_akun_baru_mahasiswa()
	{
		$this->Model_security->get_security();
		$passwd = strtoupper(md5($this->input->post("inp_passwd")));
		$id_tabel = $this->input->post('id_tabel');
		$data['status'] = 1;
		$data['tgl_aktif'] = date('Y-m-d');
		$data['passwd'] = $passwd;
		$data['update_passwd'] = date('Y-m-d');
		$data['update_count'] = 1;
		$this->model_user->update_akun_mhs($id_tabel, $data);
		$this->session->set_flashdata("konfirm", "Perubahan data berhasil disimpan");
		redirect("home/akun_mahasiswa");
	}
	//akun dosen
	public function akun_dosen()
	{
		$this->Model_security->get_security();
		$this->_init();
		$data['dosen_all_aktif'] = $this->model_user->get_all_dosen_aktif();
		$this->load->view('home/dosen_all', $data);
	}
	public function add_akun_dosen()
	{
		$this->Model_security->get_security();
		$data['all_dosen'] = $this->model_user->get_all_dosen();
		$this->load->view("home/frm_add_dosen", $data);
	}
	public function cari_akun_dosen()
	{
		$nidn = $this->input->post("nidn");
		$res = count($this->model_user->get_akun_dosen($nidn));
		echo $res;
	}
	public function simpan_akun_dosen()
	{
		$id_dosen = $this->input->post("pil_dosen");
		$nim = $this->input->post("inp_nidn");
		$ori_pass = $this->input->post("inp_passwd");
		$passwd = strtoupper(md5($this->input->post("inp_passwd")));
		$to_email = $this->input->post('inp_email');

		$data['id_dosen'] = $id_dosen;
		$data['nidn'] = $nim;
		$data['email'] = $to_email;
		$data['passwd'] = $passwd;
		$data['status'] = 1;
		$data['tgl_reg'] = date("Y-m-d");
		$this->model_user->insert_akun_dosen($data);

		$resp = $this->send_email($to_email, $ori_pass);
		$this->session->set_flashdata("konfirm",$resp);
		redirect("home/akun_dosen");
	}
	public function edit_akun_dosen()
	{
		$this->Model_security->get_security();
		$id_akun = $this->uri->segment(3);
		$data['profil_akun'] = $this->model_user->get_profil_akun_dosen($id_akun);
		$this->load->view("home/frm_edit_akun_dosen", $data);
	}
	public function rubah_akun_dosen()
	{
		$this->Model_security->get_security();
		$id_akun = $this->input->post("id_akun");
		$ori_pass = $this->input->post("inp_passwd");
		$passwd = strtoupper(md5($this->input->post("inp_passwd")));
		$to_email = $this->input->post('inp_email');
		$data['passwd'] = $passwd;
		$this->model_user->update_akun_dosen($id_akun, $data);

		$resp = $this->send_email_update($to_email, $ori_pass);
		$this->session->set_flashdata("konfirm",$resp);
		redirect("home/akun_dosen");
	}
	//akun pegawai
	function akun_pegawai()
	{
		$this->Model_security->get_security();
		$this->_init();
		$data['pegawai_all_aktif'] = $this->model_user->get_all_pegawai_aktif();
		$this->load->view('home/pegawai_all', $data);
	}
	public function add_akun_pegawai()
	{
		$this->Model_security->get_security();
		$data['all_pegawai'] = $this->model_user->get_all_pegawai();
		$this->load->view("home/frm_add_pegawai", $data);
	}
	public function cari_akun_pegawai()
	{
		$id_pegawai = $this->input->post("id_pegawai");
		$res = count($this->model_user->get_akun_pegawai($id_pegawai));
		echo $res;
	}
	public function simpan_akun_pegawai()
	{
		$id_pegawai = $this->input->post("pil_pegawai");
		$no_induk = $this->input->post("inp_nomor_induk");
		$ori_pass = $this->input->post("inp_passwd");
		$passwd = strtoupper(md5($this->input->post("inp_passwd")));
		$to_email = $this->input->post('inp_email');

		$data['id_pegawai'] = $id_pegawai;
		$data['no_induk'] = $no_induk;
		$data['email'] = $to_email;
		$data['passwd'] = $passwd;
		$data['status'] = 1;
		$data['tgl_reg'] = date("Y-m-d");
		$this->model_user->insert_akun_pegawai($data);

		$resp = $this->send_email_pegawai($to_email, $ori_pass);
		$this->session->set_flashdata("konfirm",$resp);
		redirect("home/akun_pegawai");
	}
	public function edit_akun_pegawai()
	{
		$this->Model_security->get_security();
		$id_akun = $this->uri->segment(3);
		$data['profil_akun'] = $this->model_user->get_profil_akun_pegawai($id_akun);
		$this->load->view("home/frm_edit_akun_pegawai", $data);
	}
	public function rubah_akun_pegawai()
	{
		$this->Model_security->get_security();
		$id_akun = $this->input->post("id_akun");
		$ori_pass = $this->input->post("inp_passwd");
		$passwd = strtoupper(md5($this->input->post("inp_passwd")));
		$to_email = $this->input->post('inp_email');
		$data['passwd'] = $passwd;
		$this->model_user->update_akun_pegawai($id_akun, $data);

		$resp = $this->send_email_update($to_email, $ori_pass);
		$this->session->set_flashdata("konfirm",$resp);
		redirect("home/akun_pegawai");
	}
	//send email
	function send_email($to_email, $send_pass)
	{
		
		$sender_email = 'info@feb.unismuh.ac.id';// 'syahdanfathan2008@gmail.com'; // "feb@unismuh.ac.id";
		$user_password = 'f3k0n.c0m'; // 'sy4hd4n2008';
		$to_email = $to_email;

		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'mail.feb.unismuh.ac.id';
		$config['smtp_port'] = '587'; //465;
		$config['smtp_user'] = $sender_email;
		$config['smtp_pass'] = $user_password;
		$config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['crlf']    = "\r\n";
        $config['mailtype'] = 'text'; // or html
        $config['validation'] = FALSE;

		$this->load->library('email', $config);
		//$this->email->set_newline("\r\n");
		$this->email->from($sender_email, "FEB Unismuh Makassar");

		$this->email->to($to_email);
		$this->email->subject('FEB Unismuh Makassar');
		$this->email->message('Akun (Panel Dosen FEB Unismuh Makassar) anda sudah aktif. Password anda adalah :'.$send_pass.'. Klik link berikut untuk masuk ke halaman login https://dosen.feb.unismuh.ac.id');
		if($this->email->send())
		{
           $pesan =  "Data berhasil disimpan. Email berhasil dikirim.";
		}
        else {
        	$pesan =  "Data berhasil disimpan. Email gagal dikirim.";
        }
        return $pesan;
	}
	function send_email_update($to_email, $send_pass)
	{
		
		$sender_email = 'info@feb.unismuh.ac.id';// 'syahdanfathan2008@gmail.com'; // "feb@unismuh.ac.id";
		$user_password = 'f3k0n.c0m'; // 'sy4hd4n2008';
		$to_email = $to_email;

		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'mail.feb.unismuh.ac.id';
		$config['smtp_port'] = '587'; //465;
		$config['smtp_user'] = $sender_email;
		$config['smtp_pass'] = $user_password;
		$config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['crlf']    = "\r\n";
        $config['mailtype'] = 'text'; // or html
        $config['validation'] = FALSE;

		$this->load->library('email', $config);
		//$this->email->set_newline("\r\n");
		$this->email->from($sender_email, "FEB Unismuh Makassar");

		$this->email->to($to_email);
		$this->email->subject('FEB Unismuh Makassar');
		$this->email->message('Akun (Panel Dosen FEB Unismuh Makassar) anda berhasil dirubah. Password baru anda adalah :'.$send_pass.'. Klik link berikut untuk masuk ke halaman login https://dosen.feb.unismuh.ac.id');
		if($this->email->send())
		{
           $pesan =  "Data berhasil disimpan. Email berhasil dikirim.";
		}
        else {
        	$pesan =  "Data berhasil disimpan. Email gagal dikirim.";
        }
        return $pesan;
	}
	//pegawai
	function send_email_pegawai($to_email, $send_pass)
	{
		
		$sender_email = 'info@feb.unismuh.ac.id';// 'syahdanfathan2008@gmail.com'; // "feb@unismuh.ac.id";
		$user_password = 'f3k0n.c0m'; // 'sy4hd4n2008';
		$to_email = $to_email;

		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'mail.feb.unismuh.ac.id';
		$config['smtp_port'] = '587'; //465;
		$config['smtp_user'] = $sender_email;
		$config['smtp_pass'] = $user_password;
		$config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['crlf']    = "\r\n";
        $config['mailtype'] = 'text'; // or html
        $config['validation'] = FALSE;

		$this->load->library('email', $config);
		//$this->email->set_newline("\r\n");
		$this->email->from($sender_email, "FEB Unismuh Makassar");

		$this->email->to($to_email);
		$this->email->subject('FEB Unismuh Makassar');
		$this->email->message('Akun (Panel Pegawai/Tenaga Pendidik FEB Unismuh Makassar) anda sudah aktif. Password anda adalah :'.$send_pass.'. Klik link berikut untuk masuk ke halaman login https://tatausaha.feb.unismuh.ac.id');
		if($this->email->send())
		{
           $pesan =  "Data berhasil disimpan. Email berhasil dikirim.";
		}
        else {
        	$pesan =  "Data berhasil disimpan. Email gagal dikirim.";
        }
        return $pesan;
	}
}
