<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function convert_tanggal($tgl_default)
{
	$arr_dt = explode("-", $tgl_default);
	$day = $arr_dt[2];
	$month = $arr_dt[1];
	$year = $arr_dt[0];
	$result = $day."-".$month."-".$year;
	return $result;
}
function convert_tanggal_2($tgl_default)
{
	$arr_dt = explode("-", $tgl_default);
	$day = $arr_dt[2];
	$month = $arr_dt[1];
	$year = $arr_dt[0];
	$result = $day."/".$month."/".$year;
	return $result;
}