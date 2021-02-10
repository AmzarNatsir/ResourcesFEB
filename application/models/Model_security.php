<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_security extends CI_Model {
	
	function get_security()
    {
        $id_user = $this->session->userdata("aktif_ses");
        if(empty($id_user))
        {
            $this->session->sess_destroy();
            redirect("");
        }
    }
}