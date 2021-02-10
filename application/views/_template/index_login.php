<?php
$this->load->view('_template/h_login');
$this->load->get_section('sidebar');
$this->load->get_section('theme-switcher');
echo $output;
$this->load->view('_template/f_login');
?>