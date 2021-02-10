<?php
$this->load->view('_template/head');
$this->load->view('_template/main_head');
$this->load->view('_template/menu_sidebar');
$this->load->get_section('sidebar');
$this->load->get_section('theme-switcher');
echo $output;
$this->load->view('_template/footer');
?>