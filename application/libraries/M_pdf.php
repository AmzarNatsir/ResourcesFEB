<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
//include_once APPPATH.'/third_party/MPDF57/mpdf.php';
include_once APPPATH.'/third_party/vendor/autoload.php';

class M_pdf {
 
    public $param;
    public $pdf;
 
    public function __construct($param = '"en-GB-x","A4","","",10,10,10,10,6,3')
    {
        $this->param =$param;
        //$mpdf = new \Mpdf\Mpdf();
        //$this->pdf = new mPDF($this->param);
        $this->pdf = new \Mpdf\Mpdf();
        // $this->pdf->cacheTables = true;
		$this->pdf->simpleTables = true;
		$this->pdf->packTableData = true;
    }
}
// - See more at: https://arjunphp.com/generating-a-pdf-in-codeigniter-using-mpdf/#sthash.S9K7xiO5.dpuf