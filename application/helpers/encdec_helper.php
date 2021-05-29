<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv';
    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}
function struuid($key)
	{
		$s=uniqid("",$key);
		$num= hexdec(str_replace(".","",(string)$s));
		$index = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$base= strlen($index);
		$out = '';
			for($t = floor(log10($num) / log10($base)); $t >= 0; $t--) {
				$a = floor($num / pow($base,$t));
				$out = $out.substr($index,$a,1);
				$num = $num-($a*pow($base,$t));
			}
		return $out;
	}