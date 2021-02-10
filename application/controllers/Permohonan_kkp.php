<?php 
defined('BASEPATH') OR exit ('No direct script access allowed');

class Permohonan_kkp extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('model_formulir_kkp', 'model_opsi'));
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
		$data['mst_prodi'] = $this->model_opsi->get_master_prodi();
		$data['mst_ta'] = $this->model_opsi->get_master_thn_akademik();
		$data['list_permohonan'] = $this->model_formulir_kkp->get_all_permohonan_today();
		$data['res_pengajuan_kkp'] = $this->model_formulir_kkp->get_all_permohonan_today();
		$this->load->view("proses/permohonan_kkp/index", $data);
	}
	public function filter_data()
	{
		$this->Model_security->get_security();
		$pil_ta = $this->uri->segment(3);
		$pil_ps = $this->uri->segment(4);
		if($pil_ta==0 && $pil_ps==0)
		{
			$data['list_permohonan'] = $this->model_formulir_kkp->get_all_permohonan();
		} else {
			$data['list_permohonan'] = $this->model_formulir_kkp->get_filter_permohonan($pil_ta, $pil_ps);
		}
		$this->load->view("proses/permohonan_kkp/v_result", $data);
	}
	public function detail_permohonan()
	{
		$this->Model_security->get_security();
		$this->_init();
		$id_permohonan = $this->uri->segment(3);
		$data['profil'] = $this->model_formulir_kkp->get_profil_permohonan($id_permohonan);
		$data['res_pengajuan_kkp'] = $this->model_formulir_kkp->get_all_permohonan_today();
		$this->load->view("proses/permohonan_kkp/v_detail", $data);
	}
}