<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('getPart')){
	function getPart($string,$count=0){
		return (strlen($string) > ($count+3)) ? substr($string,0,$count).'...' : $string;
	}
}
?>