<?php 
defined('BASEPATH') OR exit ('No direct script access allowed');
/**
 * 
 */
class Login extends CI_Controller
{
	function _init()
	{
		$this->output->set_template('index_login');
	}
	public function index()
	{
		$this->_init();
		$this->load->view("login/index");

	}
	public function doLogin()
	{
		$usr_dev = NMUSR;
        $pss_dev = PSUSR;
		$user_name = $this->input->post("nm_user");
		$user_passwd = $this->input->post("ps_user");
        if($usr_dev==$user_name && $pss_dev==$user_passwd)
        {
        	$sess = array("aktif_ses"=>"1", "user_ses"=>"Admin", "user_kat"=>"1");
            $this->session->set_userdata($sess);
            redirect("home");   
        }
        else
        {
            $this->session->set_flashdata("konfirm", "Maaf, Nama Pengguna atau Password Salah. Coba Lagi");
            redirect("");
        }
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect("");
	}
}